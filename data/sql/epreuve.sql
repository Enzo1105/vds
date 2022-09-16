drop table epreuve;

CREATE TABLE epreuve (
                         id int AUTO_INCREMENT primary key,
                         nom varchar(70) NOT NULL,
                         description text,
                         date date NOT NULL,
                         urlInscription varchar(150),
                         urlInscrit varchar(150),
                         dateOuverture date NOT NULL,
                         dateFermeture date NOT NULL
);