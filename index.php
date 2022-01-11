<?php
require 'template/header.php';
require 'class/classArticles.php';

$displayIndex = new Articles();
$displayIndex->articleIndex();

//var_dump($_SESSION['artIndex']);
?>
<main>
    <article>
        <h1>Bienvenue sur Bloustache Overflow</h1>
        <p>lorem ipsum dolor sit amet, consectetur adip</p>
    </article>
    <artcle>
        <section>
            <table>
                <thead>
                    <th>Articles</th>
                    <th>Categorie</th>
                    <th>Posté par</th>
                    <th>Posté le</th>
                </thead>
                <tbody>
                    <?php
                        foreach($_SESSION['artIndex'] as $key => $value){
                            echo "<tr>";
                            foreach($value as $key1 => $value2){
                                echo '<td>'. $value2 .'<td>';
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </artcle>
</main>
<?php
require 'template/footer.php';
?>