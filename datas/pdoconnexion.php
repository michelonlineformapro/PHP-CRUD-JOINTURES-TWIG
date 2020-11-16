
<?php

//LISTE TOUS LES CDS
function readAll(){
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);
    foreach($dbh->query('SELECT * FROM cd INNER JOIN proprietaires ON cd.proprietaire_id = proprietaires.id_proprio INNER JOIN genre ON cd.genre_id = genre.id_genre INNER JOIN stock ON cd.stock_id = stock.id_stock') as $row) {

        ?>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Album</th>
                    <th>Auteur</th>
                    <th>Genre</th>
                    <th>Propriétaires</th>
                    <th>Email propriétaire</th>
                    <th>Téléphone propriétaire</th>
                    <th>En stock</th>
                    <th>Quantité(s)</th>
                    <th>Détails</th>
                    <th>Editer</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row"><?= $row['id'] ?></td>
                    <td scope="row"><?= $row['nom'] ?></td>
                    <td scope="row"><?= $row['auteur'] ?></td>
                    <td scope="row"><?= $row['genre'] ?></td>
                    <td scope="row"><?= $row['nom_proprio'] ?></td>
                    <td scope="row"><?= $row['email_proprio'] ?></td>
                    <td scope="row"><?= $row['telephone_proprio'] ?></td>
                    <td scope="row"><?= $row['disponible'] ?></td>
                    <td scope="row"><?= $row['quantite'] ?></td>
                    <td><a href="details.php?id=<?= $row['id'] ?>" class="btn btn-outline-warning">Détails</a></td>
                    <td><a href="updatecd.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary">Editer</a></td>
                    <td><a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger">Supprimer</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        <?php
    }
}

//DETAIL DU CD getByID
function getCdByID(){
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);
    $id = $_GET['id'];
    $req = $dbh->prepare('SELECT * FROM cd INNER JOIN proprietaires ON cd.proprietaire_id = proprietaires.id_proprio INNER JOIN genre ON cd.genre_id = genre.id_genre INNER JOIN stock ON cd.stock_id = stock.id_stock WHERE id = ?');
    $req->execute(array($id));
    $res = $req->fetch(PDO::FETCH_ASSOC);

    ?>
    <div class="container">
        <h1 class="text-danger">Détail du CD</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Album</th>
                <th>Auteur</th>
                <th>Genre</th>
                <th>Propriétaires</th>
                <th>Email propriétaire</th>
                <th>Téléphone propriétaire</th>
                <th>En stock</th>
                <th>Quantité(s)</th>
                <th>Détails</th>
                <th>Editer</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td scope="row"><?= $res['id'] ?></td>
                <td scope="row"><?= $res['nom'] ?></td>
                <td scope="row"><?= $res['auteur'] ?></td>
                <td scope="row"><?= $res['genre'] ?></td>
                <td scope="row"><?= $res['nom_proprio'] ?></td>
                <td scope="row"><?= $res['email_proprio'] ?></td>
                <td scope="row"><?= $res['telephone_proprio'] ?></td>
                <td scope="row"><?= $res['disponible'] ?></td>
                <td scope="row"><?= $res['quantite'] ?></td>
                <td><a href="index.php" class="btn btn-outline-success">Retour</a></td>
                <td><a href="updatecd.php?id=<?= $res['id'] ?>" class="btn btn-outline-primary">Editer</a></td>
                <td><a href="delete.php?id=<?= $res['id'] ?>" class="btn btn-outline-danger">Supprimer</a></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php
}

//AJOUTER UN CD
function addCd(){
    $user = "root";
    $pass = "";

    try{
        $dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);

        //Verif des valeurs du formulaire

        if(isset($_POST['nom'])){
            $nom = $_POST['nom'];
        }
        if(isset($_POST['auteur'])){
            $auteur = $_POST['auteur'];
        }
        if(isset($_POST['genre_id'])){
            $genre = $_POST['genre_id'];
        }
        if(isset($_POST['proprietaire_id'])){
            $proprio = $_POST['proprietaire_id'];
        }
        if(isset($_POST['stock_id'])){
            $stock = $_POST['stock_id'];
        }


        //Traitrement
        $sql = "INSERT INTO cd (nom, auteur, genre_id, proprietaire_id, stock_id) values(?,?,?,?,?)";
        $req = $dbh->prepare($sql);

        $req->bindParam(1, $nom);
        $req->bindParam(2, $auteur);
        $req->bindParam(3, $genre);
        $req->bindParam(4, $proprio);
        $req->bindParam(5, $stock);

        $req->execute([$nom, $auteur, $genre, $proprio, $stock]);
        var_dump($_POST['nom']);
        var_dump($_POST['auteur']);
        var_dump($_POST['genre_id']);
        var_dump($_POST['proprietaire_id']);
        var_dump($_POST['stock_id']);

        echo '<div class="container"><a href="index.php" class="btn btn-outline-success">Retour à la liste des cds</a></div>';
    }catch (PDOException $e){
        echo "Erreur de taritement du formulaire" .$e->getMessage();
    }
}

//METTRE A JOUR UN CD
function updateCd(){
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);

    $sql = "UPDATE cd SET nom= ?, auteur= ?, genre_id = ?, proprietaire_id = ?, stock_id = ? WHERE id=?";
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    //Verif des valeurs du formulaire

    if(isset($_POST['nom'])){
        $nom = $_POST['nom'];
    }
    if(isset($_POST['auteur'])){
        $auteur = $_POST['auteur'];
    }
    if(isset($_POST['genre_id'])){
        $genre = $_POST['genre_id'];
    }
    if(isset($_POST['proprietaire_id'])){
        $proprio = $_POST['proprietaire_id'];
    }
    if(isset($_POST['stock_id'])){
        $stock = $_POST['stock_id'];
    }

    $req = $dbh->prepare('SELECT * FROM cd WHERE id = ?');
    $req->fetch(PDO::FETCH_ASSOC);
    $update = $dbh->prepare($sql);
    $update->bindParam(1, $nom);
    $update->bindParam(2,$auteur);
    $update->bindParam(3,$genre);
    $update->bindParam(4,$proprio);
    $update->bindParam(5,$stock);
    $update->execute(array($nom, $auteur,$genre, $proprio, $stock, $id));
    if($update){
        var_dump($_POST['nom']);
        var_dump($_POST['auteur']);
        var_dump($_POST['genre_id']);
        var_dump($_POST['proprietaire_id']);
        var_dump($_POST['stock_id']);
    }else{
        echo "ERREUR";
    }
}

//SUPPRIMER UN CD
function deleteCd(){
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=multi', $user, $pass);
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $sql = "DELETE FROM cd WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute(array($id));
    echo '<div class="text-center"><a class="btn btn-outline-success" href="index.php">Element supprimer</a></div>';
}



