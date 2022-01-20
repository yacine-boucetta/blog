<?php

$path_index="../../index.php";
$path_inscription="../../pages/inscription.php";
$path_connexion="../../pages/connexion.php";
$path_profil="../../pages/profil.php";
$path_articles="../../pages/articles.php?p=0";
$path_create="../../pages/creer-article.php";
$path_admin="../../pages/admin.php";
$path_deconnexion="../../pages/deconnexion.php";
$path_article="../../pages/article.php";

require_once '../class/classArticles.php';
require_once '../class/classCommentaire.php';

$article = new Articles();
$getById = $article -> getArticleById($_GET['id']);

$getInfo =  new Articles();
$getInfo->getOneArticle($_GET['id']);

if(isset($_POST['updateArticle'])){
$getCatId = new Articles();
$categ = $getCatId->getIdCat($_POST['cat']);
}
//var_dump($_SESSION['article']);


if(isset($_POST['submitCom'])){
    $postComment = new Comment();
    $postComment->addComment($_POST['comment'],$_GET['id'], $_SESSION['user']['id']);
}
if(isset($_POST['delete'])){
    $deleteCom = new Articles();
    $deleteCom->deleteArt($_GET['id']);
    header('Location: ../../index.php');
}
if(isset($_POST['updateArticle'])){
    $updateCom = new Articles();
    $updateCom->updateArt((int) $_GET['id'], $_POST['updateArt'], $categ);
    header('Location: ../../index.php');
    

}

require_once '../template/header.php';

?>

<main >
    <h1>Article</h1>
    <article> 
        
        <?php
    for ($i = 0; $i < 1; $i++) {
        echo '<div class='.'testbox'.'><article>' .
        $getById[$i]['article'] . '</br>' .
        $getById[$i]['nom'] . '</br>' .
        $getById[$i]['login'] . '</br>' .
        $getById[$i]['date'] . '</br>
        </article></a><div>';
        }
        ?>
    </article>
    <article id='artCom'>
        <?php
            if(isset($_GET['id'])){
                $comment = new Comment();
                $getComment = $comment -> displayComment($_GET['id']);
                echo"<table id='tabCom'>";
                foreach($getComment as $key => $value){
                    echo "<tr class='trCom'>";
                    foreach($value as $key1 => $comment1){
                        echo "<td class='tdCom'>". $comment1 .'</td>';
                    }
                    echo '</tr>';
                }
                echo'</table>';
            }
        ?>
    </article>
    <?php
        if(isset($_SESSION['user']) && $_SESSION['user']['id_droits'] == '1337'){
            require 'deleteArticle.php';
        }
    ?>
    <article>
        <?php
            if(isset($_SESSION['user'])){
                require 'commentaire.php';
            }
        ?>
    </article>
</main>
<?php require '../template/footer.php';?>