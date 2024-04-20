<<<<<<< HEAD
<?php
declare(strict_types=1);
namespace beautyStyling\metier;

class Villes{
    private int $ville_id;
    private ? string $ville_departement;
    private ? string $ville_slug;
    private ? string $ville_nom;
    private ? string $ville_nom_simple;
    private ? string $ville_nom_reel;
    private ? string $ville_nom_sondex;
    private ? string $ville_nom_metaphone;
    private ? string $ville_code_postal;
    private ? string $ville_commune;
    private  string $ville_code_commune;
    private ? int $ville_arrondissement;
    private ? string $ville_canton;
    private ? int $ville_amdi;
    private ? int $ville_population_2010;
    private ? int $ville_population_1999;
    private ? int $ville_population_2012;
    private ? int $ville_densite_2010;
    private ? float $ville_surface;
    private ? float $ville_longitude_deg;
    private ? float $ville_latitude_deg;
    private ? string $ville_longitude_grd;
    private ? string $ville_latitude_grd;
    private ? string $ville_longitude_dms;
    private ? string $ville_latitude_dms;
    private ? int $ville_zmin;
    private ? int $ville_zmax;

    public function __construct (    
    int $ville_id,
    string $ville_departement,
    string $ville_slug,
    string $ville_nom,
    string $ville_nom_simple,
    string $ville_nom_reel,
    string $ville_nom_sondex,
    string $ville_nom_metaphone,
    string $ville_code_postal,
    string $ville_commune,
    string $ville_code_commune,
    int $ville_arrondissement,
    string $ville_canton,
    int $ville_amdi,
    int $ville_population_2010,
    int $ville_population_1999,
    int $ville_population_2012,
    int $ville_densite_2010,
    float $ville_surface,
    float $ville_longitude_deg,
    float $ville_latitude_deg,
    string $ville_longitude_grd,
    string $ville_latitude_grd,
    string $ville_longitude_dms,
    string $ville_latitude_dms,
    int $ville_zmin,
    int $ville_zmax ) {
        $this-> ville_id = $ville_id;
        $this-> ville_departement = $ville_departement;
        $this-> ville_slug = $ville_slug;
        $this-> ville_nom = $ville_nom;
        $this-> ville_nom_simple= $ville_nom_simple;
        $this-> ville_nom_reel = $ville_nom_reel;
        $this-> ville_nom_sondex = $ville_nom_sondex;
        $this-> ville_nom_metaphone = $ville_nom_metaphone;
        $this-> ville_code_postal = $ville_code_postal;
        $this-> ville_commune = $ville_commune;
        $this-> ville_code_commune = $ville_code_commune;
        $this-> ville_arrondissement = $ville_arrondissement;
        $this-> ville_canton = $ville_canton;
        $this-> ville_amdi = $ville_amdi;
        $this-> ville_population_2010 = $ville_population_2010;
        $this-> ville_population_1999 = $ville_population_1999;
        $this-> ville_population_2012 = $ville_population_2012;
        $this-> ville_densite_2010 = $ville_densite_2010;
        $this-> ville_surface = $ville_surface;
        $this-> ville_longitude_deg = $ville_longitude_deg;
        $this-> ville_latitude_deg = $ville_latitude_deg;
        $this-> ville_longitude_grd = $ville_longitude_grd;
        $this-> ville_latitude_grd = $ville_latitude_grd;
        $this-> ville_longitude_dms = $ville_longitude_dms;
        $this-> ville_latitude_dms = $ville_latitude_dms;
        $this-> ville_zmin = $ville_zmin;
        $this-> ville_zmax = $ville_zmax;
        
    }

    public function getVille_id()
    {
        return $this->ville_id;
    }

    public function setVille_id($ville_id)
    {
        $this->ville_id = $ville_id;

        return $this;
    }

    public function getVille_nom()
    {
        return $this->ville_nom;
    }

