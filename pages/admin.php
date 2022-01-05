<?php

require '../template/header.php';
require '../class/classAdmin.php';

if(isset($_POST['sign_up'])){
$registerNewUser = new Admin();
$registerNewUser->registerNewUser($_POST['login'],$_POST['password'],$_POST['password2'],$_POST['email']);
}
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
                    <select id="droits">
                        <option value='1'>Utilisateur</option>
                        <option value='42'>Moderateur</option>
                        <option value='1337'>Admin</option>
                        <option></option>
                    </select>
                </div>
                <div class="btn-block">
                    <button name='sign_up'type="submit" href="/">sign up</button>
                </div>
                </div>
            </form>
        </div>
    </article>
</main>

<?php

require '../template/footer.php';

?>