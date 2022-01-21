<?php
require 'db.php';
require 'classCommentaire.php';
// $error='';
class Articles
{

    public $id_categories;
    public $articles;
    public $date;
    public $id_utilisateur;
    public $error = '';

    function __construct()
    {
        $this->db = connect();
    }

    //------------------------------affiche article-----------------
    public function getArticle()
    {
        $new_art = $this->db->prepare("SELECT article,nom,utilisateurs.login,categories.nom,date,articles.id FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur= utilisateurs.id INNER JOIN categories ON categories.id = articles.id_categorie ");
        $new_art->execute();
        $affichearticle = $new_art->fetchall(PDO::FETCH_ASSOC);
        return $affichearticle;
    }
    //-------------------------------------Display article index------------------------------------------------------------------------------------------------
    public function articleIndex()
    {

        $displayArticle = $this->db->prepare("SELECT article,nom,utilisateurs.login,categories.nom,date,articles.id FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur= utilisateurs.id INNER JOIN categories ON categories.id = articles.id_categorie ORDER BY Date DESC LIMIT 3");
        $displayArticle->execute();
        $display = $displayArticle->fetchAll(PDO::FETCH_ASSOC);
        return $display;
    }

//------------------------------------------------------creer article-----------------------------------------------------

    public function createArticle()
    {

        if (isset($_GET['envoyer'])) {
            $pseudo = $_SESSION['user']['id'];
            $get_id_cat = $_GET['cat'];
            $connexion = $this->db->prepare("SELECT id FROM categories WHERE nom=:cat");
            $connexion->execute(array(
                ':cat' => $get_id_cat
            ));
            $fetchid = $connexion->fetchall(PDO::FETCH_ASSOC);
            $comment = htmlspecialchars($_GET['comment'], ENT_QUOTES);
            $connexion = $this->db->prepare("INSERT INTO `articles`(article, id_utilisateur,id_categorie,date) VALUES (:comment,:pseudo,:cat,:date)");
            $connexion->execute(array(
                ':comment' => $comment,
                ':pseudo' => $_SESSION['user']['id'],
                ':cat' => $fetchid[0]['id'],
                ':date' => date("Y-m-d H:i:s")
            ));
        }
    }



    public function getNumber()
    {
        $search = $this->db->prepare("SELECT * FROM articles");
        $search->execute();
        $searchcount = $search->rowcount($search);
        return $searchcount;
    }
    //----------------------------menu deroulant pour categorie----------------------------------------------------

    public function createCat()
    {

        if (isset($_POST['verifier'])) {
            $categorie = $_POST['categorie'];

            if (empty($categorie)) {
                $error = 'veuillez remplir le champ';
                echo $error;
            } else {
                $check_categorie = $this->db->prepare("SELECT * From `categories` WHERE `nom`=:cat");
                $check_categorie->execute(array(
                    ':cat' => $categorie
                ));
                $verif_cat = $check_categorie->rowcount($check_categorie);

                if ($verif_cat > 0) {
                    $error = "La catégorie existe déjà";
                    echo $error;
                } else {
                    $insert_cat = $this->db->prepare("INSERT INTO `categories`(nom) VALUES (:cat)");
                    $insert_cat->execute(array(
                        ':cat' => $categorie
                    ));
                }
            }
        }
    }

    public function selectCat()
    {
        $i = 0;
        $check_categorie = $this->db->prepare("SELECT * From `categories`");
        $check_categorie->execute();
        while ($fetch_cat = $check_categorie->fetch(PDO::FETCH_ASSOC)) {
            $tab[$i][] = $fetch_cat['id'];
            $tab[$i][] = $fetch_cat['nom'];
            $i++;
        }
        return $tab;
    }

