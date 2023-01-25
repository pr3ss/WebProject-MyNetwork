<div id="post_singolo" class=" container p-0 m-0 mb-3 h-100 justify-content-center"
    style="overflow-y:auto; overflow-x: hidden;">
    <div class="container post ">
        <div class="row d-flex justify-content-center">
            <div class="col-3 p-0 d-flex flex-column justify-content-center align-items-center ">
                <img src="<?php echo IMG_DIR . $templateParams['post'][0]['foto_profilo'] ?>"
                    alt="" class="avatar-home"
                    onclick="openOtherUser(<?php echo $templateParams['post'][0]['id_user_create']; ?>)">
            </div>
            <div class="col-4 d-flex flex-column justify-content-center">
                <div class="row p-0"
                    onclick="openOtherUser(<?php echo $templateParams['post'][0]['id_user_create'] ?>)">
                    <h2 class="m-0" style="font-size: 150%;">
                        <?php echo $templateParams['post'][0]["username"] ?>
                    </h2>
                </div>
                <?php if (isset($templateParams['post'][0]["luogo"])) {
                    echo "<div class='row p-0'><p class='m-0'>Luogo: " . $templateParams['post'][0]["luogo"] . "</p></div>";
                } ?>
                <div class="row p-0">
                    <p class="m-0">
                        <?php echo date('Y-m-d', $templateParams['post'][0]["data_ora"]); ?>
                    </p>
                </div>
            </div>
            <div class="col-4 d-flex flex-column justify-content-center  ">
                <div class="row justify-content-center ">
                    <button type="button" class="btn btn-font btnLike_<?php echo $templateParams['post'][0]['id'] ?>         <?php if ($templateParams['post'][0]['asliked'] != null) {
                                    echo "btn-like";
                                } ?>" onclick="likePost(<?php echo $templateParams['post'][0]['id'] ?>)"><span 
                            class="fa-solid fa-heart" alt="<?php if ($post['asliked'] != null) {
                                echo "button add like";
                            } else {
                                echo "button remove like";
                            } ?>" style="font-size: 150%;"></span> 
                        <?php echo $templateParams['post'][0]['miPiace'] ?>
                    </button>
                </div>
            </div>
        </div>
        <?php if (isset($templateParams["post"][0]["img"])): ?>
            <img src="<?php echo IMG_DIR . $templateParams["post"][0]["img"] ?>" class="img-fluid m-0 mt-1">
        <?php endif; ?>
        <?php if ($templateParams["post"][0]["testo"] != ""): ?>
            <div class="row">
                <div class="col-9 offset-3 p-0">
                    <p>
                        <?php echo $templateParams["post"][0]["testo"]; ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="container-fluid p-0">
        <div class="row m-0 mt-2" style="border-radius: 10px;">
            <div class="col-2 d-flex flex-column justify-content-center align-items-center">
                <img src="<?php echo IMG_DIR . $_SESSION['foto_profilo']; ?>"
                    class="avatar img-fluid rounded-circle">
            </div>
            <div class="col-8 d-flex flex-column justify-content-center align-items-center p-0">
                <input type="text" id="textComment" class="form-control" placeholder="Type comment..." />
            </div>
            <div class="col-2 d-flex flex-column justify-content-center p-0 pl-1 ">
                <button type="button" class="btn btnMagic active" style="border-radius: 10%;"
                    onclick="addComment(<?php echo $templateParams['post'][0]['id']; ?>)"><i alt="submit comment"
                        class="fa-regular fa-share-from-square"></i></button>
            </div>
        </div>
        <?php foreach ($templateParams["commenti"] as $commento): ?>
            <div class="row bottom-linea mr-2 ml-2 mt-2 pb-1">
                <div class="col-2 d-flex flex-column justify-content-center">
                    <img src="<?php echo IMG_DIR . $commento['foto_profilo']; ?>"
                        alt="" class="avatar img-fluid rounded-circle"
                        onclick="openOtherUser(<?php echo $commento['user_id']; ?>)">
                </div>
                <div class="col-7 d-flex flex-column justify-content-center">
                    <div class="row" onclick="openOtherUser(<?php echo $commento['user_id']; ?>)">
                        <p class="m-0 " style="font-weight: bold;">
                            <?php echo $commento['username']; ?>
                        </p>
                    </div>
                    <div class="row">
                        <p class="m-0">
                            <?php echo $commento["testo"]; ?>
                        </p>
                    </div>
                </div>
                <div class="col-3 d-flex flex-column justify-content-center">
                    <p class="m-0" style="font-size: 80%; text-align: right;">
                        <?php echo date('Y-m-d', $commento['data_ora']); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>