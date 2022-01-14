<?php

$path_index="../index.php";
$path_inscription="inscription.php";
$path_connexion="connexion.php";
$path_profil="profil.php";
$path_articles="articles.php?p=0";
$path_create="creer-article.php";
$path_admin="admin.php";
$path_deconnexion="deconnexion.php";
$path_article="article.php";


session_start();
session_destroy();
header('location: ../index.php');

require_once 'header.php';
?>