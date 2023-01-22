<div class="container-fluid">
    <div class="row bg-white ">
        <div class="col-2"></div>
        <div class="col-8 d-flex flex-column">
            <img src="<?php echo IMG_DIR . $templateParams["info"][0]["foto_profilo"] ?>" alt="..." class="img-fluid rounded-circle" style="aspect-ratio: 1; object-fit: cover;">
        </div>
        <div class="col-2"></div>
        <div class="col-12">
            <div class="row justify-content-center">
                <p>
                    <?php echo $templateParams["info"][0]["username"] ?>
                </p>
            </div>
        </div>
        <div class="col-6">
            <div class="row justify-content-center m-2">
                <?php echo "<button type='button' class='btn btnshadow ' onclick='view_seguiti_follower(" . json_encode($templateParams["follower"]) . ")'><i class='fa-solid fa-user'>
                    " . count($templateParams["follower"]) . "  FOLLOWER</i></button>"
                    ?>
            </div>
        </div>
        <div class="col-6">
            <div class="row justify-content-center m-2">
                <?php echo "<button type='button' class='btn btnshadow btn-dark' onclick='view_seguiti_follower(" . json_encode($templateParams["seguiti"]) . ")'><i class='fa-solid fa-user'>
                 " . count($templateParams["seguiti"]) . "  SEGUITI</i></button>"
                    ?>
                <!--  <button type="button" class="btn btnshadow btn-dark" onclick="viewSeguiti()"><i class="fa-solid fa-user">  SEGUITI</i></button> -->
            </div>
        </div>
        <div class="col-12">
            <dic class="row justify-content-center">
                <p>
                    <?php echo $templateParams["info"][0]["descrizione"] ?>
                </p>
            </dic>
        </div>
    </div>
    <?php foreach ($templateParams["posts"] as $post): ?>
        <div class="row mt-3 justify-content-center">
            <!--Posts profilo-->
            <div class="container-fluid bg-white p-0" style="border-radius: 10px;">
                <div class="row d-flex justify-content-center pl-3 pr-3">
                    <div class="col-4 d-flex flex-column justify-content-center">
                        <button type="button" class="btn p-0 w-100 btnLike_<?php echo $post['id'] ?>     <?php if ($post['asliked'] != null) {
                                    echo "btn-danger";
                                } ?>" onclick="likePost(<?php echo $post['id'] ?>)"><i class="fa-solid fa-heart"
                                style="font-size: 150%;">
                                <?php echo $post["miPiace"] ?>
                            </i></button>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-center">
                        <button type="button" class="btn w-100" onclick="openPost(<?php echo $post['id'] ?>)"><i
                                class="fa-solid fa-comment" style="font-size: 150%;">
                                    <?php echo $post["nCommenti"] ?>
                            </i></button>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-center">
                        <button type="button" class="btn w-100" onclick="deletePost(<?php echo $post['id'] ?>)"><i
                                class="fa-solid fa-trash" style="font-size: 150%;"></i></button>
                    </div>
                </div>
                <?php if (isset($post["img"])): ?>
                    <img src="<?php echo IMG_DIR . $post["img"] ?>" class="card-img-top p-2" alt="..."
                        onclick="openPost(<?php echo $post['id'] ?>)">
                <?php endif; ?>
                <div class="card-body" onclick="openPost(<?php echo $post['id'] ?>)">
                    <p class="card-text">
                        <?php echo $post["testo"]; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>