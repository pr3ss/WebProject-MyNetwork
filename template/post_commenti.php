<div class="container p-0 m-0 h-100 justify-content-center" style="overflow-y:auto;">
    <div class="container-fluid pt-2">
        <div class="row bg-white mr-2 ml-2 pt-1" style="border-radius: 10px;">
            <div class="col-12">
                <div class="row  justify-content-center">
                    <div class="col-3 d-flex flex-column  justify-content-center align-items-center">
                        <img src=".\img\<?php echo $templateParams["post"][0]["foto_profilo"]; ?>" alt="Avatar"
                            class="avatar">
                    </div>
                    <div class="col-5">
                        <div class="row">
                            <p class="m-0 user">
                                <?php echo $templateParams["post"][0]["username"]; ?>
                            </p>
                        </div>
                        <div class="row">
                            <p class="m-0" style="font-size: small;"><?php if (isset($templateParmas["post"][0]["luogo"])) {
                                echo "Luogo: " . $templateParmas["post"][0]["luogo"];
                            } ?></p>
                        </div>
                    </div>

                    <div class="col-4 d-flex flex-column justify-content-center">
                        <div class="row justify-content-center">
                            <button type="button" class="btn btnshadow btnLike_<?php echo $templateParams['post'][0]['id'] ?>" onclick="likePost(<?php echo $templateParams['post'][0]['id'] ?>)"><i class="fa-solid fa-heart">
                                    <?php echo $templateParams["post"][0]["miPiace"]; ?>
                                </i></button>
                        </div>
                    </div>
                </div>
                <?php if (isset($templateParams["post"][0]["img"])): ?>
                    <img src=".\img\<?php echo $templateParams["post"][0]["img"]; ?>" class="card-img-top p-2" alt="...">
                <?php endif; ?>
                <div class="row justify-content-center align-items-center">
                    <div class="col-3 date">
                        <?php echo date('Y-m-d', $templateParams["post"][0]["data_ora"]); ?>
                    </div>
                    <div class="col-9">
                        <p class="card-text"><?php echo $templateParams["post"][0]["testo"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row bg-white mr-2 ml-2 mt-2" style="border-radius: 10px;">
            <div class="col-2 d-flex flex-column justify-content-center align-items-center">
                <!--con aligin-item-center rimane sempre centrasto decidere se fissarlo al inizo riga o al centro-->
                <img src="./img/<?php echo $templateParams["post"][0]["foto_profilo"]; ?>" alt="Avatar" class="avatar">
            </div>
            <div class="col-8 d-flex flex-column justify-content-center align-items-center p-0">
                <input type="text" id="textComment" class="form-control" placeholder="Type comment..." />
            </div>
            <div class="col-2 d-flex flex-column justify-content-center ">
                <!--se metti align-item-center il tasto si ridimensione non rimane a grndezza fissa-->
                <button type="button" class="btn btn-dark btnshadow" onclick="addComment(<?php echo $templateParams['post'][0]['id']; ?>)"><i class="fa-solid fa-share"></i></button>
            </div>
        </div>

        <?php foreach ($templateParams["commenti"] as $commento): ?>
            <div class="row bg-white mr-2 ml-2 mt-2" style="border-radius: 10px;">
                <div class="col-2 d-flex flex-column justify-content-center">
                    <img src="./img/<?php echo $commento['foto_profilo']; ?>" alt="Avatar" class="avatar">
                </div>
                <div class="col-8 d-flex flex-column justify-content-center">
                    <div class="row">
                        <p class="m-0 user">
                            <?php echo $commento['username']; ?>
                        </p>
                    </div>
                    <div class="row">
                        <p class="m-0"><?php echo $commento["testo"]; ?></p>
                    </div>
                </div>
                <div class="col-2 d-flex flex-column justify-content-center">
                    <p class="m-1 date">
                        <?php echo date('Y-m-d', $commento['data_ora']); ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>