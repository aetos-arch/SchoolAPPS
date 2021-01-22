<?php

require_once 'modules/generique/vue_generique.php';

class VueContact extends VueGenerique
{

    public function __construct()
    {
    }

    public function pageContact()
    { ?>
        <div class="container content-block">
            <h1>Nous contacter</h1>
            <hr class="mt-2 mb-4">
            <div class="row">
                <div class="col-lg-5 m-2 p-1">
                    <h2>Par e-mail</h2>
                    <form action="contact/envoi-mail" method="POST">
                        <p>
                            Nous serons heureux d'apporter réponses à vos questions.
                            Votre demande concerne un produit acquis ? Connectez-vous et ouvrez un ticket <a href="/connexion/popConnexion">ici</a>.
                            Nos techniciens vous accompagneront avec la plus grande attention.<br>
                        </p>
                        <div class="form-group">
                            <label for="sujet">Sujet</label>
                            <input required type="sujet" class="form-control" name="sujet" id="sujet" aria-describedby="Champs sujet" placeholder="Sujet">
                        </div>
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input required type="text" class="form-control" name="name" id="name" aria-describedby="Champs nom" placeholder="Votre nom">
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input required type="text" class="form-control" name="prenom" id="prenom" aria-describedby="Champs prenom" placeholder="Votre prénom">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input required type="email" class="form-control" name="email" id="email" aria-describedby="Champs email" placeholder="votre@email.com">

                        </div>
                        <div class="form-group">
                            <label for="message">Votre message</label>
                            <textarea required class="form-control" name="message" id="message" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
                <div class="col-lg m-2 p-1">
                    <div class="row container-fluid">
                        <h2>Sur nos réseaux sociaux</h2>
                        <div class="mx-auto" id="contact-social">
                            <a href="#"> <i class="fab fa-twitter"></i> </a>
                            <a href="#"> <i class="fab fa-facebook-square"></i> </a>
                            <a href="#"> <i class="fab fa-youtube"></i> </a>
                            <a href="#"> <i class="fab fa-linkedin-in"></i> </a>
                        </div>
                    </div>
                    <div class="content-block">
                        <h2>Nous situer</h2>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.77831866901!2d2.4619861155551392!3d48.86243747928795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e612ae6a4cd20d%3A0xfe5502b116430be!2sIUT%20De%20Montreuil!5e0!3m2!1sfr!2sfr!4v1611219092899!5m2!1sfr!2sfr" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }


    public function confirmationEnvoiMail() {
    ?>
        <div class="container-fluid row">
            <div class="login-form">
                <div class="big-info">
                    <h1>E-mail bien envoyé !</h1>
                </div><br>
                <h1 class="big-info" id="error-h1"><a class="big-info btn btn-outline-success" href="/home">Page d'accueil</a>
                </h1>
            </div>
        </div>
    <?php
    }                                  
  }