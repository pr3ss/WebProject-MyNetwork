<!DOCTYPE html>
<html lang="it">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $templateParams["title"]; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./css/login_base.css" />
</head>

<body>
  <section class="side" style="background: url(img\\bk.png) no-repeat;
    background-size: 94% 102%;">
  </section>
  <section >
    <div class="login-container">
      <div class="separator" ></div>
      <div id="main">
        <?php
          if(isset($templateParams["form"])){
              require($templateParams["form"]);
          }
        ?>
      </div>
    </div>
  </section>
  <p class="text-muted footer">&copy; 2017–2022</p>
  <?php
  if (isset($templateParams["js"])):
    foreach ($templateParams["js"] as $script):
  ?>
  <script src="<?php echo $script; ?>"></script>
  <?php
    endforeach;
  endif;
  ?>

</body>

</html>