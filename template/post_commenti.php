<div id="post_singolo" class=" container p-0 m-0 mb-3 h-100 justify-content-center" style="overflow-y:auto;">
    <div class="post container-fluid pt-2">
        <div class="row mr-2 ml-2 pt-1" style="border-radius: 10px;">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-3 d-flex flex-column  justify-content-center align-items-center">
                        <img src="<?php echo IMG_DIR . $templateParams["post"][0]["foto_profilo"]; ?>"
                            onclick="openOtherUser(<?php echo $templateParams['post'][0]['id_user_create'] ?>)"
                            alt="Avatar" class="avatar img-fluid rounded-circle">
                    </div>
                    <div class="col-5">
                        <div class="row m-0"
                            onclick="openOtherUser(<?php echo $templateParams['post'][0]['id_user_create'] ?>)">
                            <h3 class="m-0 user">
                                <?php echo $templateParams['post'][0]["username"] ?>
                            </h3>
                        </div>
                        <?php if (isset($templateParams['post'][0]["luogo"])) {
                            echo "<div class='row m-0'><p class='m-0'>Luogo: " . $templateParams['post'][0]["luogo"] . "</p></div>";
                        } ?>
                        <p class="m-0">
                        <?php echo date('Y-m-d', $templateParams["post"][0]["data_ora"]); ?>
                        </p>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-center">
                        <div class="row justify-content-center">
                            <button type="button" class="btn p-0 btnLike_<?php echo $templateParams['post'][0]['id'] ?> <?php if ($templateParams['post'][0]['asliked'] != null) {
                                    echo "btn-danger";
                                } ?>" onclick="likePost(<?php echo $templateParams['post'][0]['id'] ?>)"><i
                                    class="fa-solid fa-heart" style="font-size: 150%;">
                                    <?php echo $templateParams["post"][0]["miPiace"]; ?>
                                </i></button>
                        </div>
                    </div>
                </div>
                <?php if (isset($templateParams["post"][0]["img"])): ?>
                    <img src="<?php echo IMG_DIR . $templateParams["post"][0]["img"]; ?>" class="img-fluid" alt="...">
                <?php endif; ?>
                <div class="row justify-content-center align-items-center">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                        <?php echo $templateParams["post"][0]["testo"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mr-2 ml-2 mt-2" style="border-radius: 10px;">
            <div class="col-2 d-flex flex-column justify-content-center align-items-center">
                <!--con aligin-item-center rimane sempre centrasto decidere se fissarlo al inizo riga o al centro-->
                <img src="<?php echo IMG_DIR . $_SESSION['foto_profilo']; ?>" alt="Avatar"
                    class="avatar img-fluid rounded-circle">
            </div>
            <div class="col-8 d-flex flex-column justify-content-center align-items-center p-0">
                <input type="text" id="textComment" class="form-control" placeholder="Type comment..." />
            </div>
            <div class="col-2 d-flex flex-column justify-content-center ">
                <!--se metti align-item-center il tasto si ridimensione non rimane a grndezza fissa-->
                <button type="button" class="btn btn-dark btnshadow"
                    onclick="addComment(<?php echo $templateParams['post'][0]['id']; ?>)"><i
                        class="fa-solid fa-share"></i></button>
            </div>
        </div>
        <?php foreach ($templateParams["commenti"] as $commento): ?>
            <div class="row  mr-2 ml-2 mt-2" style="border-radius: 10px;">
                <div class="col-2 d-flex flex-column justify-content-center">
                    <img src="<?php echo IMG_DIR . $commento['foto_profilo']; ?>" alt="Avatar"
                        class="avatar img-fluid rounded-circle"
                        onclick="openOtherUser(<?php echo $commento['user_id']; ?>)">
                </div>
                <div class="col-7 d-flex flex-column justify-content-center">
                    <div class="row" onclick="openOtherUser(<?php echo $commento['user_id']; ?>)">
                        <p class="m-0 " style="font-weight: bold;;">
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