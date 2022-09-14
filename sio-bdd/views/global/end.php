<div class="hero justify-content-center">

    <h1 class="text-white text-center">Félicitations</h1>

    <p class="text-white text-light text-center py-0 d-block p-0 m-3">
        Votre compte est maintenant créé.
    </p>

    <div class="d-flex flex-row justify-content-center" id="account">
        <?php
        foreach ($teams as $t) {
            ?>
            <div class="card mx-3">
                <div class="card-header text-center">Vos informations de connexions</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><b>Serveur :</b> 192.168.10.15</li>
                        <li><b>Port :</b> 3306</li>
                        <li><b>Base de données :</b> <?= $t["db"] ?></li>
                        <li><b>Utilisateur :</b> <?= $t["team"] ?></li>
                        <li><b>Mot de passe :</b> <?= $t["password"] ?></li>
                        <li><b>Permissions :</b> Create, Read, Update, Delete</li>
                    </ul>

                    <?php
                    if ($config["PMA_DOMAIN"]) {
                        ?>
                        <div class="text-center">
                            <a href="<?= $config["PMA_DOMAIN"] ?>" target="_blank" class="btn btn-primary rounded-pill d-inline-block m-auto">PhpMyAdmin</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="text-center pt-5">
        <a href="#" onclick="saveInfo()" class="btn btn-primary rounded-pill d-inline-block m-auto">Sauvegarder les informations</a>
    </div>
</div>

<script>
    function saveInfo(){
        html2canvas(document.querySelector("#account")).then(canvas => {
            var a = document.createElement('a');
            a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
            a.download = 'compte_<?= addslashes($t["team"]) ?>.jpg';
            a.click();
        });
    }
</script>