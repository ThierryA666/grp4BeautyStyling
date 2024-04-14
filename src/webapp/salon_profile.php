<?php
declare(strict_types=1);
namespace beautyStyling\webapp;
require_once '../../vendor/autoload.php';
use beautyStyling\metier\Salon;
use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;

$message='';


// Verifier s'il y a des donnes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['clickedButton'])) { 
                $clickedButton = $_POST['clickedButton'];
            if ($clickedButton === 'modif') {
                // quand modifier est cliquee:
                $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;
                if($id_salon === null) {
                    // s'il n'y a pas d'id
                    $message = "ID du salon invalide.";
                } else {
                    // si c'est ok, requpere le data de salon et les afficher
                    $dao = new DaoBeauty();
                    $salon = $dao->getSalonByID($id_salon);
                    
                    // echo 'btn modif clicked';
                }

            } elseif ($clickedButton === 'update') {
                //quand enregistrer est cliquee:
            // echo 'btn update clicked';
            $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;

            if($id_salon === null) {
                // s'il n'y a pas d'id
                $message = "ID du salon invalide.";
            }else {
                // si c'est ok, requpere le data de salon et renouveler
                    $dao = new DaoBeauty();
                    $salon = $dao->getSalonByID($id_salon);
                
                // recuperer les valeurs modifiees
                    $nom_res = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : '';
                    $prenom_res = isset($_POST['prenom']) ? htmlspecialchars(trim($_POST['prenom'])) : '';
                    $ad1 = isset($_POST['ad1']) ? htmlspecialchars(($_POST['ad1'])) : '';
                    $ad2 = isset($_POST['ad2']) ? htmlspecialchars(($_POST['ad2'])) : '';
                    $email_salon = isset($_POST['email']) ? htmlspecialchars(($_POST['email'])) : '';
                    //   type char -> int
                    $tel_salon = isset($_POST['tel']) ? ($_POST['tel']) : 0;
                    $cp_salon = isset($_POST['zip']) ? ($_POST['zip']) : '';
                    $nom_ville = isset($_POST['ville']) ? ($_POST['ville']) : '';
                    $nom_salon = isset($_POST['nom_salon']) ? htmlspecialchars(trim(($_POST['nom_salon']))) : '';
                    $url = isset($_POST['url']) ? ($_POST['url']) : '';
                    $photo_salon = isset($_FILES['photo']['name']) ? ($_FILES['photo']['name']) : '';
                    $pw_salon = isset($_POST['pw']) ? ($_POST['pw']) : '';
                            
                    // 新しいSalonオブジェクトを作成
                    $updatedSalon = new Salon (
                    $id_salon,
                    $nom_res,
                    $prenom_res,
                    $ad1,
                    $ad2,
                    $nom_salon,
                    $email_salon,
                    $cp_salon,
                    $tel_salon,
                    $url,
                    $photo_salon,
                    $pw_salon,
                    $salon->getDate_cre(),
                    $nom_ville
                    );
                
                // 更新をデータベースに反映
                $dao->updateSalonByID($updatedSalon);
                $salon = $updatedSalon;
                $salon = $dao->getSalonByID($id_salon);
                
                $message = "Votre salon a été bien modifié";
            }  
            } 
        }
    }catch (DaoException $e) {
        $message = $e->getCode() . ' - ' . $e->getMessage();
    } catch (\Exception $e) {
        $message = $e->getCode() . ' - ' . $e->getMessage();
    } catch (\Error $e) {
        $message = $e->getMessage();
    }       
                         
} else {
// Lors du premier chargement de la page 
    $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
    if ($id_salon === null) {
        $message = "Ce salon est inexistant.";
        } else {
            $dao = new DaoBeauty();
            $salon = $dao->getSalonByID($id_salon);
            }
    }
    

include '../view/vsalon_profile.php';


// // afficher des infos de compte dans le formulaire
// $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
// if ($id_salon === null) {
//     $message = "Ce salon est inexistant.";
// } else {
//     $dao = new DaoBeauty();
//     $salon = $dao->getSalonByID($id_salon);
// }

// if (isset($_POST['clickedButton'])) {
//     $clickedButton = $_POST['clickedButton'];
//     if ($clickedButton === 'modif') {
//         // POSTされた値を取得して処理する
//         $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;
//         if($id_salon === null) {
//         // IDが無効な場合はエラー処理
//         $message = "ID du salon invalide.";
//         } else {
//         // 有効なIDの場合、Salonオブジェクトを作成して更新処理を行う
//         $dao = new DaoBeauty();
//         $salon = $dao->getSalonByID($id_salon);
            
