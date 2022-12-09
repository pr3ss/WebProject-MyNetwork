<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["title"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
	<?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>

</head>
<body>
    <header>
        <h1>socialnetwork</h1>
    </header>
    <main>
    <?php
    if(isset($templateParams["name"])){
        require($templateParams["name"]);
    }
    ?>
    </main>
    <footer>
        <p>Tecnologie Web - A.A. 2019/2020</p>
    </footer>
</body>
</html>