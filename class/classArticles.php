<?php
require 'db.php';
class Articles(){


    public $id_categories;
    public $articles;
    public $date;
    public $id_utilisateur;

    function __construct() {
        $this->db=connect();
    }



//------------------------------affiche article-----------------
    public getArticle(){
        $new_art=$this->prepare("SELECT article,nom,login,id_categorie,date FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur= utilisateurs.login INNER JOIN categories ON categories.id = articles.id_categorie ")
        $new_art->execute();
        $affichearticle=$new_art->fetchAll(PDO::FETCH_ASSOC);
    }

//------------------------------creer article-----------------

    public createArticle(){
        if(isset($_SESSION['user'])){
            $login=$_SESSION['user']['login'];
            $take_id=$this->db->prepare("SELECT id FROM `utilisateurs` WHERE `login`= :login ");
            $take_id->execute(array(':login' => $login));
            $get_id=$take_id->fetchall(PDO::FETCH_ASSOC);
            }

        if(isset($_POST['envoyer'])){
            $peudo=$_SESSION['user']['id'];
            $comment=htmlspecialchars($_POST['comment'],ENT_QUOTES);
            $connexion=$this->db->prepare("INSERT INTO `articles`(`article`, `id_utilisateur`,`id_categorie`,`date`) VALUES (:comment,:pseudo,:cat,:date)");
            $connexion->execute(array(
                ':comment'=>$comment,
                ':pseudo'=>$get_id[0]['id'],
                ':cat'=>$get_id_cat,
                ':date'=>date('Y-m-d H:i:s')
            ));
            
    }
    }
//----------------------------menu deroulant pour categorie----------------------------------------------------

    public createCat(){
        if(isset($_POST['verifier'])){
            $error='';
            $categorie=$_POST['categorie'];
            $check_categorie=$this->db->prepare("SELECT * From `categorie` WHERE `nom`=:cat");
            $check_categorie->execute(array(
                ':cat'=>$categorie
            ));
            $verif_cat->rowcount($check_categorie);

            if($verif_cat>0){
                $error='La catégorie existe déjà'
            }

            else{
                $insert_cat=$this->db->("INSERT INTO `categorie`(nom) VALUES (:cat)");
                $insert_cat->execute(array(
                    ':cat'=>$categorie
                ));
            }
    }
    }

    public selectCat(){
        $check_categorie=$this->db->prepare("SELECT * From `categorie`");
        $check_categorie->execute()
        $fetch_cat=$check_categorie->fetch(PDO::FETCH_ASSOC);
    }


}


?>