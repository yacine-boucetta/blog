<?php

$path_index="../../../index.php";
$path_inscription="../../pages/inscription.php";
$path_connexion="../../pages/connexion.php";
$path_profil="../../pages/profil.php";
$path_articles="../../pages/articles.php";
$path_create="../../pages/creer-article.php";
$path_admin="../../pages/admin.php";
$path_deconnexion="../../pages/deconnexion.php";
$path_article="../../pages/article.php";

require_once '../class/classArticles.php';
//require_once '../class/classCommentaire.php';
var_dump($_GET['id']);

$article = new Articles();
$getById = $article -> getArticleById($_GET['id']);

var_dump($getById);

require_once '../template/header.php';

?>

<main>
    <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid tempore iure accusamus consequatur</h1>
    <article> 
        <?php
    for ($i = 0; $i < 1; $i++) {
        echo '<article>' .
        $getById[$i]['article'] . '</br>' .
        $getById[$i]['nom'] . '</br>' .
        $getById[$i]['login'] . '</br>' .
        $getById[$i]['date'] . '</br>
        </article></a>';
        }
        ?>
    </article>
</main>