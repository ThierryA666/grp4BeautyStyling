<?php
namespace beautyStyling\dao;

class Requetes {
    public const SELECT_SPE     = "select id_salon, nom_salon, id_presta, nom_presta, id_employe, nom_employe from spe";
    public const SELECT_PRESTA  = "select id_presta, nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date from prestation order by id_presta asc";
    public const SELECT_PRESTA_BY_ID  = "select id_presta, nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date from prestation where id_presta = :idPresta";
    public const DELETE_PRESTA_BY_ID  = "delete from prestation where id_presta = :idPresta";
    public const UPDATE_PRESTA  = "update prestation set nom_presta = :nomPresta, duree_presta = :dureePresta, desc_presta = :descPresta, prix_ind_presta = :prixIndPresta, modif_date = :modifDate where id_presta = :idPresta";
    public const INSERT_PRESTA  = "insert into prestation (nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date) values (:nomPresta, :dureePresta, :descPresta, :prixIndPresta, :creationDate, :modifDate)";
}

?>