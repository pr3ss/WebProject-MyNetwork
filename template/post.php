<?php foreach($templateParams["posts"] as $post): ?>
<div class="container bg-white m-1 " style="border-radius:10px;">
    <div class="row d-flex justify-content-center">
        <div class="col-3 d-flex flex-column justify-content-center align-items-center ">
            <img src="./img/logo.jpg" alt="Avatar" class="avatar">
        </div>
        <div class="col-5">
            <div class="row">
                <p class="m-0 user"><?php echo $post["user"] ?></p>
            </div>
            <div class="row">
                <p class="m-0 date"><?php echo $post["data"] ?></p>
            </div>
            <div class="row">
                <p class="m-0" style="font-size: small;">Luogo:cesena</p>
            </div>
        </div>
        <div class="col-2 d-flex flex-column justify-content-center">
            <div class="row justify-content-center">
                <button type="button" class="btn btnshadow"><i class="fa-solid fa-heart">
                        919</i></button>
            </div>
        </div>
        <div class="col-2 d-flex flex-column justify-content-center">
            <div class="row justify-content-center">
                <button type="button" class="btn btnshadow" onclick="openPost('<?php echo $post['user'] ?>')"><i class="fa-solid fa-comment">
                        100</i></button>
            </div>
        </div>
    </div>
    <img src=".\img\logo.jpg" class="card-img-top p-2" alt="..." onclick="openPost()">
    <div class="card-body" onclick="openPost()">
        <p class="card-text">Some quick example text to build on the card title and make up the
            bulk of
            the
            card's content.</p>
    </div>
</div>
<?php endforeach; ?>