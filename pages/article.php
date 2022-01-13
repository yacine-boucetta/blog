<?php

require '../class/classArticles.php';

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
                        var_dump($searchn);
                        for ($i = 0; $i < $searchn; $i++) {
                                echo '<article>' .
                                        $ok[$i]['article'] . '</br>' .
                                        $ok[$i]['nom'] . '</br>' .
                                        $ok[$i]['login'] . '</br>' .
                                        $ok[$i]['date'] . '</br>
                        </article>';
                        }
                        ?>
</main>