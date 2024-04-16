
use beautystyling;
drop table if exists offrir;
drop table if exists prestation;
drop table if exists salon;
drop table if exists villes_france_free;
drop table if exists pays;



-- ----------
-- table pays
-- ----------

create table pays(
  id_pays int  auto_increment primary key,
  tel_codeint int not null,
  nom_pays varchar(25) not null
)


-- -----------
-- table ville
-- -----------

CREATE TABLE `villes_france_free` (
  `ville_id` mediumint(8) unsigned NOT NULL,
  `ville_departement` varchar(3) DEFAULT NULL,
  `ville_slug` varchar(255) DEFAULT NULL,
  `ville_nom` varchar(45) DEFAULT NULL,
  `ville_nom_simple` varchar(45) DEFAULT NULL,
  `ville_nom_reel` varchar(45) DEFAULT NULL,
  `ville_nom_soundex` varchar(20) DEFAULT NULL,
  `ville_nom_metaphone` varchar(22) DEFAULT NULL,
  `ville_code_postal` varchar(255) DEFAULT NULL,
  `ville_commune` varchar(3) DEFAULT NULL,
  `ville_code_commune` varchar(5) NOT NULL,
  `ville_arrondissement` smallint(3) unsigned DEFAULT NULL,
  `ville_canton` varchar(4) DEFAULT NULL,
  `ville_amdi` smallint(5) unsigned DEFAULT NULL,
  `ville_population_2010` mediumint(11) unsigned DEFAULT NULL,
  `ville_population_1999` mediumint(11) unsigned DEFAULT NULL,
  `ville_population_2012` mediumint(10) unsigned DEFAULT NULL COMMENT 'approximatif',
  `ville_densite_2010` int(11) DEFAULT NULL,
  `ville_surface` float DEFAULT NULL,
  `ville_longitude_deg` float DEFAULT NULL,
  `ville_latitude_deg` float DEFAULT NULL,
  `ville_longitude_grd` varchar(9) DEFAULT NULL,
  `ville_latitude_grd` varchar(8) DEFAULT NULL,
  `ville_longitude_dms` varchar(9) DEFAULT NULL,
  `ville_latitude_dms` varchar(8) DEFAULT NULL,
  `ville_zmin` mediumint(4) DEFAULT NULL,
  `ville_zmax` mediumint(4) DEFAULT NULL,
  `id_pays` int not null,
  PRIMARY KEY (`ville_id`),
  UNIQUE KEY `ville_code_commune_2` (`ville_code_commune`),
  UNIQUE KEY `ville_slug` (`ville_slug`),
  KEY `ville_departement` (`ville_departement`),
  KEY `ville_nom` (`ville_nom`),
  KEY `ville_nom_reel` (`ville_nom_reel`),
  KEY `ville_code_commune` (`ville_code_commune`),
  KEY `ville_code_postal` (`ville_code_postal`),
  KEY `ville_longitude_latitude_deg` (`ville_longitude_deg`,`ville_latitude_deg`),
  KEY `ville_nom_soundex` (`ville_nom_soundex`),
  KEY `ville_nom_metaphone` (`ville_nom_metaphone`),
  KEY `ville_population_2010` (`ville_population_2010`),
  KEY `ville_nom_simple` (`ville_nom_simple`),
  foreign key (id_pays) references pays(id_pays)
);



-- -------------
-- table salon
-- -------------


create table salon(
    id_salon int auto_increment primary key,
    nom_res varchar(20) not null,
    prenom_res varchar(20) not null,
    ad_1 varchar(50) not null,
    ad_2 varchar(50),
    nom_salon varchar(40) not null,
    email_salon varchar(30) not null unique,
    cp_salon int(5) not null,
    tel_salon int not null,
    url_salon varchar(50),
    photo_salon varchar(80),
    pw_salon varchar(15),
    date_cre date,
    id_ville mediumint(8) unsigned NOT NULL,
    foreign key (id_ville) references villes_france_free(ville_id)
) engine=InnoDB;



