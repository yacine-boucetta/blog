<?php
//----------Chemins------------------
$path_index="index.php";
$path_inscription="pages/inscription.php";
$path_connexion="pages/connexion.php";
$path_profil="pages/profil.php";
$path_articles="pages/articles.php?p=0";
$path_create="pages/creer-article.php";
$path_admin="pages/admin.php";
$path_deconnexion="pages/deconnexion.php";
$path_article="pages/article.php";

require 'class/classArticles.php';

$displayIndex = new Articles();
$dis=$displayIndex->articleIndex();

require 'template/header.php';
?>
<main>
    <article>
        <h1>Bienvenue sur Bloustache Overflow</h1>
        <p>La référence de la barbe et de la moustache</p>
        <p>les poilus bienvenue</p>
    </article>
    <article>
        <?php
        for ($i = 0; $i < 3; $i++) {
        $path_id=$dis[$i]['id'];
        echo '<form method=post class='.'testbox'.'><a href='.$path_article.'/?id='.$path_id.'><article>' .
                        $dis[$i]['article'] . '</br>' .
                        $dis[$i]['nom'] . '</br>' .
                        $dis[$i]['login'] . '</br>' .
                        $dis[$i]['date'] . '</br>
        </article></a></form>';
        }
    ?>
    </article>
</main>
<?php
require 'template/footer.php';
?>