use vds;
drop table if exists epreuve;

CREATE TABLE epreuve
(
    id             int AUTO_INCREMENT primary key,
    nom            varchar(70)  NOT NULL,
    description    text,
    date           date         NOT NULL,
    urlInscription varchar(150) NULL,
    urlInscrit     varchar(150) NULL,
    dateOuverture  date         NULL,
    dateFermeture  date         NULL
);

INSERT INTO epreuve (nom, description, date, urlInscription, urlInscrit, dateOuverture, dateFermeture)
VALUES ('Finale d''automne 4 Saisons d''Amiens Métropole',
        'Label régional FFA qualificatif au championnat de France sur l''ensemble des courses
       5 Km découverte: 9H20
       10 Km Course des Joggers: 10H05
       10 Km Course des As: 11H20
       Tarif unique : 10 euros (frais d''inscription compris)
       Ce tarif vous donne droit le droit de participer à l''ensemble des courses.
       Pour cette finale, plus de 2000 € de prime seront distribués et un lot de grande qualité sera offert à chaque arrivant',
        '2022-11-06',
        'https://www.klikego.com/inscription/finale-des-quatre-saisons-2022/running-course-a-pied/1603054434896-7',
        'https://www.klikego.com/inscrits/finale-des-quatre-saisons-2022/1603054434896-7',
        '2022-09-01',
        '2022-11-03');

INSERT INTO epreuve (nom, description, date, dateOuverture, dateFermeture)
VALUES ('Edition hiver 4 Saisons d''Amiens Métropole',
        'Label régional FFA qualificatif au championnat de France sur l''ensemble des courses
       5 Km découverte: 9H20
       10 Km Course des Joggers: 10H05
       10 Km Course des As: 11H20
       Tarif unique : 10 euros (frais d''inscription compris)
       Ce tarif vous donne droit le droit de participer à l''ensemble des courses.',
        '2023-03-05',
        '2023-02-01',
        '2023-03-02');

INSERT INTO epreuve (nom, description, date)
VALUES ('Edition printemps 4 Saisons d''Amiens Métropole',
        '5 Km découverte: 9H20
        10 Km Course des Joggers: 10H05
        10 Km Course des As: 11H20
        Tarif unique : 7,70 euros (frais d''inscription compris) -
        Ce tarif vous donne droit le droit de participer à l''ensemble des courses.',
        '2023-05-07');

INSERT INTO epreuve (nom, description, date)
VALUES ('Edition été 4 Saisons d''Amiens Métropole',
        '5 Km découverte: 9H20
        10 Km Course des Joggers: 10H05
        10 Km Course des As: 11H20
        Tarif unique : 7,70 euros (frais d''inscription compris) -
        Ce tarif vous donne droit le droit de participer à l''ensemble des courses.',
        '2023-07-02');

Select * from epreuve;
