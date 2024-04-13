use BEAUTYSTYLING;

delete from offrir;
delete from effectuer;
delete from ligne_detail;
delete from reservation;
delete from employe;
delete from prestation;
delete from client;
delete from salon;

delete from etat;

alter table prestation auto_increment = 1;
alter table employe auto_increment = 1;
alter table client auto_increment = 1;
alter table salon auto_increment = 1;
alter table reservation auto_increment = 1;
alter table etat auto_increment = 1;


insert into salon values (1,'CLAIR','Agathe','140 Rue de Créqui',null,'Julie Borne Coiffure Création','agt@gmail.com',69006,'0611223344',null,'salon1.jpg','dnPf5z9OQz07CBv',date('2024-01-01'),'LYON');
insert into salon values (2,'Théberge','Channing ','27, Avenue De Marlioz',null,'Salon Antony','ChanningTheberge@rhyta.com',92160,'0125547928','www.ComedyDiary.fr','salon2.jpg','Jee1ceeXin',date('2024-1-2'),'ANTONY');
insert into salon values (3,'Aupry','Guy','81, rue Marie de Médicis',null,'Salon Guy','GuyAupry@dayrep.com',34500,'0458098057','www.guy-salon.fr','salon3.jpg','EeW7iechu',date('2024-1-3'),'BEZIERS');
insert into salon values (4,'Tessier','Laurent','3,  Rue Neuve',null,'Red Studio','LaurentTessier@rhyta.com',69001,'0461124244',null,'salon4.jpg','eichia4ahS',date('2024-1-5'),'LYON');
insert into salon values (5,'Magnolia','Sciverit','77, quai Saint-Nicolas',null,'Frédéric Moréno','MagnoliaSciverit@rhyta.com',59200,'0365847757',null,'salon5.jpg','IeNgangu4u',date('2024-1-7'),'TOURCOING');

insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Coupe Homme',time('01:00:00'),'Coupe ciseaux et tondeuse',20);
insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Coupe Femme',time('01:00:00'),'Coupe ciseaux et peigne',40);
insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Shampooing',time('01:00:00'),'Shampoing et séchage',15);
insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Meches',time('03:00:00'),'Balayage de couleurs differentes',40);
insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Couleur',time('02:00:00'),'Couleur integrale',30);
insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Coupe Enfant',time('01:00:00'),null,15);
insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Barbe Homme',time('02:00:00'),'Soins pour la barbe',20);
insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Boucle Femme',time('01:00:00'),'',30);
insert into prestation (nom_presta,duree_presta,desc_presta,prix_ind_presta) values ('Lissage Femme',time('01:00:00'),' ',30);


insert into employe (nom_employe, id_salon) values ('Johnny',1);
insert into employe (nom_employe, id_salon)  values ('Jacques',1);
insert into employe (nom_employe, id_salon)  values ('Dorothée',2);
insert into employe (nom_employe, id_salon)  values ('Gertrude',2);
insert into employe (nom_employe, id_salon)  values ('Maria',3);
insert into employe (nom_employe, id_salon)  values ('Takako',3);
insert into employe (nom_employe, id_salon)  values ('Hermine',4);
insert into employe (nom_employe, id_salon)  values ('Thierry',5);

insert into client (id_client) values (1);
insert into client (id_client) values (2);
insert into client (id_client) values (3);
insert into client (id_client) values (4);
insert into client (id_client) values (5);

insert into effectuer (id_presta, id_employe) values (1,1);
insert into effectuer (id_presta, id_employe) values (2,1);
insert into effectuer (id_presta, id_employe) values (3,1);
insert into effectuer (id_presta, id_employe) values (5,1);
insert into effectuer (id_presta, id_employe) values (7,1);
insert into effectuer (id_presta, id_employe) values (8,1);
insert into effectuer (id_presta, id_employe) values (1,2);
insert into effectuer (id_presta, id_employe) values (2,2);
insert into effectuer (id_presta, id_employe) values (3,2);
insert into effectuer (id_presta, id_employe) values (5,2);
insert into effectuer (id_presta, id_employe) values (7,2);
insert into effectuer (id_presta, id_employe) values (8,2);
insert into effectuer (id_presta, id_employe) values (7,8);
insert into effectuer (id_presta, id_employe) values (1,8);
insert into effectuer (id_presta, id_employe) values (3,8);
insert into effectuer (id_presta, id_employe) values (2,3);
insert into effectuer (id_presta, id_employe) values (3,3);
insert into effectuer (id_presta, id_employe) values (4,3);
insert into effectuer (id_presta, id_employe) values (5,3);
insert into effectuer (id_presta, id_employe) values (6,3);
insert into effectuer (id_presta, id_employe) values (7,3);
insert into effectuer (id_presta, id_employe) values (8,3);
insert into effectuer (id_presta, id_employe) values (9,3);
insert into effectuer (id_presta, id_employe) values (6,6);
insert into effectuer (id_presta, id_employe) values (3,5);
insert into effectuer (id_presta, id_employe) values (3,6);
insert into effectuer (id_presta, id_employe) values (3,7);


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

insert into etat (libel_etat) values ('En cours');
insert into etat (libel_etat) values ('Reservee');
insert into etat (libel_etat) values ('Realisee');
insert into etat (libel_etat) values ('Annulee');

insert into reservation (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) values ('11:00 h', '2024-03-15', 'reservation 1', 'Je veux la coupe de cheveux aux ciseaux', 1, 1, 1);
insert into reservation (h_rndv, d_rndv, nom_rndv, id_etat, id_client, id_salon) values ('10:00 h', '2024-03-13', 'reservation 2', 1, 2, 1);
insert into reservation (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) values ('11:30 h', '2024-03-16', 'reservation 3', 'Je veux une teinture verte pour les cheveux', 1, 1, 2);
insert into reservation (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) values ('14:00 h', '2024-03-18', 'reservation 4', 'Je veux une coupe dégradée', 1, 3, 3);
insert into reservation (h_rndv, d_rndv, nom_rndv, id_etat, id_client, id_salon) values ('14:30 h', '2024-03-19', 'reservation 5', 1, 4, 1);

insert into ligne_detail (num_ligne,id_presta,id_rndv,qte,id_employe) values (1,1,1,1,1);
insert into ligne_detail (num_ligne,id_presta,id_rndv,qte,id_employe) values (2,3,1,2,2);
insert into ligne_detail (num_ligne,id_presta,id_rndv,qte,id_employe) values (3,4,1,1,1);
insert into ligne_detail (num_ligne,id_presta,id_rndv,qte,id_employe) values (1,5,2,3,1);
insert into ligne_detail (num_ligne,id_presta,id_rndv,qte,id_employe) values (2,1,2,1,1);
insert into ligne_detail (num_ligne,id_presta,id_rndv,qte,id_employe) values (1,1,3,1,1);
insert into ligne_detail (num_ligne,id_presta,id_rndv,qte,id_employe) values (1,1,4,1,1);
insert into ligne_detail (num_ligne,id_presta,id_rndv,qte,id_employe) values (1,1,5,1,1);
