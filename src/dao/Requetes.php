<?php
namespace beautyStyling\dao;

class Requetes {
    //Requetes Prestation
    public const SELECT_SPE     = "select id_salon, nom_salon, id_presta, nom_presta, id_employe, nom_employe from spe";
    public const SELECT_PRESTA  = "select id_presta, nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date from prestation order by id_presta asc";
    public const SELECT_PRESTA_BY_ID  = "select id_presta, nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date from prestation where id_presta = :idPresta";
    public const DELETE_PRESTA_BY_ID  = "delete from prestation where id_presta = :idPresta";
    public const UPDATE_PRESTA  = "update prestation set nom_presta = :nomPresta, duree_presta = :dureePresta, desc_presta = :descPresta, prix_ind_presta = :prixIndPresta, modif_date = :modifDate where id_presta = :idPresta";
    public const INSERT_PRESTA  = "insert into prestation (nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date) values (:nomPresta, :dureePresta, :descPresta, :prixIndPresta, :creationDate, :modifDate)";
    //Requetes Salon
    public const SELECT_SALON = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon";
    public const SELECT_SALON_BY_MOTSCLES = "select id_salon, nom_salon, nom_res, prenom_res, tel_salon, email_salon from salon where nom_salon LIKE :motcle OR tel_salon LIKE :motcle";
    public const INSERT_SALON = "insert into `salon` values (:id_salon, :nom_res, :prenom_res, :ad_1, :ad_2, :nom_salon, :email_salon, :cp_salon, :tel_salon, :url_salon, :photo_salon, :pw_salon, :date_cre, :nom_ville )";
    public const DELETE_SALON ="delete from `salon` where tel_salon = :tel_salon";
    public const SELECT_SALON_BY_ID = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon WHERE id_salon = :id_salon";
    public const UPDATE_SALON_BY_ID = "update salon SET nom_res =:nom_res, prenom_res=:prenom_res,  ad_1=:ad_1, ad_2=:ad_2, nom_salon=:nom_salon,email_salon=:email_salon, cp_salon=:cp_salon, tel_salon=:tel_salon, url_salon=:url_salon, photo_salon=:photo_salon, pw_salon=:pw_salon, nom_ville=:nom_ville  WHERE id_salon = :id_salon";
    //Requetes Reservation
    public const SELECT_ETAT                        = "select id_etat, libel_etat from etat";
    public const SELECT_RESERVATION                 = "select id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon from reservation";
    public const SELECT_RESERVATION_BY_ID           = "select id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon from reservation where id_rndv = :id";
    public const DELETE_RESERVATION_BY_ID           = "delete from reservation where id_rndv = :id_rndv";
    public const UPDATE_RESERVATION                 = "update reservation set nom_rndv = :nom_rndv, h_rndv = :h_rndv, d_rndv = :d_rndv, detail_rndv = :detail_rndv, modif_date = :modifDate where id_rndv = :id_rndv";
    public const INSERT_RESERVATION                 = "insert into reservation (h_rndv, d_rndv, nom_rndv, detail_rndv, creation_date, modif_date) values (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :creationDate, :modifDate)";
    //Requetes Reservation Details
    //public const SELECT_RESERVATION_DETAILS_BY_RNDV_ID = "select id_rndv, id_presta, id_employe, num_ligne, qte from reservation_details where id_rndv = :idRDV order by num_ligne asc";
    public const SELECT_RESERVATION_DETAILS_BY_RNDV_ID = "select id_rndv, id_presta, id_employe, num_ligne, qte from ligne_detail where id_rndv = :idRDV order by num_ligne asc";
    public const INSERT_LIGNE_DETAILS = "insert into ligne_detail (id_rndv, num_ligne, qte, id_employe, id_presta) values (:id_rndv, :num_ligne, :qte, :id_employe, :id_presta)";
    public const SELECT_LIGNE_DETAILS = "select num_ligne, id_presta, id_rndv, qte, id_employe from ligne_detail order by id_rndv";
    public const UPDATE_QTY_LIGNE_DETAILS = "update ligne_detail set qte = :qte where id_rndv = :idrndv and id_presta = :idpresta and num_ligne = :numLigne";
}
?>