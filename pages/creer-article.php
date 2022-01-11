
<?php
require '../class/classArticles.php';
?>

<form method='post' >
<p>
<?php
    $creat_art= new Articles;
    $creat_art->createCat() ;
    $creat_art->createArticle();?> 
</p>

<input  type="text" name="categorie"  placeholder="créer une catégorie">
<input type='submit' name='verifier'value='verifier' />
</form>

<form method='get' >

<p>écrivez un article</p>

<select name='cat'>
    <?php
        $menu= new Articles;
        $menu->displayCat();
    ?>
</select> 

<p>
    Pseudo :<?php echo $_SESSION['user']['login']; ?><input name='pseudo' value='<?php echo $_SESSION['user']['id'] ?>' type='hidden' >  <br />
    article :<br />
    <textarea name='comment' rows='20' cols='60' style='resize:none'></textarea><br />
    <input type='submit' name='envoyer'value='envoyer' />
</p>

</form>