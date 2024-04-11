-- drop database if exists BEAUTYSTYLING; 
-- create database BEAUTYSTYLING character set = 'utf8mb4' collate = 'utf8mb4_general_ci'; 
use BEAUTYSTYLING; 

drop table if exists ligne_detail; 
drop table if exists effectuer; 
drop table if exists offrir;
drop table if exists employe;
drop table if exists reservation;
drop table if exists salon;
drop table if exists villes_france_free;
drop table if exists etat;
drop table if exists client;
drop table if exists prestation;

Create table client ( 
	id_client int primary key auto_increment 
) engine=InnoDB;

create table prestation ( 
	id_presta int primary key auto_increment, 
	nom_presta varchar(50) not null unique, 
	duree_presta time not null, 
	desc_presta varchar(128), 
	prix_ind_presta decimal(5,2) not null, 
	creation_date timestamp not null default current_timestamp(), 
	modif_date date
) engine=InnoDB;

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
  KEY `ville_nom_simple` (`ville_nom_simple`) 
);


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

create table employe ( 
	id_employe int primary key auto_increment, 
	nom_employe varchar(50) not null, 
	id_salon int, 
	FOREIGN KEY(id_salon) REFERENCES salon(id_salon) 
) engine=InnoDB; 

create table etat ( 
    id_etat int PRIMARY KEY auto_increment, 
    libel_etat char(10) NOT NULL 
) engine = InnoDB;

create table reservation ( 
    id_rndv int PRIMARY KEY auto_increment, 
    h_rndv time NOT NULL, 
    d_rndv date NOT NULL, 
    nom_rndv char(50) NOT NULL, 
    detail_rndv char(50), 
	id_etat int not null, 
	id_client int not null, 
	id_salon int not null, 
	foreign key(id_etat) references etat(id_etat), 
	foreign key(id_client) references client(id_client), 
	foreign key(id_salon) references salon(id_salon) 
) engine = InnoDB;


create table ligne_detail ( 
	num_ligne smallint not null, 
	id_presta int, 
	id_rndv int, 
	qte smallint not null check (qte > 0), 
	id_employe int not null, 
	PRIMARY KEY(id_presta, id_rndv), 
	FOREIGN KEY(id_presta) REFERENCES prestation(id_presta), 
	FOREIGN KEY(id_rndv) REFERENCES reservation(id_rndv), 
	FOREIGN KEY(id_employe) REFERENCES employe(id_employe) 
);


create table effectuer ( 
	id_presta int, 
	id_employe int, 
	primary key(id_presta, id_employe), 
	foreign key(id_presta) references prestation(id_presta), 
	foreign key(id_employe) references employe(id_employe) 
); 

create table offrir ( 
	id_presta int, 
	id_salon int,
    prix_prest_salon decimal (5,2), 
	primary key(id_presta, id_salon), 
	foreign key(id_presta) references prestation(id_presta), 
	foreign key(id_salon) references salon(id_salon) 
);

create index idx_nom_presta on prestation(nom_presta);



