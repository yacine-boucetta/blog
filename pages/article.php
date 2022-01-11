<?php 

$path_index="../index.php";
$path_inscription="inscription.php";
$path_connexion="connexion.php";
$path_profil="profil.php";
$path_articles="articles.php";
$path_create="creer-article.php";
$path_admin="admin.php";
$path_deconnexion="deconnexion.php";

require '../class/classArticles.php';

$article = new Articles();
$article->getArticle();
var_dump($article);
?>

<main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Liste des articles</h1>
                <table class="table">
        <thead>
            <th>Article</th>
            <th>login</th>
            <th>categorie</th>
            <th>date</th>
        </thead>
        <tbody>
            <tr>
                <?php foreach($_SESSION['article'] as $key => $value){ 
                    echo '<tr>';
                    foreach ($value as $key1 => $value1) 
                        {
                            echo "<td>$value1</td>";
                        }
                    echo '</tr>'; 
                }
                ?>
        </tbody>
    </table>
            </section>
        </div>
    </main>
