<?php
class DatabaseHelper
{
   private $db;

   public function __construct($servername, $username, $password, $dbname, $port)
   {
      $this->db = new mysqli($servername, $username, $password, $dbname, $port);
      if ($this->db->connect_error) {
         die("Connection failed: " . $this->db->connect_error);
      }
   }

   //methods for login
   // TODO verificare parametri di SESSIONE se lasciare quelli o mettere username e email anche se nel db la PK é id
   public function login($email, $password)
   {
      // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
      if ($stmt = $this->db->prepare("SELECT id, username, password, salt FROM user WHERE email = ? LIMIT 1")) {
         $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
         $stmt->execute(); // esegue la query appena creata.
         $stmt->store_result();
         $stmt->bind_result($user_id, $username, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
         $stmt->fetch();
         $password = hash('sha512', $password . $salt); // codifica la password usando una chiave univoca.
         if ($stmt->num_rows == 1) { // se l'utente esiste
            // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
            if ($this->checkbrute($user_id) == true) {
               // Account disabilitato
               // Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.
               return false;
            } else {
               if ($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                  // Password corretta!            
                  $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                  $user_id = preg_replace("/[^0-9]+/", "", $user_id); // ci proteggiamo da un attacco XSS
                  $_SESSION['user_id'] = $user_id;
                  $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                  $_SESSION['username'] = $username;
                  $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                  // Login eseguito con successo.
                  return true;
               } else {
                  // Password incorretta.
                  // Registriamo il tentativo fallito nel database.
                  $now = time();
                  $this->db->query("INSERT INTO login_attempt (user_id, time) VALUES ('$user_id', '$now')");
                  return false;
               }
            }
         } else {
            // L'utente inserito non esiste.
            return false;
         }
      }
   }

   public function checkbrute($user_id)
   {
      // Recupero il timestamp
      $now = time();
      // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
      $valid_attempts = $now - (2 * 60 * 60);
      if ($stmt = $this->db->prepare("SELECT time FROM login_attempt WHERE user_id = ? AND time > '$valid_attempts'")) {
         $stmt->bind_param('i', $user_id);
         // Eseguo la query creata.
         $stmt->execute();
         $stmt->store_result();
         // Verifico l'esistenza di più di 5 tentativi di login falliti.
         if ($stmt->num_rows > 5) {
            return true;
         } else {
            return false;
         }
      }
   }

   function login_check()
   {
      // Verifica che tutte le variabili di sessione siano impostate correttamente
      if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
         $user_id = $_SESSION['user_id'];
         $login_string = $_SESSION['login_string'];
         $username = $_SESSION['username'];
         $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
         if ($stmt = $this->db->prepare("SELECT password FROM user WHERE id = ? LIMIT 1")) {
            $stmt->bind_param('i', $user_id); // esegue il bind del parametro '$user_id'.
            $stmt->execute(); // Esegue la query creata.
            $stmt->store_result();

            if ($stmt->num_rows == 1) { // se l'utente esiste
               $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
               $stmt->fetch();
               $login_check = hash('sha512', $password . $user_browser);
               if ($login_check == $login_string) {
                  // Login eseguito!!!!
                  return true;
               } else {
                  //  Login non eseguito
                  return false;
               }
            } else {
               // Login non eseguito
               return false;
            }
         } else {
            // Login non eseguito
            return false;
         }
      } else {
         // Login non eseguito
         return false;
      }
   }

   //methods for signin
   public function usernameIsPresent($username)
   {
      if ($stmt = $this->db->prepare("SELECT * FROM user WHERE username = ? LIMIT 1")) {
         $stmt->bind_param('s', $username); // esegue il bind del parametro '$email'.
         $stmt->execute(); // esegue la query appena creata.
         $stmt->store_result();

         return $stmt->num_rows == 0 ? false : true;
      }
   }

   public function emailIsPresent($email)
   {
      if ($stmt = $this->db->prepare("SELECT * FROM user WHERE email = ? LIMIT 1")) {
         $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
         $stmt->execute(); // esegue la query appena creata.
         $stmt->store_result();

         return $stmt->num_rows == 0 ? false : true;
      }
   }

