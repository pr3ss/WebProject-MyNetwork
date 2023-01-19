<div id="utenti" class="backthing row h-50" style="overflow-y: auto;">
    <div class="col-12">
        <div id="list_utenti" class="list-group p-0">
            <?php foreach ($templateParams["listaAccount"] as $user): ?>
                <button id="btnUtente<?php echo $user['id'] ?>" type="button"
                    class="list-group-item list-group-item-action"
                    onclick="openUser(<?php echo $user['id'] ?>)">
                    <?php echo $user['username'] ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</div>