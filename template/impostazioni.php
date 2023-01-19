<div class="container-fluid">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="d-flex flex-column">
                <img src=".\img\<?php echo $templateParams["info"][0]["foto_profilo"] ?>" style="border-radius: 50%;">
            </div>
        </div>
        <div class="col-2 p-0 d-flex flex-column justify-content-end">
            <button class="btn p-0" style="font-size: 200%;"><i class="fa-solid fa-gear"></i></button>
        </div>
    </div>

    <div class="row mt-3 mb-5 d-flex justify-content-center">
        <input type="text" value="<?php echo $templateParams["info"][0]["username"] ?>" style="width:50% ;border:none; border: 1px solid #ccc; border-radius: 10px; text-align: center;" />
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
            <p class="m-0">Email:</p>
        </div>
        <div class="col-8 d-flex flex-column justify-content-center">
            <input type="text" value="<?php echo $templateParams["info"][0]["email"] ?>" style="width: 90%;  border:none; border: 1px solid #ccc; border-radius: 10px; text-align: center;" />
        </div>
    </div>

    <div class="row m-3 pb-2" style="border-bottom: 1px solid black;">
        <div class="col-4 d-flex flex-column justify-content-center ">
            <p class="m-0">Password:</p>
        </div>
        <div class="col-8 d-flex flex-column justify-content-center">
            <div class="row m-0">
                <div class="col-10">
                    <input id="password" type="password" value="test" style="width: 90%;  border:none; border: 1px solid #ccc; border-radius: 10px; text-align: center;" />
                </div>
                <div class="col-2">
                    <button id="btnViewPass" onclick="test5()" style="border: none;"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>


        </div>
    </div>


    <div class="row mt-5 d-flex justify-content-center">
        <div class="btn btn-primary" style="border-radius: 20px;">Salva</div>
    </div>
</div>