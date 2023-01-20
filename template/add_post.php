<div class="container-fluid">
    <div id="tmp_img" class="row justify-content-center bg-white m-2" style="border-radius: 10px;">
        <button class="btn" style="font-size: 300%;" onclick="add_image()"><i
                class="fa-solid fa-circle-plus"></i></button>

    </div>
    <div class="row justify-content-center mr-5 ml-5 mt-1">
        <input id="tmp_post_text" type="text" id="addANote" class="form-control" placeholder="Add text" />
        <input id="tmp_post_luogo" type="text" id="addANote" class="form-control" placeholder="Luogo" />
        <select id="tmp_post_cat" class="form-select" aria-label="Default select example">
            <?php foreach($templateParams["categorie"] as $categoria): ?>
                <option  value="<?php echo $categoria["id"] ?>" <?php if($categoria['id']==1){echo "selected";} ?>><?php echo $categoria["titolo"] ?></option>
            <?php endforeach;?>
        </select>


    </div>
    <div class="row justify-content-center mt-4 w-100">
        <div class="btn btn-primary w-50" onclick="upload_post()">Salva</div>
    </div>
</div>