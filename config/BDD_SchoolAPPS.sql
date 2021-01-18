#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: produits
#------------------------------------------------------------

CREATE TABLE produits(
        idProduit   int (11) Auto_increment  NOT NULL ,
        nomProduit  Varchar (32) NOT NULL ,
        description Text NOT NULL ,
        prixHT      Double NOT NULL ,
        dateSortie  Date NOT NULL ,
        nbrVues     Int NOT NULL ,
        nbrAchat    Int ,
        categorie   Int NOT NULL ,
        idCat       Int NOT NULL ,
        PRIMARY KEY (idProduit )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateurs
#------------------------------------------------------------

CREATE TABLE utilisateurs(
        idUtilisateur     int (11) Auto_increment  NOT NULL ,
        login             Varchar (32) NOT NULL ,
        nom               Varchar (32) NOT NULL ,
        prenom            Varchar (32) NOT NULL ,
        hashMdp           Varchar (40) NOT NULL ,
        emailFacturation  Varchar (25) NOT NULL ,
        emailLivraison    Varchar (25) ,
        telephone         Int ,
        dateNaissance     Date NOT NULL ,
        idTypeUtilisateur Int NOT NULL ,
        PRIMARY KEY (idUtilisateur ) ,
        UNIQUE (login )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: paniers
#------------------------------------------------------------

CREATE TABLE paniers(
        idPanier      int (11) Auto_increment  NOT NULL ,
        dateCreation  Date NOT NULL ,
        total         DECIMAL (15,3)  NOT NULL ,
        qteProduits   Int NOT NULL ,
        idProduit     Int NOT NULL ,
        idUtilisateur Int NOT NULL ,
        PRIMARY KEY (idPanier )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: tickets
#------------------------------------------------------------

CREATE TABLE tickets(
        idTicket                   int (11) Auto_increment  NOT NULL ,
        intitule                   Varchar (32) NOT NULL ,
        explication                Text ,
        idEtat                     Int NOT NULL ,
        idUtilisateur              Int NOT NULL ,
        idProduit                  Int NOT NULL ,
        idTechnicien Int NOT NULL ,
        PRIMARY KEY (idTicket )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: types_utilisateur
#------------------------------------------------------------

CREATE TABLE types_utilisateur(
        idTypeUtilisateur int (11) Auto_increment  NOT NULL ,
        typeUtilisateur   Varchar (32) NOT NULL ,
        PRIMARY KEY (idTypeUtilisateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: articles
#------------------------------------------------------------

CREATE TABLE articles(
        idArticles             int (11) Auto_increment  NOT NULL ,
        titreArticle           Varchar (32) NOT NULL ,
        corpsArticle           Longtext NOT NULL ,
        IllustrationPrinciaple Varchar (120) NOT NULL ,
        IllustrationSecondaire Varchar (120) NOT NULL ,
        idUtilisateur          Int NOT NULL ,
        idCatArt               Int NOT NULL ,
        PRIMARY KEY (idArticles )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: avis
#------------------------------------------------------------

CREATE TABLE avis(
        idAvis        int (11) Auto_increment  NOT NULL ,
        avis          Text NOT NULL ,
        noteProduit   Int NOT NULL ,
        idProduit     Int NOT NULL ,
        idUtilisateur Int NOT NULL ,
        PRIMARY KEY (idAvis )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: etats
#------------------------------------------------------------

CREATE TABLE etats(
        idEtat Int NOT NULL ,
        etat   Varchar (32) NOT NULL ,
        PRIMARY KEY (idEtat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categories
#------------------------------------------------------------

CREATE TABLE categories(
        idCat      int (11) Auto_increment  NOT NULL ,
        catProduit Varchar (32) NOT NULL ,
        PRIMARY KEY (idCat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: message
#------------------------------------------------------------

CREATE TABLE message(
        idMessage                  int (11) Auto_increment  NOT NULL ,
        message                    Text NOT NULL ,
        dateMsg                    Time NOT NULL ,
        idTicket                   Int NOT NULL ,
        idUtilisateur              Int NOT NULL ,
        idTechnicien Int NOT NULL ,
        PRIMARY KEY (idMessage )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categorieArticle
#------------------------------------------------------------

CREATE TABLE categorieArticle(
        idCatArt   int (11) Auto_increment  NOT NULL ,
        catArticle Varchar (32) NOT NULL ,
        PRIMARY KEY (idCatArt )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commandes
#------------------------------------------------------------

CREATE TABLE commandes(
        idCommandes   int (11) Auto_increment  NOT NULL ,
        dateAchat     Date NOT NULL ,
        idUtilisateur Int NOT NULL ,
        idPanier      Int NOT NULL ,
        PRIMARY KEY (idCommandes )
)ENGINE=InnoDB;

ALTER TABLE produits ADD CONSTRAINT FK_produits_idCat FOREIGN KEY (idCat) REFERENCES categories(idCat);
ALTER TABLE utilisateurs ADD CONSTRAINT FK_utilisateurs_idTypeUtilisateur FOREIGN KEY (idTypeUtilisateur) REFERENCES types_utilisateur(idTypeUtilisateur);
ALTER TABLE paniers ADD CONSTRAINT FK_paniers_idProduit FOREIGN KEY (idProduit) REFERENCES produits(idProduit);
ALTER TABLE paniers ADD CONSTRAINT FK_paniers_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE tickets ADD CONSTRAINT FK_tickets_idEtat FOREIGN KEY (idEtat) REFERENCES etats(idEtat);
ALTER TABLE tickets ADD CONSTRAINT FK_tickets_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE tickets ADD CONSTRAINT FK_tickets_idProduit FOREIGN KEY (idProduit) REFERENCES produits(idProduit);
ALTER TABLE tickets ADD CONSTRAINT FK_tickets_idTechnicien FOREIGN KEY (idTechnicien) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE articles ADD CONSTRAINT FK_articles_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE articles ADD CONSTRAINT FK_articles_idCatArt FOREIGN KEY (idCatArt) REFERENCES categorieArticle(idCatArt);
ALTER TABLE avis ADD CONSTRAINT FK_avis_idProduit FOREIGN KEY (idProduit) REFERENCES produits(idProduit);
ALTER TABLE avis ADD CONSTRAINT FK_avis_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE message ADD CONSTRAINT FK_message_idTicket FOREIGN KEY (idTicket) REFERENCES tickets(idTicket);
ALTER TABLE message ADD CONSTRAINT FK_message_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE message ADD CONSTRAINT FK_message_idTechnicien FOREIGN KEY (idTechnicien) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE commandes ADD CONSTRAINT FK_commandes_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE commandes ADD CONSTRAINT FK_commandes_idPanier FOREIGN KEY (idPanier) REFERENCES paniers(idPanier);


/* -- 
-- INSERTION
-- */

INSERT INTO `etats` (`idEtat`, `etat`) VALUES
(0, 'Fermé'),
(1, 'En cours'),
(2, 'Urgent'),
(3, 'En attente');

INSERT INTO `types_utilisateur` (`idTypeUtilisateur`, `typeUtilisateur`) VALUES
(1, 'admin'),
(2, 'technicien'),
(3, 'utilisateur');

INSERT INTO `utilisateurs` (`idUtilisateur`, `login`, `nom`, `prenom`, `hashMdp`, `emailFacturation`, `emailLivraison`, `telephone`, `dateNaissance`, `idTypeUtilisateur`) VALUES
(1, 'utilisateur', 'utilisateur', 'utilisateur', '$2y$10$90yGN9i3D0/TIJVoseZUN.qOf1SjmszFNSnC.QT9NLExI9FmmiHGi', 'utilisateur@hotmail.fr', 'utilisateur@hotmail.fr', 101010101, '2021-01-01', 3),
(2, 'technicien', 'technicien', 'technicien', '$2y$10$90yGN9i3D0/TIJVoseZUN.qOf1SjmszFNSnC.QT9NLExI9FmmiHGi', 'technicien@hotmail.fr', 'technicien@hotmail.fr', 202020202, '2021-01-02', 2),
(3, 'admin', 'admin', 'admin', '$2y$10$90yGN9i3D0/TIJVoseZUN.qOf1SjmszFNSnC.QT9NLExI9FmmiHGi', 'admin@hotmail.fr', 'admin@hotmail.fr', 303030303, '2021-01-03', 1);
