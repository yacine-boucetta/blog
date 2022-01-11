<?php
require 'db.php';
// $error='';
class Articles{

    public $id_categories;
    public $articles;
    public $date;
    public $id_utilisateur;
    public $error='';

    function __construct() {
        $this->db=connect();
    }

//------------------------------affiche article-----------------
    public function getArticle(){
        $new_art=$this->prepare("SELECT article,nom,login,id_categorie,date FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur= utilisateurs.login INNER JOIN categories ON categories.id = articles.id_categorie ");
        $new_art->execute();
        $affichearticle=$new_art->fetchAll(PDO::FETCH_ASSOC);
    }

//------------------------------creer article-----------------

    public function createArticle(){

        if(isset($_GET['envoyer'])){
            $peudo=$_SESSION['user']['id'];
            $get_id_cat=$_GET['cat'];
            $connexion=$this->db->prepare("SELECT id FROM categories WHERE nom=:cat");
            $connexion->execute(array(
                ':cat'=>$get_id_cat
            ));
            $fetchid=$connexion->fetchall(PDO::FETCH_ASSOC);
            var_dump($fetchid);
            $comment=htmlspecialchars($_GET['comment'],ENT_QUOTES);
            $connexion=$this->db->prepare("INSERT INTO `articles`(article, id_utilisateur,id_categorie,date) VALUES (:comment,:pseudo,:cat,:date)");
            $connexion->execute(array(
                ':comment'=>$comment,
                ':pseudo'=>$_SESSION['user']['id'],
                ':cat'=> $fetchid[0]['id'],
                ':date'=>date("Y-m-d H:i:s")
            ));
            var_dump($connexion);
    }
    }
//----------------------------menu deroulant pour categorie----------------------------------------------------

    public function createCat(){
        
        if(isset($_POST['verifier'])){
            $categorie=$_POST['categorie'];   
            
            if(empty($categorie)){
                    $error='veuillez remplir le champ';
                    echo$error;
            }
            else{
            $check_categorie=$this->db->prepare("SELECT * From `categories` WHERE `nom`=:cat");
            $check_categorie->execute(array(
                ':cat'=>$categorie
            ));
            $verif_cat=$check_categorie->rowcount($check_categorie);

            if($verif_cat>0){
                $error="La catégorie existe déjà";
                echo $error;
            }

            else{
                $insert_cat=$this->db->prepare("INSERT INTO `categories`(nom) VALUES (:cat)");
                $insert_cat->execute(array(
                    ':cat'=>$categorie
                ));
            }
    }
}
    }

    public function selectCat(){
        $i= 0;
        $check_categorie=$this->db->prepare("SELECT * From `categories`");
        $check_categorie->execute();
        while($fetch_cat=$check_categorie->fetch(PDO::FETCH_ASSOC)){
            $tab[$i][] = $fetch_cat['id'];
            $tab[$i][] = $fetch_cat['nom'];
            $i++;
        }
        return $tab;
    }

    public function displayCat(){
        $choice= new Articles();
        $tab= $choice->selectCat();
        foreach($tab as $value){
        echo '<option values"' .$value[0] . '">' . $value[1] . '</option>';
    }
    }


}


?>