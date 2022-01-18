<article>
    <form method="post" class='testbox'>
    <select name='cat'>
        <?php
            $menu= new Articles;
            $menu->displayCat();
        ?>
    </select> 
        <textarea name='updateArt' rows='10' cols='60' style='resize:none' placeholder="Modification d'article"></textarea><br/>
        <div class='btn-block'>
        <button type='submit' name="updateArticle" value='Update'>Update</input>
        </div>
        <div class='btn-block'>
        <button type='submit' name="delete" >Effacer</input>
    </div>
    </form>
</article>