   public function signin($email, $password, $username, $random_salt, $nome, $cognome, $data_nascita, $sesso)
   {
      if ($insert_stmt = $this->db->prepare("INSERT INTO user (username, email, password, salt, data_di_nascita, nome, cognome, sesso) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
         $insert_stmt->bind_param('ssssssss', $username, $email, $password, $random_salt, $data_nascita, $nome, $cognome, $sesso);
         // Esegui la query ottenuta.
         return $insert_stmt->execute();
      }
   }

   //search username
   public function search_username($username)
   {
      if ($stmt = $this->db->prepare("SELECT username FROM user WHERE username LIKE ?")) {
         $temp = "%{$username}%";
         $stmt->bind_param('s', $temp);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   //load posts for user
   public function load_posts_for($user_id, $id_categoria, $last_post, $num_post)
   {
      if (
         $id_categoria == 1 && $stmt = $this->db->prepare("select posts.*, count(c.post_id) as nCommenti 
      from (SELECT p.id, username, foto_profilo, p.data_ora, p.testo, img, luogo, id_categoria, count(l.post_id) as miPiace
      from post  as p
      left join miPiace as l on p.id = l.post_id
      join user as u on p.id_user_create=u.id
      and  p.data_ora < ?
      and u.id in (SELECT follow.user_follow FROM follow join user where follow.user_id = ?)
      group by p.id) as posts
      left join commento as c
      on posts.id = c.post_id
      group by posts.id
      order by posts.data_ora DESC
      limit ?;")
      ) {
         $old_query = "select posts.*, count(c.post_id) as nCommenti 
         from (SELECT p.id, username, foto_profilo, p.data_ora, p.testo, img, luogo, id_categoria, count(l.post_id) as miPiace
         from post  as p
         left join miPiace as l on p.id = l.post_id
         join user as u on p.id_user_create=u.id
         and u.id in (SELECT follow.user_follow FROM follow join user where follow.user_id = ?)
         group by p.id) as posts
         left join commento as c
         on posts.id = c.post_id
         group by posts.id;";
         $stmt->bind_param('sii', $last_post, $user_id, $num_post);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_all(MYSQLI_ASSOC);
      } else if (
         $stmt = $this->db->prepare("select * from (select posts.*, count(c.post_id) as nCommenti 
      from (SELECT p.id, username, foto_profilo, p.data_ora, p.testo, img, luogo, id_categoria, count(l.post_id) as miPiace
      from post  as p
      left join miPiace as l on p.id = l.post_id
      join user as u on p.id_user_create=u.id
      and  p.data_ora < ?
      and u.id in (SELECT follow.user_follow FROM follow join user where follow.user_id = ?)
      group by p.id) as posts
      left join commento as c
      on posts.id = c.post_id
      group by posts.id) as posts
      where posts.id_categoria=?
      order by posts.data_ora DESC
      limit ?;")
      ) {
         $stmt->bind_param('siii', $last_post, $user_id, $id_categoria, $num_post);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   //load info post
   public function load_post($post_id)
   {
      if (
         $stmt = $this->db->prepare("SELECT post.id, username, foto_profilo, data_ora, testo, img, luogo, id_categoria, count(mp.post_id) as miPiace
      from miPiace as mp right join post
      on mp.post_id = post.id, user
      where post.id_user_create=user.id
      and post.id = ?
      group by post.id
      "
         )
      ) {
         $stmt->bind_param('i', $post_id);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   //load commenti post
   public function load_commenti_for($post_id)
   {
      if (
         $stmt = $this->db->prepare("SELECT user_id, username, post_id, data_ora, testo, foto_profilo 
                                       from commento join user where user_id=user.id
                                       and post_id = ?"
         )
      ) {
         $stmt->bind_param('i', $post_id);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   //TODO gestire id categoria se non presente non inserirlo cosi dovrebbe metter valore di default mettendo null mette null e non il valore di default
   // oppure usare null come valore di default
   public function upload_post($user_id, $dataOra, $testo, $luogo, $idCat)
   {
      if ($insert_stmt = $this->db->prepare("INSERT INTO post (id_user_create, data_ora, testo,  luogo, id_categoria) VALUES (?, ?, ?, ?, ?)")) {
         $insert_stmt->bind_param('iissi', $user_id, $dataOra, $testo, $luogo, $idCat);
         // Esegui la query ottenuta. 
         $insert_stmt->execute();
         return $insert_stmt->insert_id;
      }
   }

   public function updateimg_post($idPost, $url)
   {
      if ($insert_stmt = $this->db->prepare("UPDATE post SET img = ? WHERE id = ?")) {
         $insert_stmt->bind_param('si', $url, $idPost);
         // Esegui la query ottenuta. 
         return $insert_stmt->execute();
      }
   }

   public function getCategorie()
   {
      if ($stmt = $this->db->prepare("SELECT id, titolo from categoria")) {
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   public function upload_comment($user_id, $dataOra, $testo, $idPost)
   {
      if ($insert_stmt = $this->db->prepare("INSERT INTO commento (user_id, post_id,data_ora, testo) VALUES (?, ?, ?, ?)")) {
         $insert_stmt->bind_param('iiss', $user_id, $idPost, $dataOra, $testo);
         // Esegui la query ottenuta. 
         $insert_stmt->execute();
         return $insert_stmt->insert_id;
      }
   }

   public function get_user_posts($user_id)
   {
      if (
         $stmt = $this->db->prepare("select p2.*, count(c.post_id) as nCommenti from(select p1.* , count(l.post_id) as miPiace  from (Select * from post as p
      where p.id_user_create = ?) as p1 left join mipiace as l
      on p1.id = l.post_id
      group by p1.id) as p2 left join commento as c
      on p2.id = c.post_id
      group by p2.id;")
      ) {
         $stmt->bind_param('i', $user_id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   public function get_user_info($user_id)
   {
      if (
         $stmt = $this->db->prepare("SELECT  id, username,foto_profilo, descrizione, data_di_nascita, nome, cognome, sesso, email FROM user
      where id = ?;")
      ) {
         $stmt->bind_param('i', $user_id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   //impostazioni.php 
   public function update_impostazioni_1($id_username, $username, $email, $password, $salt)
   {
      if ($insert_stmt = $this->db->prepare("UPDATE user SET username = ?, password = ?, email=?, salt=?  WHERE id = ?")) {
         $insert_stmt->bind_param('ssssi', $username, $password, $email, $salt, $id_username);
         // Esegui la query ottenuta. 
         return $insert_stmt->execute();
      }
   }

   public function update_impostazioni_2($id_username, $username, $email)
   {
      if ($insert_stmt = $this->db->prepare("UPDATE user SET username = ?, email=?  WHERE id = ?")) {
         $insert_stmt->bind_param('ssi', $username, $email, $id_username);
         // Esegui la query ottenuta. 
         return $insert_stmt->execute();
      }
   }

   public function update_immagine_profilo($userid, $location)
   {
      if ($insert_stmt = $this->db->prepare("UPDATE user SET foto_profilo = ? WHERE id = ?")) {
         $insert_stmt->bind_param('si', $location, $userid);
         // Esegui la query ottenuta. 
         return $insert_stmt->execute();
      }
   }

   public function get_user_follower($user_id)
   {
      if (
         $stmt = $this->db->prepare("SELECT f.user_id as id, u.username FROM follow as f, user as u
      where user_follow = ?
      and user_id = u.id;")
      ) {
         $stmt->bind_param('i', $user_id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   public function get_user_seguiti($user_id)
   {
      if (
         $stmt = $this->db->prepare("SELECT f.user_follow as id, u.username FROM follow as f, user as u
      where user_id = ?
      and user_follow = u.id;")
      ) {
         $stmt->bind_param('i', $user_id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   public function check_like($post_id, $user_id)
   {
      if ($stmt = $this->db->prepare("SELECT * FROM mipiace where user_id = ? and post_id = ?;")) {
         $stmt->bind_param('ii', $user_id, $post_id);
         $stmt->execute(); // esegue la query appena creata.
         $stmt->store_result();

         if ($stmt->num_rows == 0) {
            if ($ins_stmt = $this->db->prepare("INSERT INTO mipiace (user_id, post_id) VALUES (?, ?)")) {
               $ins_stmt->bind_param('ii', $user_id, $post_id);
               $ins_stmt->execute();
            }
         } else {
            if ($del_stmt = $this->db->prepare("DELETE FROM mipiace WHERE user_id = ? and post_id = ?")) {
               $del_stmt->bind_param('ii', $user_id, $post_id);
               $del_stmt->execute();
            }
         }

         if ($stmt = $this->db->prepare("SELECT  count(*) nMiPiace FROM mipiace where post_id = ?;")) {
            $stmt->bind_param('i', $post_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
         }
      }
   }

}