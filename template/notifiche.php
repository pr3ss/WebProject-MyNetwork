<div id="notifiche" class="container p-0 m-0 h-100 justify-content-center " style="overflow-y:auto;">
    <?php foreach ($templateParams["notifiche"] as $notifica): ?>
        <div id="not_<?php echo $notifica['id']; ?>" class="row  mr-1 ml-1 mt-2 p-1 bottom-linea <?php if ($notifica['vista'] == 1) {
            echo '';
        } else {
            echo 'bg-NuovaNotifica';
            ;
        } ?>" onclick="<?php if ($notifica['idTipo'] == 4) {
             echo 'openOtherUser(' . $notifica['idMittente'] . ')';
         } else {
             echo 'openPost(' . $notifica['post'] . ')';
         } ?>, notificaVista(<?php echo $notifica['id']; ?>)">
            <div class="col-3 p-1 d-flex flex-column justify-content-center">
                <img src="<?php echo IMG_DIR . $notifica["foto_profilo"] ?>" alt=""
                    class="img-fluid rounded-circle avatar">
            </div>
            <div class="col-9">
                <div class="row align-items-center" style="height:100%;">
                    <p class="p-2 m-0">
                        <?php echo $notifica["username"] ?> :
                        <?php echo $notifica["descrizione"] ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>