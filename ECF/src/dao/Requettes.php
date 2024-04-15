<?php
namespace beautyStyling\dao;

use beautyStyling\dao\Database;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;

class Requetes {
    public const SELECT_ETAT                        = "select id_etat, libel_etat from etat";
    public const SELECT_RESERVATION                 = "select id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon from reservation";
    public const SELECT_RESERVATION_BY_ID           = "select id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon, creation_date, modif_date from reservation where id_rndv = :id_rndv";
    public const DELETE_RESERVATION_BY_ID           = "delete from reservation where id_rndv = :id_rndv";
    public const UPDATE_RESERVATION                 = "update reservation set nom_rndv = :nom_rndv, h_rndv = :h_rndv, d_rndv = :d_rndv, detail_rndv = :detail_rndv, modif_date = :modifDate where id_rndv = :id_rndv";
    public const INSERT_RESERVATION                 = "insert into reservation (h_rndv, d_rndv, nom_rndv, detail_rndv, creation_date, modif_date) values (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :creationDate, :modifDate)";
}
?>