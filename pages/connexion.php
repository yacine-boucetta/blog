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

if(isset($_POST['sign_in'])){
    $connect= new User();
    $connect->user_connexion($_POST['login'],$_POST['password']);
    }

?>

<?php require '../template/header.php';?>
<main class="container">

<div class="testbox">
    <form class="sign" method='post'>
    <div class="banner">
        <h2>Sign in</h2>
</div>

        <div class="item">
        <input  type="text" name="login" required="" placeholder="Username">
        </div>

        <div class="item">
        <input  type="password" name="password" required="" placeholder="password">
</div>

<div class="btn-block">
        <button name='sign_in'type="submit" href="/">sign in</button>
    </div>
    </form>
</div>
</main>
<?php require '../template/footer.php';?>