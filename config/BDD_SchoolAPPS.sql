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
        login             Varchar (25) NOT NULL ,
        nom               Varchar (10) NOT NULL ,
        prenom            Varchar (10) NOT NULL ,
        hashMdp           Varchar (64) NOT NULL ,
        emailFacturation  Varchar (25) NOT NULL ,
        emailLivraison    Varchar (25) ,
        telephone         Int NOT NULL ,
        dateNaissance     Date NOT NULL ,
        idTypeUtilisateur Int NOT NULL ,
        PRIMARY KEY (idUtilisateur ) ,
        UNIQUE (login )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: paniers
#------------------------------------------------------------

CREATE TABLE paniers(
        idPanier     int (11) Auto_increment  NOT NULL ,
        dateCreation Date NOT NULL ,
        total        DECIMAL (15,3)  NOT NULL ,
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
        idAvis      int (11) Auto_increment  NOT NULL ,
        avis        Text NOT NULL ,
        noteProduit Int NOT NULL ,
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
        catProduit Varchar (10) NOT NULL ,
        PRIMARY KEY (idCat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: message
#------------------------------------------------------------

CREATE TABLE message(
        idMessage                  int (11) Auto_increment  NOT NULL ,
        message                    Text NOT NULL ,
        dateMsg                    Time NOT NULL ,
        idUtilisateur              Int NOT NULL ,
        idTechnicien Int NOT NULL ,
        PRIMARY KEY (idMessage )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categorieArticle
#------------------------------------------------------------

CREATE TABLE categorieArticle(
        idCatArt   int (11) Auto_increment  NOT NULL ,
        catArticle Varchar (10) NOT NULL ,
        PRIMARY KEY (idCatArt )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commandes
#------------------------------------------------------------

CREATE TABLE commandes(
        idCommandes   int (11) Auto_increment  NOT NULL ,
        dateAchat     Date NOT NULL ,
        idUtilisateur Int NOT NULL ,
        PRIMARY KEY (idCommandes )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: juger
#------------------------------------------------------------

CREATE TABLE juger(
        idAvis        Int NOT NULL ,
        idUtilisateur Int NOT NULL ,
        idProduit     Int NOT NULL ,
        PRIMARY KEY (idAvis ,idUtilisateur ,idProduit )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: concernerTicket
#------------------------------------------------------------

CREATE TABLE concernerTicket(
        idTicket  Int NOT NULL ,
        idMessage Int NOT NULL ,
        PRIMARY KEY (idTicket ,idMessage )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: produitsPanier
#------------------------------------------------------------

CREATE TABLE produitsPanier(
        qteProduits   Int NOT NULL ,
        idProduit     Int NOT NULL ,
        idPanier      Int NOT NULL ,
        idUtilisateur Int NOT NULL ,
        PRIMARY KEY (idProduit ,idPanier ,idUtilisateur )
)ENGINE=InnoDB;

ALTER TABLE produits ADD CONSTRAINT FK_produits_idCat FOREIGN KEY (idCat) REFERENCES categories(idCat);
ALTER TABLE utilisateurs ADD CONSTRAINT FK_utilisateurs_idTypeUtilisateur FOREIGN KEY (idTypeUtilisateur) REFERENCES types_utilisateur(idTypeUtilisateur);
ALTER TABLE tickets ADD CONSTRAINT FK_tickets_idEtat FOREIGN KEY (idEtat) REFERENCES etats(idEtat);
ALTER TABLE tickets ADD CONSTRAINT FK_tickets_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE tickets ADD CONSTRAINT FK_tickets_idProduit FOREIGN KEY (idProduit) REFERENCES produits(idProduit);
ALTER TABLE tickets ADD CONSTRAINT FK_tickets_idTechnicien FOREIGN KEY (idTechnicien) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE articles ADD CONSTRAINT FK_articles_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE articles ADD CONSTRAINT FK_articles_idCatArt FOREIGN KEY (idCatArt) REFERENCES categorieArticle(idCatArt);
ALTER TABLE message ADD CONSTRAINT FK_message_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE message ADD CONSTRAINT FK_message_idTechnicien FOREIGN KEY (idTechnicien) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE commandes ADD CONSTRAINT FK_commandes_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE juger ADD CONSTRAINT FK_juger_idAvis FOREIGN KEY (idAvis) REFERENCES avis(idAvis);
ALTER TABLE juger ADD CONSTRAINT FK_juger_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
ALTER TABLE juger ADD CONSTRAINT FK_juger_idProduit FOREIGN KEY (idProduit) REFERENCES produits(idProduit);
ALTER TABLE concernerTicket ADD CONSTRAINT FK_concernerTicket_idTicket FOREIGN KEY (idTicket) REFERENCES tickets(idTicket);
ALTER TABLE concernerTicket ADD CONSTRAINT FK_concernerTicket_idMessage FOREIGN KEY (idMessage) REFERENCES message(idMessage);
ALTER TABLE produitsPanier ADD CONSTRAINT FK_produitsPanier_idProduit FOREIGN KEY (idProduit) REFERENCES produits(idProduit);
ALTER TABLE produitsPanier ADD CONSTRAINT FK_produitsPanier_idPanier FOREIGN KEY (idPanier) REFERENCES paniers(idPanier);
ALTER TABLE produitsPanier ADD CONSTRAINT FK_produitsPanier_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES utilisateurs(idUtilisateur);
