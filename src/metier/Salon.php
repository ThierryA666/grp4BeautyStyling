<?php
declare(strict_types=1);
namespace beautyStyling\metier;

use DateTime;
use beautyStyling\metier\Villes;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Offrir;

class Salon {
    private   int $id_salon;
    private   string $nom_res;
    private   string $prenom_res;
    private   string $ad1;
    private ? string $ad2;
    private   string $nom_salon;
    private   string $email_salon;
    private   string $cp_salon;
    private   string $tel_salon;
    private ? string $url_salon;
    private ? string $photo_salon;
    private   string $pw_salon;
    private ? DateTime   $date_cre;
    private   string  $nom_ville;

    public function __construct(int $id_salon, string $nom_res, string $prenom_res, string $ad1, ?string $ad2, string $nom_salon, string $email_salon, string $cp_salon, string $tel_salon, ?string $url_salon, ?string $photo_salon, string $pw_salon, DateTime $date_cre, string $nom_ville) {
        $this ->id_salon = $id_salon;
        $this ->nom_res = $nom_res;
        $this ->prenom_res =$prenom_res;
        $this ->ad1 = $ad1;
        $this ->ad2 = $ad2  !== null ? $ad2 : '';
        $this ->nom_salon = $nom_salon;
        $this ->email_salon = $email_salon;
        $this ->cp_salon = $cp_salon;
        $this ->tel_salon = $tel_salon;
        $this ->url_salon = $url_salon !== null ? $url_salon : '';
        $this ->photo_salon = $photo_salon !== null ? $photo_salon : '';
        $this ->pw_salon = $pw_salon;
        $this ->date_cre = $date_cre;
        $this ->nom_ville = $nom_ville;
    }

        public function getId_salon()  {
                return $this->id_salon;
        }
        public function setId_salon($id_salon)  {
                $this->id_salon = $id_salon;
                return $this;
        }
        public function getNom_res() {
                return $this->nom_res;
        }

        public function setNom_res($nom_res)  {
                $this->nom_res = $nom_res;
                return $this;
        }
        public function getPrenom_res() {
                return $this->prenom_res;
        }

        public function setPrenom_res($prenom_res)  {
                $this->prenom_res = $prenom_res;
                return $this;
        }

        public function getAd1()  {
                return $this->ad1;
        }

        public function setAd1($ad1) {
                $this->ad1 = $ad1;
                return $this;
        }
        
        public function getAd2() {
                return $this->ad2;
        }

        public function setAd2($ad2)  {
                $this->ad2 = $ad2;
                return $this;
        }

        public function getNom_salon() {
                return $this->nom_salon;
        }

        public function setNom_salon($nom_salon) {
                $this->nom_salon = $nom_salon;
                return $this;
        }
        public function getEmail_salon() {
                return $this->email_salon;
        }

        public function setEmail_salon($email_salon)  {
                $this->email_salon = $email_salon;
                return $this;
        }
 
        public function getCp_salon()  {
                return $this->cp_salon;
        }

        public function setCp_salon($cp_salon)  {
                $this->cp_salon = $cp_salon;
                return $this;
        }
        
        public function getTel_salon()  {
                return $this->tel_salon;
        }

        public function setTel_salon($tel_salon)  {
                $this->tel_salon = $tel_salon;
                return $this;
        }
  
        public function getUrl_salon()  {
                return $this->url_salon;
        }

        public function setUrl_salon($url_salon)   {
                $this->url_salon = $url_salon;
                return $this;
        }
  
        public function getPhoto_salon()  {
                return $this->photo_salon;
        }

        public function setPhoto_salon($photo_salon) {
                $this->photo_salon = $photo_salon;
                return $this;
        }

        public function getPw_salon() {
                return $this->pw_salon;
        }

        public function setPw_salon($pw_salon) {
                $this->pw_salon = $pw_salon;
                return $this;
        }
        
        public function getDate_cre()  {
                return $this->date_cre;
        }

        public function setDate_cre($date_cre)  {
                $this->date_cre = $date_cre;
                return $this;
        }

          
        public function getNom_ville()
        {
                return $this->nom_ville;
        }

        
        public function setNom_ville($nom_ville)
        {
                $this->nom_ville = $nom_ville;

                return $this;
        }
        public function __toString() {
                return '[Salon: '.$this->id_salon.', '.$this->nom_salon. ', Adresse:'.$this->ad1.' '.$this->ad2.' '.$this->cp_salon.' '.$this->nom_ville.', Responsable: '. $this->nom_res.' '.$this->prenom_res.', Tel: '.$this->tel_salon. ', Email: '.$this->email_salon.  '. ]';
            }
}
?>
