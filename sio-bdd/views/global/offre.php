<div class="hero">

    <div class="d-flex justify-content-center">
        <div class="card mx-5" style="width: 30vw">
            <form method="post" action="/createOffre" class="card-body d-flex flex-column justify-content-around">
                <input type="hidden" name="id" value="<?= $id ?>">
                <h5>Vous avez choisi l'offre <b><?= $id ?> compte<?= $id > 1 ? 's' : '' ?></b></h5>
                <div class="form-group pt-2">
                    <label for="teamName">Nom de votre équipe</label>
                    <input required type="text" class="form-control" id="teamName" name="team" aria-describedby="teamHelp" placeholder="Votre équipe">
                    <small id="teamHelp" class="form-text text-muted">Attention un seul choix possible ! </small>
                </div>

                <div class="pt-2 text-center">
                    <input type="submit" class="btn btn-primary" value="Créer le compte">
                </div>
            </form>
        </div>

        <div class="text-white">
            <img class="d-block m-auto" src="/public/images/experimental-22.png" height="180px">
            <h1>Créer votre compte</h1>
            <p><b>Attention</b> votre compte sera créé immédiatement.</p>
        </div>
    </div>

</div>