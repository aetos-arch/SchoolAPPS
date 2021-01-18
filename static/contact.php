<main>
    <?php require 'include/inc_derniers_actus.php' ?>
    <div class="container content-block">
        <h1>Nous contacter</h1>
        <form>
            <h2>Grâce à notre formulaire</h2>
            <p>
                Pour toutes vos questions nous serons heureux de vous apporter une réponse.<br>
                Si votre demande concerne un produit, vous pouvez ouvrir un ticket en vous connectant <a href="conexion">ici</a>,
                nos techniciens vous accompagneront avec la plus grande attention.<br>
                <a href="logiciels">Et n'hésitez pas à donner votre avis sur nos logiciels !</a><br>
            </p>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" aria-describedby="Champs nom" placeholder="Votre nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" aria-describedby="Champs prenom" placeholder="Votre prénom">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="Champs email" placeholder="Enter email">

            </div>
            <div class="form-group">
                <label for="message">Votre message</label>
                <textarea class="form-control" id="message" rows="3"></textarea>
            </div>
            <div class="form-check">
                <small id="emailHelp" class="form-text text-muted d-block">Nous veillerons à la sécurité de vos données</small>
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Suivre par mail</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <div class="container content-block">
        <h2>Par mail</h2>

    </div>
    <div class="container content-block">
        <h2>Sur nos réseaux sociaux</h2>

    </div>
    <div class="container content-block">
        <h2>Ou directement dans nos locaux</h2>

    </div>
</main>