    public function displayCat()
    {
        $choice = new Articles();
        $tab = $choice->selectCat();
        foreach ($tab as $value) {
            echo '<option value="' . $value[0] . '">' . $value[1] . '</option>';
        }
    }
//----------------------------------------------Article by ----------------------------------------------------------------
    public function getArticleById($id){
        $artById = $this->db->prepare("SELECT article,nom,utilisateurs.login,categories.nom, articles.id,date FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur= utilisateurs.id INNER JOIN categories ON categories.id = articles.id_categorie WHERE articles.id = :id");
        $artById->bindValue(':id', $_GET['id'], PDO::PARAM_STR);
        $artById->execute();
        $result = $artById->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //------------------------------Pagination--------------------------------------------

    public function getPagination($limit, $par_pages)
    {
        $pagination = $this->db->prepare("SELECT article,nom,utilisateurs.login,categories.nom,date,articles.id FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur= utilisateurs.id INNER JOIN categories ON categories.id = articles.id_categorie ORDER BY Date LIMIT :limited, :par_pages");
        $pagination->bindParam(':limited', $limit, PDO::PARAM_INT);
        $pagination->bindParam(':par_pages', $par_pages, PDO::PARAM_INT);
        $pagination->execute();
        $p = $pagination->fetchall(PDO::FETCH_ASSOC);
        return $p;
    }

    public function getPaginationCat($limit, $par_pages, $id)
    {
        $paginationCat = $this->db->prepare("SELECT article,nom,utilisateurs.login,categories.nom,date,articles.id FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur= utilisateurs.id INNER JOIN categories ON categories.id = articles.id_categorie WHERE id_categorie = :id ORDER BY Date LIMIT :limited, :par_pages ");
        $paginationCat->bindParam(':limited', $limit, PDO::PARAM_INT);
        $paginationCat->bindParam(':par_pages', $par_pages, PDO::PARAM_INT);
        $paginationCat->bindParam(':id', $id, PDO::PARAM_INT);
        $paginationCat->execute();
        $p = $paginationCat->fetchall(PDO::FETCH_ASSOC);
        return $p;
        var_dump($p);
    }
    //-----------------------------------DELETE Article------------------------------------------------------------------------------------------------
    public function deleteArt($id){
        $delete = $this->db->prepare("DELETE FROM articles WHERE id = :id ");
        $delete->bindValue(':id', $id, PDO::PARAM_STR);
        $delete->execute();
    }
    //----------------------------------Update article----------------------------------------------------------------------------------------------------------------
    public function getOneArticle($id){

        $getArticle = $this->db->prepare("SELECT * FROM articles WHERE id = :id ");
        $getArticle->bindValue(':id', $id, PDO::PARAM_STR);
        $getArticle->execute();
        $getArt = $getArticle->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['article'] = $getArt;
    }

    public function getIdCat($nom){
        $getIdCat = $this->db->prepare("SELECT id FROM categories WHERE nom = :nom ");
        $getIdCat->bindValue(':nom', $nom, PDO::PARAM_STR);
        $getIdCat->execute();
        $getId = $getIdCat->fetchAll(PDO::FETCH_ASSOC);
        return $getId;
    }

    public function updateArt($id, $article, $cat){
        $id=(int)$id;
        $cat=(int)$cat;
        if(empty($_POST['updateArt'])){
            $article = $_SESSION['article']['0']['article'];
        }
        if(empty($_POST['cat'])){
            $cat = $_SESSION['article']['0']['id_categorie'];
        }

        $update = $this->db->prepare(
        "UPDATE articles
        SET article = :article , id_categorie = :categories 
        WHERE id = :id");

        $test=$update->execute(array(
            ':id' =>$id, 
            ':categories' =>$cat,
            'article'=>$article
        ));
        // var_dump($id);
        // var_dump($test);
    }

//------------------------------------------------Get article by categories----------------------------------------------------------------
public function getArticleByCategory($id){
    $id =(int)$id;
    $getArtCat = $this->db->prepare("SELECT articles.id, article, id_categorie, date, utilisateurs.login FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id WHERE id_categorie = :id);
    $getArtCat->bindValue(':id',$id, PDO::PARAM_INT);
    $getArtCat->execute();
    $get = $getArtCat->fetchAll(PDO::FETCH_ASSOC);
    return $get;

}
}
