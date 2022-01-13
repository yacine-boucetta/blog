<?php

$path_index="../index.php";
$path_inscription="inscription.php";
$path_connexion="connexion.php";
$path_profil="profil.php";
$path_articles="articles.php";
$path_create="creer-article.php";
$path_admin="admin.php";
$path_deconnexion="deconnexion.php";
$path_article="article.php";


require_once '../class/classArticles.php';

$article = new Articles();
$ok = $article->getArticle();


?>

<main class="container">
        <div class="row">
                <section class="col-12">
                        <h1>Liste des articles</h1>
                        <?php
                        $searchcount = new Articles();
                        $searchn = $searchcount->getNumber();

                        $pagination= new Articles();
                        $pag=$pagination->getPagination(5,1);
                        for($i=1;$i<=$nb_pages;$i++){
                                if($i==$cpages){
                                echo " $i /";
                                        
                                }
                                else{
                                echo"<a href=\"index.php?p=$i\">$i</a>/";
                        } 
                        }
                        
                        
                        for ($i = 0; $i < $searchn; $i++) {
                                $path_id=$ok[$i]['id'];
                                echo '<a href='.$path_article.'/?id='.$path_id.' ><article>' .'</br>' .
                                        $ok[$i]['article'] . '</br>' .
                                        $ok[$i]['nom'] . '</br>' .
                                        $ok[$i]['login'] . '</br>' .
                                        $ok[$i]['date'] . '</br>
                        </article></a>';
                        }
                        ?>
</main>