//         echo 'btn modif clicked';
//         }
//     } 
//     elseif ($clickedButton === 'update') {
//         echo 'btn update clicked';
//     }
// }


// // 更新がリクエストされた場合の処理
// if(isset($_POST['update'])){
//     try{
//         // POSTされた値を取得して処理する
//         $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;
//         if($id_salon === null) {
//             // IDが無効な場合はエラー処理
//             $message = "ID du salon invalide.";
//         } else {
//             // 有効なIDの場合、Salonオブジェクトを作成して更新処理を行う
//             $dao = new DaoBeauty();
//             $salon = $dao->getSalonByID($id_salon);
//             if($salon) {
//                 // サロンが見つかった場合は更新を行う
//                 // POSTされた値を取得し、適切に処理する
//                 $nom_res = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : '';
//                 $prenom_res = isset($_POST['prenom']) ? htmlspecialchars(trim($_POST['prenom'])) : '';
//                 $ad1 = isset($_POST['ad1']) ? htmlspecialchars(($_POST['ad1'])) : '';
//                 $ad2 = isset($_POST['ad2']) ? htmlspecialchars(($_POST['ad2'])) : '';
//                 $email_salon = isset($_POST['email']) ? htmlspecialchars(($_POST['email'])) : '';
//                 // type char -> int
//                 $tel_salon = isset($_POST['tel']) ? intval(($_POST['tel'])) : 0;
//                 $cp_salon = isset($_POST['zip']) ? ($_POST['zip']) : '';
//                 $nom_ville = isset($_POST['ville']) ? ($_POST['ville']) : '';
//                 $nom_salon = isset($_POST['salonName']) ? htmlspecialchars(trim(($_POST['salonName']))) : '';
//                 $url = isset($_POST['url']) ? ($_POST['url']) : '';
//                 $photo_salon = isset($_FILES['photo']['name']) ? ($_FILES['photo']['name']) : '';
//                 $pw_salon = isset($_POST['pw']) ? ($_POST['pw']) : '';
                
//                 // 新しいSalonオブジェクトを作成
//                 $updatedSalon = new Salon (
//                     $id_salon,
//                     $nom_res,
//                     $prenom_res,
//                     $ad1,
//                     $ad2,
//                     $nom_salon,
//                     $email_salon,
//                     $cp_salon,
//                     $tel_salon,
//                     $url,
//                     $photo_salon,
//                     $pw_salon,
//                     $salon->getDate_cre(),
//                     $nom_ville
//                 );
                
//                 // 更新をデータベースに反映
//                 $dao->updateSalonByID($updatedSalon);
//                 // 表示用のデータを設定
//                 $data = [
//                     'salon' => $updatedSalon,
//                     'message' => 'Salon mis à jour avec succès.'
//                 ];
//             } else {
//                 // サロンが見つからなかった場合はエラー処理
//                 $message = "Salon introuvable.";
//             }
//         }
//     } catch (DaoException $e) {
//         $message = $e->getCode() . ' - ' . $e->getMessage();
//     } catch (\Exception $e) {
//         $message = $e->getCode() . ' - ' . $e->getMessage();
//     } catch (\Error $e) {
//         $message = $e->getMessage();
//     } 
// }
// if (isset($_POST['update'])) {
//     try {
//         // サロンIDを更新フォームから取得
//         $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;
//         if ($id_salon === null) {
//             throw new \Exception("ID du salon invalide lors de la mise à jour.");
//         }
        
//         // サロン情報を更新
//         $nom_res = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : null;
//         $prenom_res = isset($_POST['prenom']) ? htmlspecialchars(trim($_POST['prenom'])) : null;
//         $ad1 = isset($_POST['ad1']) ? htmlspecialchars($_POST['ad1']) : null;
//         $ad2 = isset($_POST['ad2']) ? htmlspecialchars($_POST['ad2']) : null;
//         $email_salon = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
//         $tel_salon = isset($_POST['tel']) ? intval($_POST['tel']) : null;
//         $cp_salon = isset($_POST['zip']) ? $_POST['zip'] : null;
//         $nom_ville = isset($_POST['ville']) ? $_POST['ville'] : null;
//         $nom_salon = isset($_POST['salonName']) ? htmlspecialchars(trim($_POST['salonName'])) : null;
//         $url = isset($_POST['url']) ? $_POST['url'] : null;
//         $photo_salon = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : null;
//         $pw_salon = isset($_POST['pw']) ? $_POST['pw'] : null;

