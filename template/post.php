<?php foreach ($templateParams["posts"] as $post): ?>
    <div class="container mt-1 post p-0">
        <div class="row d-flex justify-content-center">
            <div class="col-3 d-flex flex-column justify-content-center align-items-center ">
                <img src="./img/<?php echo $post["foto_profilo"] ?>" alt="Avatar" class="avatar img-fluid rounded-circle"
                    onclick="openOtherUser(<?php echo $post['id_user_create'] ?>)">
            </div>
            <div class="col-4 pl-4 mt-1 d-flex flex-column justify-content-center">
                <div class="row m-0" onclick="openOtherUser(<?php echo $post['id_user_create'] ?>)">
                    <h2 class="m-0 user">
                        <?php echo $post["username"] ?>
                    </h2>
                </div>
                <?php if (isset($post["luogo"])) {
                    echo "<div class='row m-0'><p class='m-0'>Luogo: " . $post["luogo"] . "</p></div>";
                } ?>
                <div class="row m-0">
                    <p class="m-0">
                        <?php echo date('Y-m-d', $post["data_ora"]); ?>
                    </p>
                </div>
            </div>
            <div class="col-2 d-flex flex-column justify-content-center p-0 m-0">
                <div class="row justify-content-center ">
                    <button type="button" class="btn p-0 btnLike_<?php echo $post['id'] ?>"
                        onclick="likePost(<?php echo $post['id'] ?>)"><i class="fa-solid fa-heart" style="font-size: 150%;">
                            <?php echo $post["miPiace"] ?>
                        </i></button>
                </div>
            </div>
            <div class="col-2 d-flex flex-column justify-content-center p-0 m-0">
                <div class="row justify-content-center">
                    <button type="button" class="btn p-0" onclick="openPost(<?php echo $post['id'] ?>)"><i
                            class="fa-solid fa-comment" style="font-size: 150%;">
                            <?php echo $post["nCommenti"] ?>
                        </i></button>
                </div>
            </div>
        </div>
        <?php if (isset($post["img"])): ?>
            <img src=".\img\<?php echo $post["img"] ?>" class="img-fluid" alt="...">
        <?php endif; ?>
        <div class="row">
            <div class="col-9 offset-3">
                <p class="" onclick="openPost(<?php echo $post['id'] ?>)">
                    <?php echo $post["testo"]; ?>
                </p>
            </div>
        </div>

    </div>
<?php endforeach; ?>