<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=banque;charset=utf8';
$pdo = new PDO($dsn, 'root', '');

/* if (isset($_GET['retrait'])) {
    $retrait = $_GET['retrait'];

    // Afficher le montant retiré
    echo "Le montant de $retrait € a été retiré avec succès.";
} else {
    echo "Aucun montant n'a été spécifié pour le retrait.";
}

// Récupérer le solde mis à jour depuis la base de données
$sql = "SELECT solde FROM comptebancaire WHERE identifiant = 1";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$solde = $row['solde']; 
$pdo = null;*/


if (isset($_SESSION['retrait'])) {
    $retrait = $_SESSION['retrait'];

    // Afficher le montant retiré
    echo "Le montant de $retrait € a été retiré avec succès.";
}

// Récupérer le solde mis à jour depuis la base de données
$sql = "SELECT solde FROM comptebancaire WHERE identifiant = 1";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$solde = $row['solde'];

// Stocker le solde dans une variable de session
$_SESSION['solde'] = $solde;

$pdo = null;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Retrait effectué</title>
</head>

<body>
    <style>
        .button {
            background-color: #4261a9;
            border: none;
            color: white;
            padding: 11px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 17px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 3px;
            margin-top: 20px;
        }

        .align {
            text-align: center;
        }
    </style>
    <div class="align">
        <h1>Retrait effectué !</h1>
        <!--     <p>Le montant de <?php //echo $retrait; ?> € a été retiré du solde.</p> -->
        </br>
        <p>Votre solde est maintenant de
            <?php echo $solde; ?> €.
        </p>
        </br>
        <a href="index.php" class="button">Retour aux comptes</a>
    </div>

</body>

</html>