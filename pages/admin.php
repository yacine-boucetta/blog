<?php

require '../template/header.php';
require '../class/classAdmin.php';

$path_index="../index.php";
$path_inscription="inscription.php";
$path_connexion="connexion.php";
$path_profil="profil.php";
$path_articles="articles.php";
$path_create="creer-article.php";
$path_admin="admin.php";
$path_deconnexion="deconnexion.php";

// $oldlogin = $_POST['moddingUser'];
// $newDroit = $_POST['droitUser'];

//var_dump($newDroit);

if(isset($_POST['sign_up'])){
    $registerNewUser = new Admin();
    $registerNewUser->registerNewUser($_POST['login'],$_POST['password'],$_POST['email'], $_POST['droits']);
}
if(isset($_POST['mod'])){
    $modUser = new Admin();
    $modUser -> UpdateNewUser($_POST['moddingUser'],$_POST['UpdateLog'],$_POST['UpdateMail'],$_POST['updatePW'], $_POST['updateCPW'], $_POST['droitUser']);
}
if(isset($_POST['deleteUser'])){
    $deleteUser = new Admin();
    $deleteUser -> deleteUser($_POST['moddingUser']);
}


//var_dump($oldlogin);
?>
<main>
    <article>
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
                <div class="item">
                    <label for="name">Droits<span>*</span></label>
                        <select name="moddingUser">
                            <?php
                                $article = new Admin();
                                $article->displayChoice();
                            ?>
                        </select>
                </div>
                <div class="btn-block">
                    <button name='sign_up'type="submit" href="/">sign up</button>
                </div>
                </div>
            </form>
        </div>
    </article>
    <article>
        <h2>Modification de User</h2>
                            <form id="add_user" action="" method="POST">
                                <select name="moddingUser">
                                    <?php
                                    $article = new Admin();
                                    $article->getDisplay();
                                    ?>
                                </select>

                                <label for="UpdateLog">Login</label>
                                <input type="text" name="UpdateLog">

                                <label for="UpdateMail">E-Mail:</label>
                                <input type="eMail" name="UpdateMail">

                                <label for="updatePW">Nouveau mot de passe:</label>
                                <input type="password" name="updatePW">

                                <label for="updateCPW">Confirmez le mot de passe: </label>
                                <input type="password" name="updateCPW">
                                <label>Select Droits</label>
                                <select name="droitUser">
                                    <?php
                                    $droits = new Admin();
                                    $droits->displayChoice();
                                    ?>
                                </select>

                                <input type="submit" name="mod" value="Envoyer">
                                <input type="submit" name="deleteUser" value="Supprimer">
                            </form>
    </article>
</main>

<?php

require '../template/footer.php';

?>