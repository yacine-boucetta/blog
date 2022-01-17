<?php

$path_index="../index.php";
$path_inscription="inscription.php";
$path_connexion="connexion.php";
$path_profil="profil.php";
$path_articles="articles.php?p=0";
$path_create="creer-article.php";
$path_admin="admin.php";
$path_deconnexion="deconnexion.php";

require_once '../class/classUser.php';

if(isset($_POST['sign_up'])){
$inscription= new User();
$inscription->user_inscription($_POST['login'],$_POST['password'],$_POST['password2'],$_POST['email']);
}
?>



<?php require '../template/header.php';?>
<main class="container">
<div class="testbox">
    <form class="sign" method="post" >
    <h2>Inscription</h2>
    
    <div class="item">
        <label for="name">Login<span>*</span></label>
        <input id="name" type="text" name="login" required/>
    </div>
    
    <div class="item">
        <label for="password">Password:6 caractère minimum<span>*</span></label>
        <input id="password" type="password" name="password" required/>
    </div>

    <div class="item">
        <label for="name">Confirmation password<span>*</span></label>
        <input id="name" type="password" name="password2" required/> 
    </div> 

    <div class="item">
    <label for="name">email<span>*</span></label>
        <input  type="email" name="email" required="" placeholder="email">
    </div>

    <div class="btn-block">
        <button name='sign_up'type="submit" href="/">sign up</button>
    </div>

</div>
</form>
</div>
</main>
<?php require '../template/footer.php';?>

