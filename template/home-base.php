<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["title"]; ?></title>
    <!-- <link rel="stylesheet" type="text/css" href="../css/style.css" /> -->

</head>
<body>
    <header>
        <h1>HOME</h1>
    </header>
    <main>
        <p>
            <?php 
                if(isset($templateParams["username"])){
                    echo $templateParams["username"];
                }
                else{
                    echo $templateParams["error"];
                }
            ?>
        </P>
        <a href="logout.php">Logout</a>
        <!-- Generate with js -->
    </main>
    <footer>
        <p>Anno 2022/2023</p>
    </footer>

    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
    
</body>
</html>