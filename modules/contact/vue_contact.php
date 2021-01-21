<?php

require_once 'modules/generique/vue_generique.php';

class VueContact extends VueGenerique
{

    public function __construct()
    {
    }

    public function pageContact()
    {
?> <div class="container content-block">
            <h1>Nous contacter</h1>

            <div class="container content-block">
                <h2>Par e-mail</h2>
                <form action="contact/envoi-mail" method="POST">
                    <p>
                        Pour toutes vos questions nous serons heureux de vous apporter une réponse.<br>
                        Si votre demande concerne un produit, vous pouvez ouvrir un ticket en vous connectant <a href="conexion">ici</a>,
                        nos techniciens vous accompagneront avec la plus grande attention.<br>
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
                        <input required type="email" class="form-control" name="email" id="email" aria-describedby="Champs email" placeholder="Votre email">

                    </div>
                    <div class="form-group">
                        <label for="message">Votre message</label>
                        <textarea required class="form-control" name="message" id="message" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>


        </div>
        <div class="container content-block">
            <h2>Sur nos réseaux sociaux</h2>
            <div id="footer-social">
                <a href="#"> <i class="fab fa-twitter"></i> </a>
                <a href="#"> <i class="fab fa-facebook-square"></i> </a>
                <a href="#"> <i class="fab fa-youtube"></i> </a>
                <a href="#"> <i class="fab fa-linkedin-in"></i> </a>
            </div>
        </div>
        <div class="container content-block">
            <h2>Ou directement dans nos locaux</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.77831866901!2d2.4619861155551392!3d48.86243747928795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e612ae6a4cd20d%3A0xfe5502b116430be!2sIUT%20De%20Montreuil!5e0!3m2!1sfr!2sfr!4v1611219092899!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div> <?php
            }


            public function confirmationEnvoiMail()
            {
                // to do
            }
        }
