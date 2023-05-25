<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=banque;charset=utf8';
$pdo = new PDO($dsn, 'root', '');

// Temps de la redirection en secondes
$temps = 10;
// URL de la page de destination
$url = "comptes.php";
// Redirection
header("Refresh:$temps; url=$url");


if (isset($_POST['montant'])) {
    $montant = $_POST['montant'];
    // Ajouter le montant au solde existant dans la base de données
    $sql = "UPDATE comptebancaire SET solde = solde + :montant WHERE identifiant = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['montant' => $montant]);
}

// Récupérer le nouveau solde dans la base de données
$sql = "SELECT solde FROM comptebancaire WHERE identifiant = 1";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$solde = $row['solde'];

$pdo = null;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Ajout effectué</title>
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
        <h1>Ajout effectué !</h1>
        </br>
        <!--     <p>Le montant de <?php //echo $montant; ?> € a été ajouté au solde.</p> -->
        <p>Votre solde est maintenant de
            <?php echo $solde; ?> €.
        </p>
        </br>
        <a href="comptes.php" class="button">Retour aux comptes</a>
    </div>

    <?php
    // attendre 3 secondes avant de rediriger l'utilisateur vers la page précédente
    echo '<script type="text/javascript">
    setTimeout(function(){
        window.history.back();
    }, 3000);
</script>';
    ?>

</body>

</html>