<div class="container-fluid">
    <div id="tmp_img" class="row justify-content-center bg-white m-2" style="border-radius: 10px;">
        <button class="btn" style="font-size: 300%;" onclick="add_image()"><i
                class="fa-solid fa-circle-plus"></i></button>

    </div>
    <div class="row justify-content-center mr-5 ml-5 mt-1">
        <label for="tmp_post_text" style="display: none;">Add text</label>
        <textarea id="tmp_post_text"  class="form-control" placeholder="Add text" ></textarea>
        <label for="tmp_post_luogo" style="display: none;">Add place</label>
        <input id="tmp_post_luogo" type="text" class="form-control" placeholder="Luogo" />
        <label for="tmp_post_cat" style="display: none;">Choose category</label>
        <select id="tmp_post_cat" class="form-select w-100 rounded-pill mt-2" aria-label="Default select example" style="color: #6C757D; text-align: center; border: #6C757D solid 1px;">
            <?php foreach($templateParams["categorie"] as $categoria): ?>
                <option  value="<?php echo $categoria["id"] ?>" <?php if($categoria['id']==1){echo "selected";} ?>><?php echo $categoria["titolo"] ?></option>
            <?php endforeach;?>
        </select>
        <input class="btn btnMagico active mt-4 w-100"  type="button" onclick="upload_post()" value="salva">
    </div>
</div>