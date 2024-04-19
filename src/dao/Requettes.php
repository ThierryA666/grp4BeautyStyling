<?php
namespace beautyStyling\dao;

use PDO;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\dao\DaoException;
use beautyStyling\dao\Database;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;
use beautyStyling\metier\Client;
use beautyStyling\metier\Salon;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\LigneDetails;

class Requettes {
    public const SELECT_ETAT                                        = "select id_etat, libel_etat from etat";

    public const SELECT_RESERVATION                                 = "select id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon from reservation";
    public const SELECT_RESERVATION_BY_ID                           = "select id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon from reservation where id_rndv = :id_rndv";
    public const DELETE_RESERVATION_BY_ID                           = "delete from reservation where id_rndv = :id_rndv";
    public const INSERT_RESERVATION                                 = "insert into reservation (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon ) values (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :id_etat, :id_client, :id_salon)";
    public const SELECT_RESERVATION_DETAILS_BY_RNDV_ID              = "select id_rndv, id_presta, id_employe, num_ligne, qte from ligne_detail where id_rndv = :idRDV order by num_ligne asc";

    public const SELECT_PRESTA_BY_ID                                = "select id_presta, nom_presta, duree_presta, desc_presta, prix_ind_presta, creation_date, modif_date from prestation where id_presta = :idPresta";
    public const SELECT_PRESTA_BY_SALON                             ="select o.id_presta, p.nom_presta, o.prix_prest_salon
                                                                        from offrir o join prestation p on o.id_presta = p.id_presta where o.id_salon = :id_salon group by o.id_presta, p.nom_presta, o.prix_prest_salon order by o.id_presta asc";

    public const SELECT_SALON_BY_ID                                 = "select id_salon, nom_res, prenom_res,  ad_1, ad_2, nom_salon, email_salon, cp_salon, tel_salon, url_salon, photo_salon, pw_salon, date_cre, nom_ville from salon WHERE id_salon = :id_salon";

    public const DELETE_LIGNE_DETAILS                               = "delete from ligne_detail where id_rndv = :idRndv";
    public const INSERT_LIGNE_DETAILS                               = "insert into ligne_detail (id_rndv, num_ligne, qte, id_employe, id_presta) values (:id_rndv, :num_ligne, 1, 1, :id_presta)";
}
?>