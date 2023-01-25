<div class="container-fluid">
    <div class="row bottom-linea">
        <div class="col-2"></div>
        <div class="col-8 d-flex flex-column">
            <img src="<?php echo IMG_DIR . $templateParams["info"][0]["foto_profilo"] ?>" alt=""
                class="img-fluid rounded-circle" style="aspect-ratio: 1/1; object-fit: cover;">
        </div>
        <div class="col-2"></div>
        <div class="col-12">
            <div class="row justify-content-center">
                <h2>
                    <?php echo $templateParams["info"][0]["username"] ?>
                </h2>
            </div>
        </div>
        <div class="col-6">
            <div class="row justify-content-center m-2">
                <?php echo "<button type='button' class='btn btn-font p-0' onclick='view_seguiti_follower(" . json_encode($templateParams["follower"]) . ")'><span  class='fa-solid fa-user' style='font-size: 110%;'>
                    " . count($templateParams["follower"]) . "</span> FOLLOWER </button>"
                    ?>
            </div>
        </div>
        <div class="col-6">
            <div class="row justify-content-center m-2">
                <?php echo "<button type='button' class='btn btn-font p-0' onclick='view_seguiti_follower(" . json_encode($templateParams["seguiti"]) . ")'><span  class='fa-solid fa-user' style='font-size: 110%;'>
                 " . count($templateParams["seguiti"]) . "</span> SEGUITI</button>"
                    ?>
            </div>
        </div>
        <div class="col-12">
            <div class="row justify-content-center">
                <p>
                    <?php echo $templateParams["info"][0]["descrizione"] ?>
                </p>
            </div>
        </div>
    </div>
    <?php foreach ($templateParams["posts"] as $post): ?>
        <div class="row mt-3 justify-content-center post">
            <!--Posts profilo-->
            <div class="container-fluid bg-white p-0 pt-1" style="border-radius: 10px;">
                <div class="row d-flex justify-content-center pl-3 pr-3">
                    <div class="col-4 d-flex flex-column justify-content-center">
                        <button type="button" class="btn w-100 btn-font btnLike_<?php echo $post['id'] ?>             <?php if ($post['asliked'] != null) {
                                            echo "btn-like";
                                        } ?>" onclick="likePost(<?php echo $post['id'] ?>)" aria-label="<?php if ($post['asliked'] != null) {
                                            echo "button add like";
                                        } else {
                                            echo "button remove like";
                                        } ?>"><span  class="fa-solid fa-heart" style="font-size: 150%;"></span> 
                            <?php echo $post["miPiace"] ?>
                        </button>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-center">
                        <button type="button" class="btn w-100 btn-font" onclick="openPost(<?php echo $post['id'] ?>)" aria-label="open comment"><span 
                                class="fa-solid fa-comment"  style="font-size: 150%;"></span> 
                            <?php echo $post["nCommenti"] ?>
                        </button>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-center">
                        <button type="button" class="btn w-100" onclick="deletePost(<?php echo $post['id'] ?>)" aria-label="delete post"><span 
                                class="fa-solid fa-trash" style="font-size: 150%;" ></span>  </button>
                    </div>
                </div>
                <?php if (isset($post["img"])): ?>
                    <img src="<?php echo IMG_DIR . $post["img"] ?>" class="img-fluid mt-1" alt=""
                        onclick="openPost(<?php echo $post['id'] ?>)">
                <?php endif; ?>
                <?php if ($post["testo"] != ""): ?>
                    <p class="mt-1" style="text-align: center;" onclick="openPost(<?php echo $post['id'] ?>)">
                        <?php echo $post["testo"]; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>