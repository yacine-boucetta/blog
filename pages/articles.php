<?php

$path_index="../index.php";
$path_inscription="inscription.php";
$path_connexion="connexion.php";
$path_profil="profil.php";
$path_articles="articles.php?p=0";
$path_create="creer-article.php";
$path_admin="admin.php";
$path_deconnexion="deconnexion.php";
$path_article="article.php";


require_once '../class/classArticles.php';

$article = new Articles();
$ok = $article->getArticle();
require '../template/header.php';
?>

<main class="container">
        <div class="row">
                <section class="col-12">
                        <h1>Liste des articles</h1>
                        <?php
                        $searchcount = new Articles();
                        $searchn = $searchcount->getNumber();

                        $par_pages=5;
                        $nb_pages= ceil($searchn/$par_pages);
                        // $_GET['p']=0;
                        $j=$_GET['p'];
                        for($i=0;$i<$nb_pages;$i++){
                                echo"<a href=\"articles.php?p=$i\">$i</a>-";
                        }
                                if(isset($_GET['p'])){
                                
                                $limit=($j*$par_pages);
                                $nb_pagination= new Articles();
                                $var=$nb_pagination->getPagination($limit,$par_pages*($j+1));
                                for($j=0;$j<5;$j++){ 
                                        if (!isset($var[$j])){
                                                return $j;
                                        }
                                        $path_id=$var[$j]['id'];
                                        echo '<a href='.$path_article.'/?id='.$path_id.' ><article>' .'</br>' .
                                        $var[$j]['article'] . '</br>' .
                                        $var[$j]['nom'] . '</br>' .
                                        $var[$j]['login'] . '</br>' .
                                        $var[$j]['date'] . '</br>
                        </article></a>';
                                }
                        }
                        ?>
</main>