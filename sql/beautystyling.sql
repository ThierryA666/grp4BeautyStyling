drop database if exists BEAUTYSTYLING; 
create database BEAUTYSTYLING character set = 'utf8mb4' collate = 'utf8mb4_general_ci'; 
use BEAUTYSTYLING; 

drop table if exists client; 
drop table if exists PRESTATION; 
drop table if exists villes_france_free; 
drop table if exists salon; 
drop table if exists etat; 
drop table if exists reservation; 
drop table if exists EMPLOYE; 
drop table if exists LIGNEDETAIL; 
drop table if exists effectuer; 
drop table if exists offrir; 

create table client ( 
	id_client int primary key auto_increment 
) engine=InnoDB; 

create table PRESTATION ( 
     ID_PRESTA  int primary key auto_increment, 
     NOM_PRESTA varchar(50) unique, 
     DUREE_PRESTA time not null, 
    DESC_PRESTA         varchar(128), 
    PRIX_IND_PRESTA     decimal(6,2) not null, 
    CREATION_DATE       timestamp not null default current_timestamp(), 
    MODIF_TIME          date 
) engine=InnoDB; 