-- -------------------
-- table prestation
-- -------------------
create table prestation ( 
	id_presta int primary key auto_increment, 
	nom_presta varchar(50) unique, 
	duree_presta time not null, 
	desc_presta varchar(128), 
	prix_ind_presta decimal(6,2) not null, 
	creation_date timestamp not null default current_timestamp(), 
	modif_date date
) engine=InnoDB;



-- ----------
-- table offrir
-- ----------

create table offrir ( 
	id_presta int, 
	id_salon int, 
  prix_prest_salon decimal (5,2),
	primary key(id_presta, id_salon), 
	foreign key(id_presta) references prestation(id_presta), 
	foreign key(id_salon) references salon(id_salon) 
);
-- ---------
-- insert 
-- ---------

delete from offrir;
delete from PRESTATION;
delete from salon;
delete from villes_france_free;
delete from pays;

alter table pays auto_increment = 1;
alter table salon auto_increment = 1;
alter table PRESTATION auto_increment = 1;



-- pays

insert into pays values (1,33, 'France');
insert into pays values (2,32, 'Belgique');
insert into pays values (3,49, 'Allemagne');
insert into pays values (4,39, 'Italie');


-- villes

INSERT INTO `villes_france_free` (`ville_id`, `ville_departement`, `ville_slug`, `ville_nom`, `ville_nom_simple`, `ville_nom_reel`, `ville_nom_soundex`, `ville_nom_metaphone`, `ville_code_postal`, `ville_commune`, `ville_code_commune`, `ville_arrondissement`, `ville_canton`, `ville_amdi`, `ville_population_2010`, `ville_population_1999`, `ville_population_2012`, `ville_densite_2010`, `ville_surface`, `ville_longitude_deg`, `ville_latitude_deg`, `ville_longitude_grd`, `ville_latitude_grd`, `ville_longitude_dms`, `ville_latitude_dms`, `ville_zmin`, `ville_zmax`,`id_pays`) VALUES
(28153, '69', 'lyon', 'LYON', 'lyon', 'Lyon', 'L500', 'LYN', '69001-69002-69003-69004-69005-69006-69007-69008-69009', '123', '69123', 1, '99', 2, 484344, 445274, 474900, 10117, 47.87, 4.84139, 45.7589, '2783', '50843', '+45029', '454532', 162, 312,1),
(35911, '92', 'antony', 'ANTONY', 'antony', 'Antony', 'A535', 'ANTN', '92160', '002', '92002', 1, '87', 4, 61793, 59849, 61200, 6463, 9.56, 2.3, 48.75, '-44', '54170', '+21748', '484512', 45, 103,1),
(13206, '34', 'beziers', 'BEZIERS', 'beziers', 'Béziers', 'B262', 'BSRS', '34500', '032', '34032', 1, '98', 4, 70955, 69359, 71700, 743, 95.48, 3.25, 43.35, '977', '48159', '+31258', '432036', 4, 120,1),
(23015, '59', 'tourcoing', 'TOURCOING', 'tourcoing', 'Tourcoing', 'T6252', 'TRKNK', '59200', '599', '59599', 5, '97', 5, 91923, 93531, 92600, 6051, 15.19, 3.15, 50.7167, '915', '56358', '+30937', '504321', 24, 49,1);

