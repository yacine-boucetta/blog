<?php

$path_index="../index.php";
$path_inscription="inscription.php";
$path_connexion="connexion.php";
$path_profil="profil.php";
$path_articles="articles.php?p=0";
$path_create="creer-article.php";
$path_admin="admin.php";
$path_deconnexion="deconnexion.php";

require '../class/classArticles.php';
if(empty($_SESSION['user']) || $_SESSION['user']['id_droits'] == 1 || $_SESSION['user'] == ''){ 
    header('Location:../index.php');
}
?>
<?php require '../template/header.php';?>
<form method='post'  class='testbox'>
<p>
<?php
    $creat_art= new Articles;
    $creat_art->createCat() ;
    $creat_art->createArticle();?> 
</p>
<div  class='item'>
<input  type="text" name="categorie"  placeholder="créer une catégorie">
</div>

<div  class='item'>
<input type='submit' name='verifier'value='verifier' />
</div>

</form>

<form method='get' class='testbox'>

<p>écrivez un article</p>

<div  class='item'>
<select name='cat'>
    <?php
        $menu= new Articles;
        $menu->displayCat();
    ?>
</select> 
</div>

<div  class='item'>
<p>
    Pseudo :<?php echo $_SESSION['user']['login']; ?><input name='pseudo' value='<?php echo $_SESSION['user']['id'] ?>' type='hidden' >  <br />
    article :<br />
    <textarea name='comment' rows='20' cols='60' style='resize:none'></textarea><br />
    <input type='submit' name='envoyer'value='envoyer' />
</p>
</div>
</form>
<?php require '../template/footer.php';?>