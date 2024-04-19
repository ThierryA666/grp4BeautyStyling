<?php

namespace beautyStyling\dao;

class Requetes{
    public const SELECT_SALON = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon";

    public const SELECT_SALON_BY_MOTSCLES = "select id_salon, nom_salon, nom_res, prenom_res, tel_salon, email_salon from salon where nom_salon LIKE :motcle OR tel_salon LIKE :motcle";
    
    public const SELECT_SALON_BY_NAME ="select id_salon, nom_salon, ad_1, ad_2, cp_salon, nom_ville, tel_salon, url_salon, photo_salon from salon where nom_salon LIKE :motcle";

    public const INSERT_SALON = "insert into `salon` values (:id_salon, :nom_res, :prenom_res, :ad_1, :ad_2, :nom_salon, :email_salon, :cp_salon, :tel_salon, :url_salon, :photo_salon, :pw_salon, :date_cre, :nom_ville )";

    public const DELETE_SALON_BY_ID ="delete from salon where id_salon = :id_salon";

    public const SELECT_SALON_BY_ID = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon WHERE id_salon = :id_salon";

    public const UPDATE_SALON_BY_ID = "update salon SET nom_res =:nom_res, prenom_res=:prenom_res,  ad_1=:ad_1, ad_2=:ad_2, nom_salon=:nom_salon,email_salon=:email_salon, cp_salon=:cp_salon, tel_salon=:tel_salon, url_salon=:url_salon, photo_salon=:photo_salon, pw_salon=:pw_salon, nom_ville=:nom_ville  WHERE id_salon = :id_salon";

    public const SELECT_PRESTA = "select id_presta, nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date from prestation order by id_presta asc";

    public const SELECT_SALON_BY_EMAIL = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon WHERE email_salon = :email_salon ";

    public const SELECT_PRESTA_BY_SALON ="select o.id_presta, p.nom_presta, o.prix_prest_salon
    from offrir o join prestation p on o.id_presta = p.id_presta where o.id_salon = :id_salon group by o.id_presta, p.nom_presta, o.prix_prest_salon order by o.id_presta asc";

    public const UPDATE_OFFRIR_BY_ID ="update offrir set  prix_prest_salon = :prix_prest_salon WHERE id_salon = :id_salon and id_presta = :id_presta";

    public const INSERT_OFFRIR ="insert into offrir (id_presta, id_salon,prix_prest_salon) values (:id_presta, :id_salon, :prix_prest_salon)";
    
    public const SELECT_COUNT_OFFRIR = "select count(*) as count from offrir WHERE id_salon = :id_salon and id_presta = :id_presta";

    public const DELETE_OFFRIR_BY_SALON ="delete from offrir where id_salon = :id_salon";

    public const SELECT_PRESTA_BY_ID  = "select id_presta, nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date from prestation where id_presta = :idPresta";

    public const SELECT_SALON_BY_PRESTA = "select o.id_salon, nom_salon, ad_1, ad_2, cp_salon, nom_ville, tel_salon, url_salon, photo_salon from offrir o join salon s on s.id_salon = o.id_salon join prestation p on o.id_presta = p.id_presta where o.id_presta = :id_presta group by id_salon, nom_salon, ad_1, ad_2, cp_salon, tel_salon,url_salon, photo_salon, nom_ville order by nom_salon asc;";
}