    public function setVille_nom($ville_nom)
    {
        $this->ville_nom = $ville_nom;

        return $this;
    }
=======
<?php
declare(strict_types=1);
namespace beautyStyling\metier;

class Villes{
    private int $ville_id;
    private ? string $ville_departement;
    private ? string $ville_slug;
    private ? string $ville_nom;
    private ? string $ville_nom_simple;
    private ? string $ville_nom_reel;
    private ? string $ville_nom_sondex;
    private ? string $ville_nom_metaphone;
    private ? string $ville_code_postal;
    private ? string $ville_commune;
    private  string $ville_code_commune;
    private ? int $ville_arrondissement;
    private ? string $ville_canton;
    private ? int $ville_amdi;
    private ? int $ville_population_2010;
    private ? int $ville_population_1999;
    private ? int $ville_population_2012;
    private ? int $ville_densite_2010;
    private ? float $ville_surface;
    private ? float $ville_longitude_deg;
    private ? float $ville_latitude_deg;
    private ? string $ville_longitude_grd;
    private ? string $ville_latitude_grd;
    private ? string $ville_longitude_dms;
    private ? string $ville_latitude_dms;
    private ? int $ville_zmin;
    private ? int $ville_zmax;

    public function __construct (    
    int $ville_id,
    string $ville_departement,
    string $ville_slug,
    string $ville_nom,
    string $ville_nom_simple,
    string $ville_nom_reel,
    string $ville_nom_sondex,
    string $ville_nom_metaphone,
    string $ville_code_postal,
    string $ville_commune,
    string $ville_code_commune,
    int $ville_arrondissement,
    string $ville_canton,
    int $ville_amdi,
    int $ville_population_2010,
    int $ville_population_1999,
    int $ville_population_2012,
    int $ville_densite_2010,
    float $ville_surface,
    float $ville_longitude_deg,
    float $ville_latitude_deg,
    string $ville_longitude_grd,
    string $ville_latitude_grd,
    string $ville_longitude_dms,
    string $ville_latitude_dms,
    int $ville_zmin,
    int $ville_zmax ) {
        $this-> ville_id = $ville_id;
        $this-> ville_departement = $ville_departement;
        $this-> ville_slug = $ville_slug;
        $this-> ville_nom = $ville_nom;
        $this-> ville_nom_simple= $ville_nom_simple;
        $this-> ville_nom_reel = $ville_nom_reel;
        $this-> ville_nom_sondex = $ville_nom_sondex;
        $this-> ville_nom_metaphone = $ville_nom_metaphone;
        $this-> ville_code_postal = $ville_code_postal;
        $this-> ville_commune = $ville_commune;
        $this-> ville_code_commune = $ville_code_commune;
        $this-> ville_arrondissement = $ville_arrondissement;
        $this-> ville_canton = $ville_canton;
        $this-> ville_amdi = $ville_amdi;
        $this-> ville_population_2010 = $ville_population_2010;
        $this-> ville_population_1999 = $ville_population_1999;
        $this-> ville_population_2012 = $ville_population_2012;
        $this-> ville_densite_2010 = $ville_densite_2010;
        $this-> ville_surface = $ville_surface;
        $this-> ville_longitude_deg = $ville_longitude_deg;
        $this-> ville_latitude_deg = $ville_latitude_deg;
        $this-> ville_longitude_grd = $ville_longitude_grd;
        $this-> ville_latitude_grd = $ville_latitude_grd;
        $this-> ville_longitude_dms = $ville_longitude_dms;
        $this-> ville_latitude_dms = $ville_latitude_dms;
        $this-> ville_zmin = $ville_zmin;
        $this-> ville_zmax = $ville_zmax;
        
    }

    public function getVille_id()
    {
        return $this->ville_id;
    }

    public function setVille_id($ville_id)
    {
        $this->ville_id = $ville_id;

        return $this;
    }

    public function getVille_nom()
    {
        return $this->ville_nom;
    }

    public function setVille_nom($ville_nom)
    {
        $this->ville_nom = $ville_nom;

        return $this;
    }
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
}