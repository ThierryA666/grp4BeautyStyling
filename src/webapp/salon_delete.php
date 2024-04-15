<?php
declare(strict_types=1);
namespace beautyStyling\webapp;
require_once 'C:\workspace\ECF\Takako_ECF_Git\vendor\autoload.php';
use beautyStyling\metier\Salon;
use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;

$message = ' ';


    $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
  
    if ($id_salon === null) {
        $message = "Ce salon est inexistant.";
        } else {
            $dao = new DaoBeauty();
            $salon = $dao->getSalonByID($id_salon);
        }
    //         $dao->delSalonByID($salon);
    //         $message = "Ce salon a été supprimé";
    //         }
    // } catch (DmException $e) {
    //         $message = $e->getCode() . ' - ' . $e->getMessage();
    // } catch (\Exception $e) {
    //         $message = $e->getCode() . ' - ' . $e->getMessage();
    // } catch (\Error $e) {
    //         $message = $e->getMessage();
    // } 
    

include '../view/vsalon_delete.php';
