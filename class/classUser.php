<?php
require 'db.php';
class User{
public $login;
public $password;
public $password2;
public $db;
public $email;

function __construct(){
    $this->db=connect();
}


//----------------------------------incription--------------------------
public function user_inscription($login,$password,$password2,$email) {

    $login=htmlspecialchars($_POST['login'], ENT_QUOTES, "ISO-8859-1"); 
    $email=htmlspecialchars($_POST['email'], ENT_QUOTES, "ISO-8859-1");
    $password=htmlspecialchars($_POST['password'], ENT_QUOTES, "ISO-8859-1"); 
    $password2=htmlspecialchars($_POST['password2'], ENT_QUOTES, "ISO-8859-1"); 
    
    $sign_up=$this->db->prepare("SELECT login FROM utilisateurs WHERE login = :login ");
    $sign_up->bindValue(':login',$login);
    $sign_up->execute();
    $userExists =$sign_up->rowcount();

    $verif=$sign_up->fetchAll(PDO::FETCH_ASSOC);

    if($userExists==1){
        $message="ce nom d'utilisateur existe déjà";
    }
    
    elseif(strlen($_POST['password'])>=6){
        if($password==$password2){
            $password=password_hash($password,PASSWORD_DEFAULT);
            $sqlinsert="INSERT INTO utilisateurs(login,password,email,id_droits) VALUES(:login,:password,:email,:value)";
            $sign_up=$this->db->prepare($sqlinsert);
            $sign_up->execute(array(
                ':login' =>$login,
                ':password'=>$password,
                ':email'=>$email,
                ':value'=>1
            ));
            header("Location: connexion.php");
        }
        else $message="Les mots de passe ne sont pas identiques";
    }
    else $message= "Le mot de passe est trop court !";       
}

//----------------------------------connexion--------------------------
public function user_connexion() {

    if(isset($_POST['sign_in'])){
        $login = htmlspecialchars($_POST['login'], ENT_QUOTES, "ISO-8859-1"); 
        $password = htmlspecialchars(password_hash($_POST['password'],PASSWORD_BCRYPT));
        $sign_in = $this->db->prepare("SELECT * FROM utilisateurs WHERE login = :login ");
        $sign_in->execute(array(':login' => $login));
        $userExists = $sign_in->rowcount();
        $verifco= $sign_in->fetch(PDO::FETCH_ASSOC);
    
        if(password_verify($_POST['password'],$verifco['password'])) {
            if($userExists==1 ) {
                $_SESSION['user'] = $verifco;
                header("Location: profil.php");
        }   
    }

    else{
        $message='le login ou le mot de passe est incorrect';  
    }
    } 

}

//----------------------------------profil--------------------------
public function user_profil($login,$password,$password2,$email){

        $email= $_POST['email'];
        $password2 = $_POST['password2'];
        $password1 = $_POST['password1'];
        $login = $_POST['login'];
        $oldlogin=$_SESSION['user']['login'];

        $profil=$this->db->prepare("SELECT * FROM `utilisateurs` WHERE `login`= :login ");
        $profil->bindValue(':login',$oldlogin);
        $profil->execute();
        $verifinfo=$profil->fetchall(PDO::FETCH_ASSOC);
        
        if(isset($_POST['valider'])){
            if(empty($_POST['login'])){
                $_POST['login']=$oldlogin;
        }
            $profil=$this->db->prepare("SELECT * FROM `utilisateurs`WHERE `login`= :login ");
            $profil->bindValue(':login',$login);
            $userExists = $profil->rowcount();
            $verifprofil=$profil->fetchAll(PDO::FETCH_ASSOC);
        

        if($userExists>0){
            $message="ce pseudo existe déjà";
        }
    
        else{
            $update=$this->db->prepare("UPDATE `utilisateurs` SET `login`=:login1, `email`=:email WHERE `login`= :login");
            $update->bindValue(':login',$oldlogin ,PDO::PARAM_STR);
            $update->bindValue(':login1',$login ,PDO::PARAM_STR);
            $update->bindValue(':email',$email ,PDO::PARAM_STR);
            $update->execute();

            $update=$this->db->prepare("SELECT * FROM `utilisateurs` WHERE `login`= :login ");
            $update->bindValue(':login',$login);
            $update->execute();
            $fetch=$update->fetchall(PDO::FETCH_ASSOC);
            
            $_SESSION['user']['login']=$login;

            if(strlen($_POST['password1'])>=6){
                if($password1==$password2){
                    $password1=password_hash($password1,PASSWORD_BCRYPT);
                    $sqlinsert="INSERT INTO utilisateurs(password) VALUES(:password)";
                    $update=$this->db->prepare($sqlinsert);
                    $update->execute(array(
                    ':password'=>$password1));
            }
    }  
    }
    }
    }
}
