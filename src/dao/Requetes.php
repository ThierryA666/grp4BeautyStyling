<?php

namespace beautyStyling\dao;

class Requetes{
    public const SELECT_SALON = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon";

    public const SELECT_SALON_BY_MOTSCLES = "select nom_salon, nom_res, prenom_res, tel_salon, email_salon from salon where nom_salon LIKE :motcle OR tel_salon LIKE :motcle";

    public const INSERT_SALON = "insert into `salon` values (:id_salon, :nom_res, :prenom_res, :ad_1, :ad_2, :nom_salon, :email_salon, :cp_salon, :tel_salon, :url_salon, :photo_salon, :pw_salon, :date_cre, :nom_ville )";

    public const DELETE_SALON ="delete from `salon` where tel_salon = :tel_salon";


}