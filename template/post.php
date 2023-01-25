<?php foreach ($templateParams["posts"] as $post): ?>
    <div class="container post ">
        <div class="row d-flex justify-content-center">
            <div class="col-3 p-0 d-flex flex-column justify-content-center align-items-center ">
                <img src="<?php echo IMG_DIR . $post["foto_profilo"] ?>"
                    alt="" class="avatar-home"
                    onclick="openOtherUser(<?php echo $post['id_user_create'] ?>)">
            </div>
            <div class="col-4 d-flex flex-column justify-content-center">
                <div class="row p-0" onclick="openOtherUser(<?php echo $post['id_user_create'] ?>)">
                    <h2 class="m-0" style="font-size: 150%;">
                        <?php echo $post["username"] ?>
                    </h2>
                </div>
                <?php if (isset($post["luogo"])) {
                    echo "<div class='row p-0'><p class='m-0'>Luogo: " . $post["luogo"] . "</p></div>";
                } ?>
                <div class="row p-0">
                    <p class="m-0">
                        <?php echo date('Y-m-d', $post["data_ora"]); ?>
                    </p>
                </div>
            </div>
            <div class="col-2 d-flex flex-column justify-content-center  ">
                <div class="row justify-content-center ">
                    <button type="button" class="btn btn-font btnLike_<?php echo $post['id'] ?>     <?php if ($post['asliked'] != null) {
                                echo "btn-like";
                            } ?>" onclick="likePost(<?php echo $post['id'] ?>)"><span  class="fa-solid fa-heart" alt="<?php if ($post['asliked'] != null) {
                                echo "button add like";
                            } else {
                                echo "button remove like";
                            } ?>"
                            style="font-size: 150%;"></span> 
                            <?php echo $post["miPiace"] ?>
                    </button>
                </div>
            </div>
            <div class="col-2 d-flex flex-column justify-content-center  ">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-font" onclick="openPost(<?php echo $post['id'] ?>)"><span 
                            class="fa-solid fa-comment" alt="open comment" style="font-size: 150%;"></span> 
                            <?php echo $post["nCommenti"] ?>
                    </button>
                </div>
            </div>
        </div>
        <?php if (isset($post["img"])): ?>
            <img src="<?php echo IMG_DIR . $post["img"] ?>" class="img-fluid m-0 mt-1" alt=""
                onclick="openPost(<?php echo $post['id'] ?>)">
        <?php endif; ?>
        <?php if ($post["testo"] != ""): ?>
            <div class="row">
                <div class="col-9 offset-3 p-0">
                    <p class="" onclick="openPost(<?php echo $post['id'] ?>)">
                        <?php echo $post["testo"]; ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>