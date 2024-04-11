-- ----------
-- table offrir avec prix salon
-- ----------

create table offrir ( 
	id_presta int, 
	id_salon int, 
  prix_prestSalon decimal (5,2),
	primary key(id_presta, id_salon), 
	foreign key(id_presta) references prestation(id_presta), 
	foreign key(id_salon) references salon(id_salon) 
);


--- offrir
insert into offrir (id_presta, id_salon,prix_prestSalon) values (1,1,25.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (2,1,35.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (3,1,10.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (4,1,85.50);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (5,1,65.50);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (6,1,20.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (7,1,20.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (8,1,30.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (9,1,100.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (1,2,20.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (2,2,40.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (3,2,8.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (4,2,70.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (5,2,50.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (6,2,18.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (7,2,20.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (8,2,28.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (9,2,95.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (1,3,20.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (2,3,40.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (3,3,15.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (4,3,75.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (5,3,62.20);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (6,3,20.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (6,4,19.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (7,4,18.40);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (8,4,27.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (9,4,88.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (3,5,12.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (3,4,9.00);
insert into offrir (id_presta, id_salon,prix_prestSalon) values (4,5,75.50);

