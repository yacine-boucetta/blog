<?php 

require '../class/classArticles.php';

$article = new Articles();
$articles=$article->getArticle();
var_dump($articles);
?>

<main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Liste des articles</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur tous les articles
                        foreach($articles as $key => $value){
                        ?>
                            <tr>
                                <td><?= $article['id'] ?></td>
                                <td><?= $article['titre'] ?></td>
                                <td><?= $article['created_at'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>r