//         // サロンオブジェクトを更新
//         $salon->setNom_res($nom_res);
//         $salon->setPrenom_res($prenom_res);
//         $salon->setAd1($ad1);
//         $salon->setAd2($ad2);
//         $salon->setEmail_salon($email_salon);
//         $salon->setTel_salon($tel_salon);
//         $salon->setCp_salon($cp_salon);
//         $salon->setNom_ville($nom_ville);
//         $salon->setNom_salon($nom_salon);
//         $salon->setUrl_salon($url);
//         $salon->setPhoto_salon($photo_salon);
//         $salon->setPw_salon($pw_salon);

//         // サロン情報をデータベースに更新
//         $dao->updateSalonByID($salon);

//         // 更新後のサロン情報を再度取得
//         $updatedSalon = $dao->getSalonByID($id_salon);

//         // メッセージを設定
//         $message = "Salon mis à jour avec succès.";

//         // 更新後のサロン情報とメッセージをビューに渡す
//         $data = [
//             'salon' => $updatedSalon,
//             'message' => $message
//         ];

//     } catch (\Exception $e) {
//         $message = $e->getMessage();
//     }
// }

// ビューを含める


// $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
// if ($id_salon === null) {
//     $message="Ce salon est inexistant.";
// } else {
//     $dao = new DaoBeauty();
//     $salon = $dao->getSalonByID($id_salon);
// }

// if(isset($_POST['update'])){
//     try{
//         $dao = new DaoBeauty();
//         $salon = $dao->getSalonByID($id_salon);
//         var_dump($salon);
//         // if(isset($_POST['id_salon'])) $id_salon = intval($_POST['id_salon']);     
//         if(isset($_POST['nom'])) $nom_res = htmlspecialchars(trim($_POST['nom']));
//         if(isset($_POST['prenom'])) $prenom_res = htmlspecialchars(trim($_POST['prenom']));
//         if(isset($_POST['ad1'])) $ad1 = htmlspecialchars(($_POST['ad1']));
//         if(isset($_POST['ad2'])) $ad2 = htmlspecialchars(($_POST['ad2']));
//         if(isset($_POST['email'])) $email_salon = htmlspecialchars(($_POST['email']));
//         // type char -> int
//         if(isset($_POST['tel'])) $tel_salon = intval(($_POST['tel']));
//         if(isset($_POST['zip'])) $cp_salon = ($_POST['zip']);
//         if(isset($_POST['ville'])) $nom_ville = ($_POST['ville']);
//         if(isset($_POST['salonName'])) $nom_salon = htmlspecialchars(trim(($_POST['salonName'])));
//         if(isset($_POST['url'])) $url = ($_POST['url']);
//         if(isset($_FILES['photo'])) $photo_salon = ($_FILES['photo']['name']);
//         if(isset($_POST['pw'])) $pw_salon = ($_POST['pw']);
//         $salon->setNom_res($nom_res);
//         $salon->setPrenom_res($prenom_res);
//         $salon->setAd1($ad1);
//         $salon->setAd2($ad2);
//         $salon->setEmail_salon($email_salon);
//         $salon->setTel_salon($tel_salon);
//         $salon->setCp_salon($cp_salon);
//         $salon->setNom_ville($nom_ville);
//         $salon->setNom_salon($nom_salon);
//         $salon->setUrl_salon($url);
//         $salon->setPhoto_salon($photo_salon);
//         $salon->setPw_salon($pw_salon);
//         $dao->updateSalonByID($salon);
//         $updatedSalon = $dao->getSalonByID($id_salon);
//         $data = [
//             'salon' => $updatedSalon,
//             'message' => $message // 他のメッセージやデータがあればここに追加
//         ];
//         var_dump($data);
       

//     }
//  catch (\Exception $e) {
//     echo 'エラー: ', $e->getMessage(), PHP_EOL;
// }

//     // catch (DaoException $e) {
//     //     $message = $e->getCode() . ' - ' . $e->getMessage();
//     // } catch (\Exception $e) {
//     //     $message = $e->getCode() . ' - ' . $e->getMessage();
//     // } catch (\Error $e) {
//     //     $message = $e->getMessage();
//     // } 

// }

