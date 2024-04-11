use BEAUTYSTYLING;


-- Check Salon/Employe
select  s.id_salon, s.nom_salon, e.id_employe,e.nom_employe
from salon s
inner join employe e on e.id_salon = s.id_salon
order by 1 asc;

-- Check Etat
select  e.id_etat,e.libel_etat
from etat e
order by 1 asc;

-- Check Salon/Prestation
select s.id_salon, s.nom_salon, p.id_presta, p.nom_presta
from offrir o
inner join salon s on o.id_salon = s.id_salon
inner join prestation p on o.id_presta = p.id_presta
order by 1 asc;

-- Check Employe/Prestation
select e.id_employe, e.nom_employe, p.id_presta, p.nom_presta
from effectuer ef
inner join employe e on ef.id_employe = e.id_employe
inner join prestation p on ef.id_presta = p.id_presta
order by 1 asc;

-- Check Salon/Prestation/employe
create or replace view SPE as (
select s.id_salon, s.nom_salon, p.id_presta, p.nom_presta, e.id_employe, e.nom_employe
from offrir o
inner join salon s on o.id_salon = s.id_salon
inner join prestation p on o.id_presta = p.id_presta
inner join effectuer ef on o.id_presta = ef.id_presta 
inner join employe e on ef.id_employe = e.id_employe
and ef.id_presta = o.id_presta
and e.id_salon = s.id_salon
order by 1 asc
);

-- check Reservation/Prestations
select r.id_rndv, r.nom_rndv, date(r.d_rndv), time(r.h_rndv),ld.num_ligne, ld.id_presta, ld.qte
from reservation r
inner join ligne_detail ld on ld.id_rndv= r.id_rndv
order by r.id_rndv, ld.num_ligne;