-- salon
insert into salon values (1,'CLAIR','Agathe','140 Rue de Créqui',null,'Julie Borne Coiffure Création','agt@gmail.com',69006,'0611223344',null,'abc.jpg','dnPf5z9OQz07CBv',date('2024-01-01'),28153);
insert into salon values (2,'Théberge','Channing ','27, Avenue De Marlioz',null,'Salon Antony','ChanningTheberge@rhyta.com',92160,'0125547928','www.ComedyDiary.fr','efg.jpg','Jee1ceeXin',date('2024-1-2'),35911);
insert into salon values (3,'Aupry','Guy','81, rue Marie de Médicis',null,'Salon Guy','GuyAupry@dayrep.com',34500,'0458098057','www.guy-salon.fr','hjk.jpg','EeW7iechu',date('2024-1-3'),13206);
insert into salon values (4,'Tessier','Laurent','3,  Rue Neuve',null,'Red Studio','LaurentTessier@rhyta.com',69001,'0461124244',null,'hhh.jpg','eichia4ahS',date('2024-1-5'),28153);
insert into salon values (5,'Magnolia','Sciverit','77, quai Saint-Nicolas',null,'Frédéric Moréno','MagnoliaSciverit@rhyta.com',59200,'0365847757',null,'ppp.jpg','IeNgangu4u',date('2024-1-7'),23015);


-- prestation
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Coupe Homme',1,'Coupe ciseaux et tondeuse',20);
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Coupe Femme',1,'Coupe ciseaux et peigne',40);
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Shampooing',1,'Shampoing et séchage',15);
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Meches',3,'Balayage de couleurs differentes',40);
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Couleur',2,'Couleur integrale',30);
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Coupe Enfant',1,null,15);
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Barbe Homme',2,'Soins pour la barbe',20);
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Boucle Femme',1,'',30);
insert into PRESTATION (NOM_PRESTA,DUREE_PRESTA,DESC_PRESTA,PRIX_IND_PRESTA) values ('Lissage Femme',1,' ',30);


--- offrir
insert into offrir (id_presta, id_salon,prix_prest_salon) values (1,1,25.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (2,1,35.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (3,1,10.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (4,1,85.50);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (5,1,65.50);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (6,1,20.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (7,1,20.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (8,1,30.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (9,1,100.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (1,2,20.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (2,2,40.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (3,2,8.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (4,2,70.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (5,2,50.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (6,2,18.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (7,2,20.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (8,2,28.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (9,2,95.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (1,3,20.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (2,3,40.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (3,3,15.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (4,3,75.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (5,3,62.20);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (6,3,20.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (6,4,19.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (7,4,18.40);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (8,4,27.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (9,4,88.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (3,5,12.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (3,4,9.00);
insert into offrir (id_presta, id_salon,prix_prest_salon) values (4,5,75.50);

-- -------------
-- jeu d'essaie
-- -------------

-- lister tous les nom de salon
select distinct nom_salon from salon;

-- lister des noms de salon qui contiennent 'salon' 
select nom_salon from salon
where nom_salon like '%salon%';

-- Extraire les salons dont le code postal commence par 69. 
select nom_salon, ad_1, ad_2, cp_salon from salon
where left(cp_salon,2) in ('69') and length(cp_salon) =5;

-- Extraire les salons qui offrent 'Coupe femme'
select nom_salon, ad_1, ad_2, cp_salon, tel_salon
from offrir o
join salon s on s.id_salon = o.id_salon
join prestation p on o.id_presta = p.id_presta
where o.id_presta = 2
group by nom_salon, ad_1, ad_2, cp_salon, tel_salon
order by nom_salon asc;

-- Voir les salons de coiffure de Lyon par ordre d'importance des coupes de cheveux pour femmes les moins chères.
select nom_salon, ad_1, ad_2, cp_salon, tel_salon, prix_prest_salon
from offrir o
join salon s on s.id_salon = o.id_salon
join prestation p on o.id_presta = p.id_presta
where o.id_presta = 2 and left(s.cp_salon,2) in ('69') and length(s.cp_salon) =5
group by nom_salon, ad_1, ad_2, cp_salon, tel_salon, prix_prest_salon
order by prix_prest_salon asc;


select id_presta, prix_prest_salon 
from offrir
where id_salon =1
order by id_presta asc;

select id_presta, nom_presta, prix_prest_salon
from offrir o
join prestation p on o.id_presta = p.id_presta
where o.id_presta = 3
group by o.id_presta, p.nom_presta, o.prix_prest_salon
order by o.id_presta asc;