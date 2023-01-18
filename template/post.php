<?php foreach($templateParams["posts"] as $post): ?>
<div class="container bg-white m-1 " style="border-radius:10px ;">
    <div class="row d-flex justify-content-center">
        <div class="col-3 d-flex flex-column justify-content-center align-items-center ">
            <img src="./img/<?php echo $post["foto_profilo"] ?>" alt="Avatar" class="avatar">
        </div>
        <div class="col-5">
            <div class="row">
                <p class="m-0 user"><?php echo $post["username"] ?></p>
            </div>
            <div class="row">
                <p class="m-0 date"><?php echo date('Y-m-d',$post["data_ora"]); ?></p>
            </div>
            <div class="row">
                <p class="m-0" style="font-size: small;"><?php if(isset($post["luogo"])){ echo "Luogo: ".$post["luogo"]; } ?></p>
            </div>
        </div>
        <div class="col-2 d-flex flex-column justify-content-center">
            <div class="row justify-content-center">
                <button type="button" class="btn btnshadow"><i class="fa-solid fa-heart">
                <?php echo $post["miPiace"] ?></i></button>
            </div>
        </div>
        <div class="col-2 d-flex flex-column justify-content-center">
            <div class="row justify-content-center">
                <button type="button" class="btn btnshadow" onclick="openPost(<?php echo $post['id'] ?>)"><i class="fa-solid fa-comment">
                <?php echo $post["nCommenti"] ?></i></button>
            </div>
        </div>
    </div>
    <?php if(isset( $post["img"] )): ?>
    <img src=".\img\<?php echo $post["img"] ?>" class="card-img-top p-2" alt="...">
    <?php endif; ?>
    <div class="card-body"onclick="openPost(<?php echo $post['id'] ?>)">
        <p class="card-text"><?php echo $post["testo"];?></p>
    </div>
</div>
<?php endforeach; ?>