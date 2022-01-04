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
public function updateDroits($login, $id_droits){
    if(!empty($id_droits) && !empty($login)){
        $query = $this->db->prepare("UPDATE utilisateurs SET id_droits=:id WHERE id=:id_droits");
        $query->bindValue(':id',$id_droits, PDO::PARAM_INT);
        $query->bindValue(':login',$login, PDO::PARAM_STR);
        $query->execute();
    }
    else{
        echo "Veuillez remplir tous les champs";
    }
    }
//--------------------------------------------------Ajout user -------------------------------------------------
public function registerNewUser($login, $password, $confPassword, $email, $id_droits){

    $errorLog = null;

    $login = htmlspecialchars($login);
    $password = htmlspecialchars($password);
    $confPassword = htmlspecialchars($confPassword);
    $email = htmlspecialchars($email);

    if(!empty($login) && !empty($password) && !empty($confPassword) && !empty($email) && !empty($id_droits)){

        $logLenght = strlen($login);
        $passLenght = strlen($password);
        $confirmLenght = strlen($confPassword);
        $mailLenght = strlen($email);

        if(($logLenght >6) && ($passLenght >6) && ($confirmLenght >6) && ($mailLengh > 6)){
            $checkLength = connect()->prepare("SELECT login FROM utilisateur WHERE login=:login");
            $checkLength->bindValue(":login", $login, PDO::PARAM_STR);
            $checkLength->execute();
            $count = $checkLength->fetch();

            if(!$count){

                if($password == $confPassword){
                    $cryptpass = password_hash($password, PASSWORD_BCRYPT);

                    $insert = connetc()->prepare("INSERT INTO utilisateur (login, password, email, id_droits) VALUES (:login, :password, email, 1)");
                    $insert->bindValue(":login", $login, PDO::PARAM_STR);
                    $insert->bindValue(":password", $password, PDO::PARAM_STR);
                    $insert->bindValue(":email", $password, PDO::PARAM_STR);
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
            $error_log = "2 caractères minimum doivent être insérés dans chaques champs" ; 
        }
    }
    else {
        $error_log = "Champs non remplis" ; 
    }
    echo $error_log;
}
//-----------------------------------------------------UPDATE USER --------------------------------------------------------------------
public function UpdateNewUser($old_login, $login, $email, $password, $confirmPW){

    $login     = htmlspecialchars(trim($login));
    $email     = htmlspecialchars(trim($email));
    $password  = htmlspecialchars(trim($password));
    $confirmPW = htmlspecialchars(trim($confirmPW));

    if (!empty($login) && !empty($email) && !empty($password) && !empty($confirmPW)){

        $cryptedpass = password_hash($password, PASSWORD_BCRYPT); // CRYPTED 
        $update = connect()->prepare("UPDATE utilisateurs SET login = :login, password = :cryptedpass, email= :mail WHERE login = :old_login"); 
        $update->bindValue(":login", $login, PDO::PARAM_STR);
        $update->bindValue(":cryptedpass",$cryptedpass, PDO::PARAM_STR);
        $update->bindValue(":old_login", $old_login, PDO::PARAM_STR);
        $update->bindValue(":mail",$email, PDO::PARAM_STR);
        
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

} 
?>