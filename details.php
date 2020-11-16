<?php

// menu.php
// inclure  l'autoloader
include 'vendor/autoload.php';
require 'datas/pdoconnexion.php';
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);

try {
    // le dossier ou on trouve les templates
    $loader = new Twig\Loader\FilesystemLoader('views');

    // initialiser l'environement Twig
    $twig = new Twig\Environment($loader);

    $template = $twig->load('base.html.twig');
    echo $template->render(array(
        'menu' => require "views/menu.html.twig",
        'body' => $dbh = getCdByID()
    ));

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}