<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1 class="navbar-brand">Bloustache</h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href='<?= $path_index ?>'>Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <?php if (isset($_SESSION['user'])) 
                    {
                        echo
                        "
                        <a class='nav-link' href='$path_profil'>Profil</a>
                        <a class='nav-link' href='$path_articles'>Articles</a>
                        <a class='nav-link' href='$path_deconnexion'>Deconnexion</a>
                        ";
                    }?>
            </li>
            <li class="nav-item">
            <?php if (empty($_SESSION['user'])) { ?>
        
                <li><a class='nav-link' href='<?= $path_inscription?>'>Inscription</a></li>
                <li><a class='nav-link' href='<?= $path_connexion?>'>Connexion</a></li>
        
            <?php } ?> 
            </li>
            <li class="nav-item">
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_droits'] == 42 || $_SESSION['user']['id_droits'] == 1337) { ?>
        
                <li><a class='nav-link' href='<?= $path_create?>'>Creation d'articles</a></li>
                <li><a class='nav-link' href='<?= $path_admin?>'>ADMIN</a></li>
        
            <?php } ?> 
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown link
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            </ul>
        </div>
        </nav>
    </header>
<body>
    
