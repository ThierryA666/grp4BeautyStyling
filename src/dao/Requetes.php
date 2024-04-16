<?php

namespace beautyStyling\dao;

class Requetes{
    public const SELECT_SALON = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon";

    public const SELECT_SALON_BY_MOTSCLES = "select id_salon, nom_salon, nom_res, prenom_res, tel_salon, email_salon from salon where nom_salon LIKE :motcle OR tel_salon LIKE :motcle";

    public const INSERT_SALON = "insert into `salon` values (:id_salon, :nom_res, :prenom_res, :ad_1, :ad_2, :nom_salon, :email_salon, :cp_salon, :tel_salon, :url_salon, :photo_salon, :pw_salon, :date_cre, :nom_ville )";

    public const DELETE_SALON_BY_ID ="delete from salon where id_salon = :id_salon";

    public const SELECT_SALON_BY_ID = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon WHERE id_salon = :id_salon";

    public const UPDATE_SALON_BY_ID = "update salon SET nom_res =:nom_res, prenom_res=:prenom_res,  ad_1=:ad_1, ad_2=:ad_2, nom_salon=:nom_salon,email_salon=:email_salon, cp_salon=:cp_salon, tel_salon=:tel_salon, url_salon=:url_salon, photo_salon=:photo_salon, pw_salon=:pw_salon, nom_ville=:nom_ville  WHERE id_salon = :id_salon";

    public const SELECT_PRESTA  = "select id_presta, nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date from prestation order by id_presta asc";

    public const SELECT_SALON_BY_EMAIL = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon WHERE email_salon = :email_salon ";

    public const SELECT_PRESTA_BY_SALON ="select id_presta, prix_prest_salon from offrir where id_salon =:id_salon";
}


