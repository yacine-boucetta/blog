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

<main >
                
                        <h1>Liste des articles</h1>
                        <form method="GET">
                        <select name='cat'>
        <?php
                $menu= new Articles;
                $menu->displayCat();
        ?>
        </select>

        <input type='submit' name="tri" ></input>
</form>
<?php

if(isset($_GET['cat'])){
        $tri = new Articles();
        $triage = $tri->getArticleByCategory($_GET['cat']); 
        $countcat=COUNT($triage);
        $par_pages=5;
        $j=$_GET['p'];
        $nb_pages= ceil($countcat/$par_pages);
        $limit=(($j)*$par_pages);
        
        
        $h=$_GET['cat'];
        $pagi = $tri->getPaginationCat($limit,$par_pages*($j+1), $h);
        for($j=0;$j<COUNT($pagi);$j++){ 
                $path_id=$pagi[$j]['id'];
                
                echo '<div class='.'testbox'.'><a href='.$path_article.'/?id='.$path_id.' ><article>' .'</br>' .
                $pagi[$j]['article'] . '</br>' .
                $pagi[$j]['nom'] . '</br>' .
                $pagi[$j]['login'] . '</br>' .
                $pagi[$j]['date'] . '</br>
                </article></a></br></div>';
        }

for($i=0;$i<$nb_pages;$i++){
        $k=$i+1;
        if($i==$nb_pages-1){
                echo"<a href=\"articles.php?p=$i&cat=$h\">$k</a>";
        }
        else{
        echo"<a href=\"articles.php?p=$i&cat=$$h\">$k</a>-";
}
}
}
else{
                        $searchcount = new Articles();
                        $searchn = $searchcount->getNumber();
                        $par_pages=5;
                        $nb_pages= ceil($searchn/$par_pages);
                        $j=$_GET['p'];
                        ?>
        
        <?php
                                if(isset($_GET['p'])){
                                
                                $limit=($j*$par_pages);
                                $var=$searchcount ->getPagination($limit,$par_pages*($j+1));
                                for($j=0;$j<COUNT($var);$j++){ 
                                        $path_id=$var[$j]['id'];
                                        echo '<div class='.'testbox'.'><a href='.$path_article.'/?id='.$path_id.' ><article>' .'</br>' .
                                        $var[$j]['article'] . '</br>' .
                                        $var[$j]['nom'] . '</br>' .
                                        $var[$j]['login'] . '</br>' .
                                        $var[$j]['date'] . '</br>
                        </article></a></br></div>';
                                }
                        } 
                        for($i=0;$i<$nb_pages;$i++){
                                $k=$i+1;
                                if($i==$nb_pages-1){
                                        echo"<a href=\"articles.php?p=$i\">$k</a>";
                                }
                                else{
                                echo"<a href=\"articles.php?p=$i\">$k</a>-";
                        }
                        }
                }
                        ?>
</main>
<?php require '../template/footer.php';?>