<!DOCTYPE html>
<html lang="it">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $templateParams["title"]; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/styleLogin_base.css" />
</head>

<body class="text-center">
  <header>
  </header>
  <main>
  </main>
  <footer>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
  </footer>

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