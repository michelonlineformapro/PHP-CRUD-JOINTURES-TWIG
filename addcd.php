<?php
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
        'body' => $dbh = addCd()
    ));
    ?>
    <div class="container">
        <h1 class="text-success">Ajouter un CD</h1>
        <form method="post" action="addcd.php">

            <div class="form-group">
                <label for="nom">Titre de l'album</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Arise">
            </div>

            <div class="form-group">
                <label for="auteur">Artiste de l'album</label>
                <input type="text" name="auteur" id="auteur" class="form-control" placeholder="Sepultura">
            </div>

            <div class="form-group">
                <label for="genre_id">Genre de musique</label>
                <select class="form-control" id="genre_id" name="genre_id">
                    <?php
                    $user = "root";
                    $pass = "";
                    $dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);
                    foreach ($dbh->query("SELECT * FROM genre") as $row){
                        ?>
                        <option value="<?= $row['id_genre'] ?>"><?= $row['genre'] ?></option>
                        <?php
                    }

                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="proprietaire_id">Propriétaire du CD</label>
                <select class="form-control" id="proprietaire_id" name="proprietaire_id">
                    <?php
                    $user = "root";
                    $pass = "";
                    $dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);
                    foreach ($dbh->query("SELECT * FROM proprietaires") as $row){
                        ?>
                        <option value="<?= $row['id_proprio'] ?>"><?= $row['nom_proprio'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="stock_id">En stock</label>
                <select class="form-control" id="stock_id" name="stock_id">
                    <?php
                    $user = "root";
                    $pass = "";
                    $dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);
                    foreach ($dbh->query("SELECT * FROM stock") as $row){
                        ?>
                        <option value="<?= $row['id_stock'] ?>"><?= $row['disponible'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <hr>
            <button type="submit" class="btn btn-outline-dark">Ajouter le CD</button>
            <hr>
        </form>
    </div>
<?php

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}