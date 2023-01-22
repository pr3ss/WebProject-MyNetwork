<div class="container-fluid">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="d-flex flex-column">
                <img id="foto_profilo" src="<?php echo IMG_DIR.$templateParams["info"][0]["foto_profilo"] ?>" class="img-fluid rounded-circle" style="aspect-ratio: 1; object-fit: cover;">
            </div>
        </div>
        <div class="col-2 p-0 d-flex flex-column justify-content-end">
            <button class="btn p-0" style="font-size: 200%;"><i class="fa-solid fa-gear" onclick="cambia_foto_profilo()"></i></button>
        </div>
    </div>

    <div class="row mt-3 mb-5 d-flex justify-content-center">
        <input id="my_username" type="text" placeholder="<?php echo $templateParams["info"][0]["username"] ?>" style="width:50% ;border:none; border: 1px solid #ccc; border-radius: 10px; text-align: center;" />
    </div>

    <div class="row m-3 pb-2" style="border-bottom: 1px solid black;">
        <div class="col-4 d-flex flex-column justify-content-center ">
            <p class="m-0">Nome:</p>
        </div>
        <div class="col-8 d-flex flex-column justify-content-center">
            <p class="m-0"><?php echo $templateParams["info"][0]["nome"] ?></p>
        </div>
    </div>
    <div class="row m-3 pb-2" style="border-bottom: 1px solid black;">
        <div class="col-4 d-flex flex-column justify-content-center ">
            <p class="m-0">Cognome: </p>
        </div>
        <div class="col-8 d-flex flex-column justify-content-center">
            <p class="m-0"><?php echo $templateParams["info"][0]["cognome"] ?></p>
        </div>
    </div>

    <div class="row m-3 pb-2" style="border-bottom: 1px solid black;">
        <div class="col-4 d-flex flex-column justify-content-center ">
            <p class="m-0">Data di nascita:</p>
        </div>
        <div class="col-8 d-flex flex-column justify-content-center">
            <p class="m-0"><?php echo $templateParams["info"][0]["data_di_nascita"] ?></p>
        </div>
    </div>

    <div class="row m-3 pb-2" style="border-bottom: 1px solid black;">
        <div class="col-4 d-flex flex-column justify-content-center ">
            <p class="m-0">Descrizione:</p>
        </div>
        <div class="col-8 d-flex flex-column justify-content-center">
            <input id="descrizione" type="text" value="<?php echo $templateParams["info"][0]["descrizione"] ?>" style="width: 90%;  border:none; border: 1px solid #ccc; border-radius: 10px; text-align: center;" />
        </div>
    </div>

    <div class="row m-3 pb-2" style="border-bottom: 1px solid black;">
        <div class="col-4 d-flex flex-column justify-content-center ">
            <p class="m-0">Email:</p>
        </div>
        <div class="col-8 d-flex flex-column justify-content-center">
            <input id="email" type="text" placeholder="<?php echo $templateParams["info"][0]["email"] ?>" style="width: 90%;  border:none; border: 1px solid #ccc; border-radius: 10px; text-align: center;" />
        </div>
    </div>

    <div class="row m-3 pb-2" style="border-bottom: 1px solid black;">
        <div class="col-4 d-flex flex-column justify-content-center ">
            <p class="m-0">New Password:</p>
        </div>
        <div class="col-8 d-flex flex-column justify-content-center">
            <div class="row m-0">
                <div class="col-10 p-0">
                    <input id="password" type="password" value="" style="width: 90%;  border:none; border: 1px solid #ccc; border-radius: 10px; text-align: center;" />
                </div>
                <div class="col-2 p-0">
                    <div id="btnViewPass" onclick="viewPassword()" style="border: none;"><i class="fa-solid fa-eye"></i></div>
                </div>
            </div>


        </div>
    </div>


    <div class="row mt-5 d-flex justify-content-center">
        <div class="btn btn-primary" style="border-radius: 20px;" onclick="salva_info()">Salva</div>
    </div>
</div>