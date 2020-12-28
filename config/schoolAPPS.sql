#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Produits
#------------------------------------------------------------

CREATE TABLE Produits(
        idProduit   Int NOT NULL ,
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
# Table: Utilisateurs
#------------------------------------------------------------

CREATE TABLE Utilisateurs(
        idUtilisateur     Int NOT NULL ,
        nom               Varchar (10) NOT NULL ,
        prenom            Varchar (10) NOT NULL ,
        login             Varchar (25) NOT NULL ,
        hashMdp           Varchar (32) NOT NULL ,
        emailFacturation  Varchar (25) NOT NULL ,
        emailLivraison    Varchar (25) ,
        telephone         Int NOT NULL ,
        idTypeUtilisateur Int NOT NULL ,
        idPanier          Int NOT NULL ,
        PRIMARY KEY (idUtilisateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Paniers
#------------------------------------------------------------

CREATE TABLE Paniers(
        idPanier        int (11) Auto_increment  NOT NULL ,
        quantiteProduit Int NOT NULL ,
        dateCreation    Date NOT NULL ,
        total           DECIMAL (15,3)  NOT NULL ,
        idUtilisateur   Int NOT NULL ,
        idCommandes     Int NOT NULL ,
        PRIMARY KEY (idPanier )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Commandes
#------------------------------------------------------------

CREATE TABLE Commandes(
        idCommandes int (11) Auto_increment  NOT NULL ,
        idPanier    Int NOT NULL ,
        PRIMARY KEY (idCommandes )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Tickets
#------------------------------------------------------------

CREATE TABLE Tickets(
        idTicket                   int (11) Auto_increment  NOT NULL ,
        intitule                   Varchar (32) NOT NULL ,
        explication                Text ,
        idEtat                     Int NOT NULL ,
        idUtilisateur              Int NOT NULL ,
        idProduit                  Int NOT NULL ,
        idUtilisateur_Utilisateurs Int NOT NULL ,
        PRIMARY KEY (idTicket )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TypeUtilisateurs
#------------------------------------------------------------

CREATE TABLE TypeUtilisateurs(
        idTypeUtilisateur Int NOT NULL ,
        typeUtilisateur   Varchar (32) NOT NULL ,
        PRIMARY KEY (idTypeUtilisateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Articles
#------------------------------------------------------------

CREATE TABLE Articles(
        idArticles             Int NOT NULL ,
        titreArticle           Varchar (32) NOT NULL ,
        corpsArticle           Text NOT NULL ,
        IllustrationPrinciaple Varchar (120) NOT NULL ,
        IllustrationSecondaire Varchar (120) NOT NULL ,
        idUtilisateur          Int NOT NULL ,
        idCatArt               Int NOT NULL ,
        PRIMARY KEY (idArticles )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Avis
#------------------------------------------------------------

CREATE TABLE Avis(
        idAvis      Int NOT NULL ,
        avis        Text NOT NULL ,
        noteProduit Int NOT NULL ,
        PRIMARY KEY (idAvis )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Etats
#------------------------------------------------------------

CREATE TABLE Etats(
        idEtat int (11) Auto_increment  NOT NULL ,
        etat   Varchar (32) NOT NULL ,
        PRIMARY KEY (idEtat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categories
#------------------------------------------------------------

CREATE TABLE categories(
        idCat      Int NOT NULL ,
        catProduit Varchar (10) NOT NULL ,
        PRIMARY KEY (idCat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Message
#------------------------------------------------------------

CREATE TABLE Message(
        idMessage                  int (11) Auto_increment  NOT NULL ,
        message                    Text NOT NULL ,
        dateMsg                    Time NOT NULL ,
        idUtilisateur              Int NOT NULL ,
        idUtilisateur_Utilisateurs Int NOT NULL ,
        PRIMARY KEY (idMessage )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: categorieArticle
#------------------------------------------------------------

CREATE TABLE categorieArticle(
        idCatArt   Int NOT NULL ,
        catArticle Varchar (10) NOT NULL ,
        PRIMARY KEY (idCatArt )
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
# Table: constituer
#------------------------------------------------------------

CREATE TABLE constituer(
        idProduit Int NOT NULL ,
        idPanier  Int NOT NULL ,
        PRIMARY KEY (idProduit ,idPanier )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: concernerTicket
#------------------------------------------------------------

CREATE TABLE concernerTicket(
        idTicket  Int NOT NULL ,
        idMessage Int NOT NULL ,
        PRIMARY KEY (idTicket ,idMessage )
)ENGINE=InnoDB;

ALTER TABLE Produits ADD CONSTRAINT FK_Produits_idCat FOREIGN KEY (idCat) REFERENCES categories(idCat);
ALTER TABLE Utilisateurs ADD CONSTRAINT FK_Utilisateurs_idTypeUtilisateur FOREIGN KEY (idTypeUtilisateur) REFERENCES TypeUtilisateurs(idTypeUtilisateur);
ALTER TABLE Utilisateurs ADD CONSTRAINT FK_Utilisateurs_idPanier FOREIGN KEY (idPanier) REFERENCES Paniers(idPanier);
ALTER TABLE Paniers ADD CONSTRAINT FK_Paniers_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateurs(idUtilisateur);
ALTER TABLE Paniers ADD CONSTRAINT FK_Paniers_idCommandes FOREIGN KEY (idCommandes) REFERENCES Commandes(idCommandes);
ALTER TABLE Commandes ADD CONSTRAINT FK_Commandes_idPanier FOREIGN KEY (idPanier) REFERENCES Paniers(idPanier);
ALTER TABLE Tickets ADD CONSTRAINT FK_Tickets_idEtat FOREIGN KEY (idEtat) REFERENCES Etats(idEtat);
ALTER TABLE Tickets ADD CONSTRAINT FK_Tickets_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateurs(idUtilisateur);
ALTER TABLE Tickets ADD CONSTRAINT FK_Tickets_idProduit FOREIGN KEY (idProduit) REFERENCES Produits(idProduit);
ALTER TABLE Tickets ADD CONSTRAINT FK_Tickets_idUtilisateur_Utilisateurs FOREIGN KEY (idUtilisateur_Utilisateurs) REFERENCES Utilisateurs(idUtilisateur);
ALTER TABLE Articles ADD CONSTRAINT FK_Articles_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateurs(idUtilisateur);
ALTER TABLE Articles ADD CONSTRAINT FK_Articles_idCatArt FOREIGN KEY (idCatArt) REFERENCES categorieArticle(idCatArt);
ALTER TABLE Message ADD CONSTRAINT FK_Message_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateurs(idUtilisateur);
ALTER TABLE Message ADD CONSTRAINT FK_Message_idUtilisateur_Utilisateurs FOREIGN KEY (idUtilisateur_Utilisateurs) REFERENCES Utilisateurs(idUtilisateur);
ALTER TABLE juger ADD CONSTRAINT FK_juger_idAvis FOREIGN KEY (idAvis) REFERENCES Avis(idAvis);
ALTER TABLE juger ADD CONSTRAINT FK_juger_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateurs(idUtilisateur);
ALTER TABLE juger ADD CONSTRAINT FK_juger_idProduit FOREIGN KEY (idProduit) REFERENCES Produits(idProduit);
ALTER TABLE constituer ADD CONSTRAINT FK_constituer_idProduit FOREIGN KEY (idProduit) REFERENCES Produits(idProduit);
ALTER TABLE constituer ADD CONSTRAINT FK_constituer_idPanier FOREIGN KEY (idPanier) REFERENCES Paniers(idPanier);
ALTER TABLE concernerTicket ADD CONSTRAINT FK_concernerTicket_idTicket FOREIGN KEY (idTicket) REFERENCES Tickets(idTicket);
ALTER TABLE concernerTicket ADD CONSTRAINT FK_concernerTicket_idMessage FOREIGN KEY (idMessage) REFERENCES Message(idMessage);
