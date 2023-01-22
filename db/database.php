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
                  $_SESSION['foto_profilo'] = $this->get_img_user_session($user_id)[0]['foto_profilo'];
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

   public function get_img_user_session($user_id)
   {
      if (
         $stmt = $this->db->prepare("SELECT foto_profilo FROM user where id = ?;")
      ) {
         $stmt->bind_param('i', $user_id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
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
      if(!isset($username)){return false;}
      if ($stmt = $this->db->prepare("SELECT * FROM user WHERE username = ? LIMIT 1")) {
         $stmt->bind_param('s', $username); // esegue il bind del parametro '$email'.
         $stmt->execute(); // esegue la query appena creata.
         $stmt->store_result();

         return $stmt->num_rows == 0 ? false : true;
      }
   }

   public function emailIsPresent($email)
   {
      if(!isset($email)){return false;}
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
      if ($stmt = $this->db->prepare("SELECT id,username FROM user WHERE username LIKE ?")) {
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
         $id_categoria == 1 && $stmt = $this->db->prepare("SELECT p3.*, mp.user_id as asliked from(select posts.*, count(c.post_id) as nCommenti 
         from (SELECT p.id,p.id_user_create, username, foto_profilo, p.data_ora, p.testo, img, luogo, id_categoria, count(l.post_id) as miPiace
         from post  as p
         left join mi_piace as l on p.id = l.post_id
         join user as u on p.id_user_create=u.id
         and  p.data_ora < ?
         and u.id in (SELECT follow.user_follow FROM follow join user where follow.user_id = ?)
         group by p.id) as posts
         left join commento as c
         on posts.id = c.post_id
         group by posts.id
         order by posts.data_ora DESC
         limit ?) as p3 left join mi_piace as mp
         on mp.user_id = ? and p3.id = mp.post_id")
      ) {
         $stmt->bind_param('siii', $last_post, $user_id, $num_post, $user_id);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_all(MYSQLI_ASSOC);
      } else if (
         $stmt = $this->db->prepare("SELECT p3.*, mp.user_id as asliked from(select * from (select posts.*, count(c.post_id) as nCommenti 
         from (SELECT p.id, p.id_user_create, username, foto_profilo, p.data_ora, p.testo, img, luogo, id_categoria, count(l.post_id) as miPiace
         from post  as p
         left join mi_piace as l on p.id = l.post_id
         join user as u on p.id_user_create=u.id
         and  p.data_ora < ?
         and u.id in (SELECT follow.user_follow FROM follow join user where follow.user_id = ?)
         group by p.id) as posts
         left join commento as c
         on posts.id = c.post_id
         group by posts.id) as posts
         where posts.id_categoria=?
         order by posts.data_ora DESC
         limit ?) as p3 left join mi_piace as mp
         on mp.user_id = ? and p3.id = mp.post_id;")
      ) {
         $stmt->bind_param('siiii', $last_post, $user_id, $id_categoria, $num_post, $user_id);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   //load info post
   public function load_post($post_id)
   {
      if ($stmt = $this->db->prepare("SELECT p3.*, mp.user_id as asliked from(SELECT post.id,id_user_create, username, foto_profilo, data_ora, testo, img, luogo, id_categoria, count(mp.post_id) as miPiace
      from mi_piace as mp right join post
      on mp.post_id = post.id, user
      where post.id_user_create=user.id
      and post.id = ?
      group by post.id) as p3 left join mi_piace as mp
      on mp.user_id = ? and p3.id = mp.post_id")) {
         $stmt->bind_param('ii', $post_id, $_SESSION['user_id']);
         $stmt->execute();
         $result = $stmt->get_result();

         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   //load commenti post
   public function load_commenti_for($post_id)
   {
      if (
         $stmt = $this->db->prepare(
            "SELECT user_id, username, post_id, data_ora, testo, foto_profilo 
                                       from commento join user where user_id=user.id
                                       and post_id = ? ORDER BY data_ora DESC;"
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
         $id_post = $insert_stmt->insert_id;
         if ($stmt = $this->db->prepare("SELECT user_id FROM follow WHERE user_follow  = ?")) {
            $stmt->bind_param('i', $user_id);
            // Esegui la query ottenuta. 
            $stmt->execute();
            $result = $stmt->get_result();
            $users_destinazione = $result->fetch_all(MYSQLI_ASSOC);
            //var_dump($users_destinazione);
            //$ok = $users_destinazione;
            $data = time();
            foreach ($users_destinazione as $user_destinazione) {
               $this->crea_notifica($id_post, $user_id, 3, $data, $user_destinazione["user_id"]);
            }

            //$ok = $users_destinazione;

         }
         //$users_destinazione = $this->db->query("SELECT user_id FROM follow WHERE user_follow  = $user_id");



         return $id_post;
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
         $this->crea_notifica($idPost, $user_id, 1, $dataOra);
         return $insert_stmt->execute();
      }
   }

   public function get_user_posts($user_id)
   {
      if (
         $stmt = $this->db->prepare("SELECT p3.*, mp.user_id as asliked from(select p2.*, count(c.post_id) as nCommenti from(select p1.* , count(l.post_id) as miPiace  from (Select * from post as p
         where p.id_user_create = ?) as p1 left join mi_piace as l
         on p1.id = l.post_id
         group by p1.id) as p2 left join commento as c
         on p2.id = c.post_id
         group by p2.id ORDER BY p2.data_ora DESC)as p3 left join mi_piace as mp
         on mp.user_id = ? and p3.id = mp.post_id")
      ) {
         $stmt->bind_param('ii', $user_id, $_SESSION['user_id']);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   public function get_user_info($user_id)
   {
      if ($stmt = $this->db->prepare("SELECT  id, username,foto_profilo, descrizione, data_di_nascita, nome, cognome, sesso, email FROM user where id = ?;")) {
         $stmt->bind_param('i', $user_id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   public function update_impostazioni($id_username, $username, $email, $descrizione, $password, $salt)
   {
      if ($stmt = $this->db->prepare("SELECT username, descrizione, email, password, salt FROM user where id = ?;")) {
         $stmt->bind_param('i', $id_username);
         $stmt->execute();
         $result = $stmt->get_result();
         $old_info = $result->fetch_all(MYSQLI_ASSOC);

         if($this->usernameIsPresent($username) || $this->emailIsPresent($email)) {
            return false;   
         } 

         $username=isset($username) ? $username : $old_info[0]['username'];
         $password=isset($password) ? $password : $old_info[0]['password'];
         $email=isset($email) ? $email : $old_info[0]['email'];
         $salt=isset($salt) ? $salt : $old_info[0]['salt'];
         $descrizione=isset($descrizione) ? $descrizione : $old_info[0]['descrizione'];

         
         
         if ($insert_stmt = $this->db->prepare("UPDATE user SET username = ?, password = ?, email=?, salt=?, descrizione=?  WHERE id = ?")) {
            
            $insert_stmt->bind_param(
               'sssssi',
               $username,
               $password,
               $email,
               $salt,
               $descrizione,
               $id_username
            );
            // Esegui la query ottenuta. 
            return $insert_stmt->execute();
         }
      }
   }

   //impostazioni.php 
   public function update_impostazioni_1($id_username, $username, $email, $descrizione, $password, $salt)
   {
      if ($insert_stmt = $this->db->prepare("UPDATE user SET username = ?, password = ?, email=?, salt=?, descrizione=?  WHERE id = ?")) {
         $insert_stmt->bind_param('sssssi', $username, $password, $email, $salt, $descrizione, $id_username);
         // Esegui la query ottenuta. 
         return $insert_stmt->execute();
      }
   }

   public function update_impostazioni_2($id_username, $username, $email, $descrizione)
   {
      if ($insert_stmt = $this->db->prepare("UPDATE user SET username = ?, email=?, descrizione=? WHERE id = ?")) {
         $insert_stmt->bind_param('sssi', $username, $email, $descrizione, $id_username);
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
      if ($stmt = $this->db->prepare("SELECT * FROM mi_piace where user_id = ? and post_id = ?;")) {
         $stmt->bind_param('ii', $user_id, $post_id);
         $stmt->execute(); // esegue la query appena creata.
         $stmt->store_result();

         if ($stmt->num_rows == 0) {
            if ($ins_stmt = $this->db->prepare("INSERT INTO mi_piace (user_id, post_id) VALUES (?, ?)")) {
               $ins_stmt->bind_param('ii', $user_id, $post_id);
               $ins_stmt->execute();
               $result['like'] = true;
               $this->crea_notifica($post_id, $user_id, 2, time());
            }
         } else {
            if ($del_stmt = $this->db->prepare("DELETE FROM mi_piace WHERE user_id = ? and post_id = ?")) {
               $del_stmt->bind_param('ii', $user_id, $post_id);
               $del_stmt->execute();
               $result['like'] = false;
            }
         }

         if ($stmt = $this->db->prepare("SELECT  count(*) nMiPiace FROM mi_piace where post_id = ?;")) {
            $stmt->bind_param('i', $post_id);
            $stmt->execute();
            $temp = $stmt->get_result();
            $result['count'] = $temp->fetch_all(MYSQLI_ASSOC);
            return $result;
         }
      }
   }

   function crea_notifica($post_id, $user_id, $tipoNotifica, $dataOra, $user_id_destinatario = null)
   {
      if ($user_id_destinatario == null && $stmt = $this->db->prepare("SELECT id_user_create FROM post WHERE id = ?")) {
         $stmt->bind_param('i', $post_id);
         // Esegui la query ottenuta. 
         $stmt->execute();
         $stmt->store_result();
         $stmt->bind_result($user_id_destinatario); // recupera il risultato della query e lo memorizza nelle relative variabili.
         $stmt->fetch();
      }
      if ($user_id_destinatario != $user_id && $insert_stmt = $this->db->prepare("INSERT INTO notifica (user_destinazione, post, user_mittente, id_tipo_notifica, data_ora) VALUES (?, ?, ?, ?, ?)")) {
         $insert_stmt->bind_param('iiiis', $user_id_destinatario, $post_id, $user_id, $tipoNotifica, $dataOra);
         // Esegui la query ottenuta. 
         return $insert_stmt->execute();
      }
   }

   function start_follow($user_follow, $user_id)
   {
      if (!$this->check_follow($user_follow, $user_id)) {
         if ($ins_stmt = $this->db->prepare("INSERT INTO follow (user_id, user_follow) VALUES (?, ?)")) {
            $ins_stmt->bind_param('ii', $user_id, $user_follow);
            $this->crea_notifica(null, $user_id, 4, time(), $user_follow);
            return $ins_stmt->execute();
         }
      } else {
         if ($del_stmt = $this->db->prepare("DELETE FROM follow WHERE user_id = ? and user_follow = ?")) {
            $del_stmt->bind_param('ii', $user_id, $user_follow);
            return $del_stmt->execute();
         }
      }
   }

   function check_follow($user_follow, $user_id)
   {
      if ($stmt = $this->db->prepare("SELECT * from follow where user_id = ? and user_follow = ?;")) {
         $stmt->bind_param('ii', $user_id, $user_follow);
         $stmt->execute(); // esegue la query appena creata.
         $stmt->store_result();
         if ($stmt->num_rows == 0) {
            return false;
         } else {
            return true;
         }
      }
   }

   function delete_post($post_id)
   {
      //elimino le notifice
      if ($del_stmt = $this->db->prepare("DELETE from notifica where post = ?; ")) {
         $del_stmt->bind_param('i', $post_id);
         $del_stmt->execute();
      }
      //elimino i commenti
      if ($del_stmt = $this->db->prepare("DELETE from commento where post_id = ?; ")) {
         $del_stmt->bind_param('i', $post_id);
         $del_stmt->execute();
      }
      //elimino i like
      if ($del_stmt = $this->db->prepare("DELETE from mi_piace where post_id = ?; ")) {
         $del_stmt->bind_param('i', $post_id);
         $del_stmt->execute();
      }
      //elimino il post
      if ($del_stmt = $this->db->prepare("DELETE FROM post WHERE id = ?")) {
         $del_stmt->bind_param('i', $post_id);
         return $del_stmt->execute();
      }
   }

   function get_notifiche($user_id)
   {
      if ($stmt = $this->db->prepare("SELECT n.id,post,vista,u.id as idMittente,u.username,u.foto_profilo,tn.id as idTipo,tn.descrizione, data_ora from notifica as n, user as u, tipo_notifica as tn
      where u.id =  user_mittente and tn.id = n.id_tipo_notifica and n.user_destinazione = ? order by data_ora DESC;")) {
         $stmt->bind_param('i', $user_id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }

   function view_noticica($notifica_id)
   {
      if ($insert_stmt = $this->db->prepare("UPDATE notifica SET vista = 1 WHERE id = ?")) {
         $insert_stmt->bind_param('i', $notifica_id);
         return $insert_stmt->execute();
      }
   }

   //TODO impostare nel db vista come default ad 0

   function check_nNuoveNotifiche($user_id)
   {
      if ($stmt = $this->db->prepare("SELECT count(*) as nNotifiche FROM notifica where user_destinazione = ? and vista != 1")) {
         $stmt->bind_param('i', $user_id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_all(MYSQLI_ASSOC);
      }
   }
}
