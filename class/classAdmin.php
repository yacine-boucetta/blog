<?php
require 'db.php';

class Admin{
    public $id;
    public $login;
    public $idDroits;
    public $db;

    public function __construct(){
        $this->db = connect();
    }
//---------------------------------------------------Update droits----------------------------------------
// public function updateDroits($login, $id_droits){
//     if(!empty($id_droits) && !empty($login)){
//         $query = $this->db->prepare("UPDATE utilisateurs SET id_droits=:id WHERE id=:id_droits");
//         $query->bindValue(':id',$id_droits, PDO::PARAM_INT);
//         $query->bindValue(':login',$login, PDO::PARAM_STR);
//         $query->execute();
//     }
//     else{
//         echo "Veuillez remplir tous les champs";
//     }
//     }
//--------------------------------------------------Ajout user -------------------------------------------------
public function registerNewUser($login, $password, $email, $id_droits){

    $error_log = null;
    $confPassword = $_POST['password2'];

    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);
    $confPassword = htmlspecialchars($confPassword);
    $email = htmlspecialchars($email);

    if(!empty($login) && !empty($password) && !empty($confPassword) && !empty($email) && !empty($id_droits)){

        $logLenght = strlen($login);
        $passLenght = strlen($password);
        $confirmLenght = strlen($confPassword);
        $mailLenght = strlen($email);

        if(($logLenght >= 6) && ($passLenght >= 6) && ($confirmLenght >= 6) && ($mailLenght >= 6)){
            $checkLength = connect()->prepare("SELECT login FROM utilisateur WHERE login=:login");
            $checkLength->bindValue(":login", $login, PDO::PARAM_STR);
            $checkLength->execute();
            $count = $checkLength->fetch();

            if(!$count){

                if($password == $confPassword){
                    $cryptpass = password_hash($password, PASSWORD_BCRYPT);

                    $insert = connect()->prepare("INSERT INTO utilisateurs (login, password, email, id_droits) VALUES (:login, :password, :email, :value)");
                    $insert->bindValue(":login", $login, PDO::PARAM_STR);
                    $insert->bindValue(":password", $cryptpass, PDO::PARAM_STR);
                    $insert->bindValue(":email", $email, PDO::PARAM_STR);
                    $insert->bindValue(":value", $id_droits, PDO::PARAM_INT);
                    $insert->execute();
                    echo "Nouvel utilisateur ajouté";

                }
                else {
                    $error_log = "confirmation du mot de passe incorrect"; 
                }
            }
            else {
                $error_log = "l'identifiant existe déjà"; 
            }
        }
        else {
            $error_log = "6 caractères minimum doivent être insérés dans chaques champs" ; 
        }
    }
    else {
        $error_log = "Champs non remplis" ; 
    }
    echo $error_log;
}
//-----------------------------------------------------UPDATE USER --------------------------------------------------------------------
public function UpdateNewUser($old_login, $login, $email, $password, $confirmPW,$idDroits){

    $login     = htmlspecialchars(trim($login));
    $email     = htmlspecialchars(trim($email));
    $password  = htmlspecialchars(trim($password));
    $confirmPW = htmlspecialchars(trim($confirmPW));

    if (!empty($login) && !empty($email) && !empty($password) && !empty($confirmPW)){

        $cryptedpass = password_hash($password, PASSWORD_BCRYPT); // CRYPTED 
        $update = connect()->prepare("UPDATE utilisateurs SET login = :login, password = :cryptedpass, email= :mail, id_droits = :idDroits WHERE login = :old_login"); 
        $update->bindValue(":login", $login, PDO::PARAM_STR);
        $update->bindValue(":cryptedpass",$cryptedpass, PDO::PARAM_STR);
        $update->bindValue(":old_login", $old_login, PDO::PARAM_STR);
        $update->bindValue(":mail",$email, PDO::PARAM_STR);
        $update->bindValue(":idDroits", $idDroits, PDO::PARAM_INT);
        $update->execute();

        }
        else{ $error_log = "veuillez remplir les champs";
        }
    
    
    if (isset ($error_log)) {
        return $error_log;
}}
//------------------------------------------------------------DELETE USER ------------------------------------------------------------
public function deleteUser($login)
{
    $deleteQuery = connect()->prepare("DELETE FROM user WHERE login = :login");
    $deleteQuery->bindValue(":login", $login, PDO::PARAM_STR);
    $deleteQuery->execute();
}
//--------------------------------------------------------liste USER------------------------------------------------------------
public function getUser(){
    $i = 0;
    $get = $this->db->prepare("SELECT * FROM utilisateurs");
    $get->execute();
    //$tableau=$get->fetch(PDO::FETCH_ASSOC);
    while($fetch = $get->fetch(PDO::FETCH_ASSOC)){
        $tableau[$i][] = $fetch['id'];
        $tableau[$i][] = $fetch['login'];
        $i++;
    }
    return $tableau;
}

public function getDisplay(){
    $display = new Admin();
    $tableau = $display->getUser();
    foreach($tableau as $value){
        echo '<option values"' .$value[0] . '">' . $value[1] . '</option>';
    }
}
//------------------------------------------------------liste droits -------------------------------------------------------------------
public function getChoice(){
    $i = 0;
    $choice = $this->db->prepare("SELECT * FROM droits");
    $choice->execute();
    while ($fetch = $choice->fetch(PDO::FETCH_ASSOC)){
        $tab[$i][] = $fetch['id'];
        $tab[$i][] = $fetch['nom'];
        $i++;
    }
    return $tab;
}
public function displayChoice(){
    $disChoice = new Admin();
    $tab = $disChoice->getChoice();
    foreach($tab as $values){
        echo '<option value="' .$values[0] . '">'. $values[1] .'</option>';
    }
}
} 
?>