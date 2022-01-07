
<?php

require '../class/classArticles.php';
$creat_art= new Articles;
    $creat_art->createCat() ;
    $creat_art->createArticle(); ?>

<form method='post' >
<h1> <?php echo $error; 
var_dump($error);?> </h1>
<input  type="text" name="categorie"  placeholder="créer une catégorie">
<input type='submit' name='verifier'value='verifier' />
</form>

<form method='post' >

<p>écrivez un article</p>

<select>
    <?php
        $menu= new Articles;
        $menu->displayCat();
    ?>
</select> 

<p>
    Pseudo :<?php echo $_SESSION['user']['login']; ?><input name='pseudo' value='<?php echo $_SESSION['user']['id'] ?>' type='hidden' >  <br />
    article :<br />
    <textarea name='comment' rows='8' cols='35' style='resize:none'></textarea><br />
    <input type='submit' name='envoyer'value='Envoyer' />
</p>

</form>