<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["title"]; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/home_base.css" />
</head>

<body>

    <div class="container-fluid" style="text-align: center;">
        <div class="row">
            <div class="col-2">PRofilo</div>
            <div class="col-3">PRofilo</div>
            <div class="col-3">Like</div>
            <div class="col-3">Commenti</div>
            <div class="col-1">MENU</div>
        </div>
        <div class="row" id="homefeed">
            
        </div>
    </div>

    <?php
    if (isset($templateParams["js"])):
        foreach ($templateParams["js"] as $script):
    ?>
    <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
   <!--  <div class="container-fluid" style="min-height: 100vh;">
        <div class="row">
            <div class="col-lg-4 test" style="min-height: 10vh;background-color: green;"></div>
            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-10 col-lg-12 order-lg-2" style="min-height: 10vh;background-color: red"></div>
                    <div class="col-2 col-lg-12 order-lg-1" style="min-height: 10vh;background-color: black;"></div>
                </div>
            </div>
            <div class="col-lg-4 test" style="min-height: 10vh;background-color: blue"></div>
        </div>
    </div> -->

</body>

</html>