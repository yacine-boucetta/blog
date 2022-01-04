<?php

require '../class/classUser.php';
if(isset($_POST['sign_in'])){
    $connect= new User();
    $connect->user_connexion($_POST['login'],$_POST['password']);
    }

?>

<?php require '../template/header.php';?>
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
        <button name='sign_in' class="btn btn-success from-group" type="submit" name="sign_in" value="sign_in">Valider</button>
</div>

    </form>
</div>

<?php require '../template/footer.php';?>