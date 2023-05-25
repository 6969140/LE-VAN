<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=banque;charset=utf8';
$pdo = new PDO($dsn, 'root', '');

//ajout
if (isset($_POST["montant"])) {
    // Récupérer le montant entré
    $montant = $_POST["montant"];

    // Mettre à jour le solde dans la base de données en ajoutant le montant entré
    $sql = "UPDATE comptebancaire SET solde = solde + :montant WHERE identifiant = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':montant', $montant);
    $stmt->execute();

    // Rediriger l'utilisateur vers une autre page pour afficher le nouveau solde
    header("Location: nouvelle_page.php");
    exit();
}

// retrait
if (isset($_POST["retrait"])) {
    // Récupérer le montant entré
    $retrait = $_POST["retrait"];

    // Vérifier si le solde est suffisant pour effectuer le retrait
    $sql = "SELECT solde FROM comptebancaire WHERE identifiant = 1";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $solde = $row['solde'];
    //retrait impossible
    if ($retrait > $solde) {
        echo "Solde insuffisant pour effectuer le retrait.";
        exit;
    }
    // Mettre à jour le solde dans la base de données en soustrayant le montant
    $sql = "UPDATE comptebancaire SET solde = solde - :retrait WHERE identifiant = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['retrait' => $retrait]);

    // Rediriger l'utilisateur vers une autre page pour afficher le résultat
    header("Location: nvl_pageretrait.php?retrait=$retrait");
    exit;
}


?>

<!DOCTYPE html>
<html lang='fr'>

<head>
    <meta charset="utf-8" />
    <title>Comptes</title>
    <link rel="stylesheet" href="comptes.css">
</head>

<header>
    <a href="index.php" class="button">Retour aux comptes</a>
</header>

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

        .button:hover {
            background-color: #002ead;
            transition: 0.4s;
        }

        input[type="number"] {
            width: 70px;
            height: 30px;
            padding: 3px;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4261a9;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            margin-top: 10px;
            border-radius: 3px;
            margin-top: 10px;
            margin-bottom: 25px;
        }

        hr {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    </br>
    <h1>Compte courant</h1>
    </br>

    <div class="container">
        <?php
        //afficher le solde
        $sql = "SELECT solde FROM comptebancaire WHERE identifiant = 1";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $solde = $row['solde'];


        $pdo = null;
        ?>
        <ul>
            <li><b>Solde :</b>
                <?php echo $solde; ?>
                <b> €</b>
            </li><br>
            <li><b>Découvert autorisé :</b> 500 €</li><br>
        </ul>
        </br>
        <hr />
        </br>
        <h2>Ajouter</h2>
        <form action="comptes.php" method="post">
            <label for="montant">Montant :</label>
            <input type="number" name="montant" id="montant" required>

            <button class="button" type="submit">Ajouter</button>
        </form>
        </br></br>
        <hr />

        <h2>Retirer</h2>
        <form action="comptes.php" method="post">
            <label for="montant">Montant :</label>
            <input type="number" name="retrait" id="montant" required>

            <button class="button" type="submit">Retirer</button>
        </form>

    </div>

</body>
<footer>
</footer>

</html>
<?php
exit();
?>