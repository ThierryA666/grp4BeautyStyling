<?php

namespace beautyStyling\dao;

class Requetes{
    public const SELECT_SALON = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon";

    public const SELECT_SALON_BY_MOTSCLES = "select id_salon, nom_salon, nom_res, prenom_res, tel_salon, email_salon from salon where nom_salon LIKE :motcle OR tel_salon LIKE :motcle";

    public const INSERT_SALON = "insert into `salon` values (:id_salon, :nom_res, :prenom_res, :ad_1, :ad_2, :nom_salon, :email_salon, :cp_salon, :tel_salon, :url_salon, :photo_salon, :pw_salon, :date_cre, :nom_ville )";

    public const DELETE_SALON_BY_ID ="
    SET @employe_fk_exist = (SELECT COUNT(*) FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = 'beautystyling' AND TABLE_NAME = 'employe' AND CONSTRAINT_NAME = 'employe_ibfk_1');
    SET @offrir_fk_exist = (SELECT COUNT(*) FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = 'beautystyling' AND TABLE_NAME = 'offrir' AND CONSTRAINT_NAME = 'offrir_ibfk_2');
    SET @reservation_fk_exist = (SELECT COUNT(*) FROM information_schema.KEY_COLUMN_USAGE WHERE CONSTRAINT_SCHEMA = 'beautystyling' AND TABLE_NAME = 'reservation' AND CONSTRAINT_NAME = 'reservation_ibfk_3');

    IF @employe_fk_exist > 0 THEN
        ALTER TABLE employe DROP FOREIGN KEY employe_ibfk_1;
    END IF;

    IF @offrir_fk_exist > 0 THEN
        ALTER TABLE offrir DROP FOREIGN KEY offrir_ibfk_2;
    END IF;

    IF @reservation_fk_exist > 0 THEN
        ALTER TABLE reservation DROP FOREIGN KEY reservation_ibfk_3;
    END IF;

    DELETE FROM salon WHERE id_salon = :id_salon;

    IF @employe_fk_exist > 0 THEN
        ALTER TABLE employe ADD CONSTRAINT employe_ibfk_1 FOREIGN KEY (id_salon) REFERENCES salon (id_salon);
    END IF;

    IF @offrir_fk_exist > 0 THEN
        ALTER TABLE offrir ADD CONSTRAINT offrir_ibfk_2 FOREIGN KEY (id_salon) REFERENCES salon (id_salon);
    END IF;

    IF @reservation_fk_exist > 0 THEN
        ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_3 FOREIGN KEY (id_salon) REFERENCES salon (id_salon);
    END IF;
";

    public const SELECT_SALON_BY_ID = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon WHERE id_salon = :id_salon";

    public const UPDATE_SALON_BY_ID = "update salon SET nom_res =:nom_res, prenom_res=:prenom_res,  ad_1=:ad_1, ad_2=:ad_2, nom_salon=:nom_salon,email_salon=:email_salon, cp_salon=:cp_salon, tel_salon=:tel_salon, url_salon=:url_salon, photo_salon=:photo_salon, pw_salon=:pw_salon, nom_ville=:nom_ville  WHERE id_salon = :id_salon";
}

// alter table employe drop foreign key employe_ibfk_1;
// alter table offrir drop foreign key offrir_ibfk_2;
// alter table reservation drop foreign key reservation_ibfk_3;
// delete from salon where id_salon =3;
// alter table employe add constraint employe_ibfk_1 foreign key(id_salon) references salon(id_salon);
// alter table offrir add constraint offrir_ibfk_2 foreign key(id_salon) references salon(id_salon);
// alter table reservation add constraint reservation_ibfk_3 foreign key(id_salon) references salon(id_salon);