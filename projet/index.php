<?php
session_start();
if (!isset($_SESSION['mail']) || !isset($_SESSION['prenom'])) {
  header("Location: pagedeconnexion.php");
}

$dsn = 'mysql:host=localhost;dbname=banque;charset=utf8';
$pdo = new PDO($dsn, 'root', '');


/* 
foreach ($resultat as $key => $variable)
{
if ($resultat[$key]['mail'] == $_POST["mail"]){
    if ($resultat[$key]['motdepasse'] == $_POST["motdepasse"]){
        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['motdepasse'] = $_POST['motdepasse'];

        header('location: touslescomptes.php');
        exit;
    }
}
} */
if (isset($_SESSION['compte'])) {
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $statement = $pdo->prepare("SELECT * FROM comptebancaire WHERE identifiantclient = :varIdentifiant");
  $statement->execute(
    [
      'varIdentifiant' => $_SESSION['identifiant'],
    ]
  );
  $comptes = $statement->fetch();
  if ($comptes) {
    $_SESSION['compte'] = array();
    $_SESSION['compte']['identifiant'] = array();
    $_SESSION['compte']['identifiant'] = $comptes['identifiant'];
    $_SESSION['compte']['solde'] = array();
    $_SESSION['compte']['solde'] = $comptes['solde'];
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Compte Personnel de Banque</title>
  <style>
    .account-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100px;
      margin-top: 100px;
      margin-bottom: 200px;
    }

    .account-name {
      font-size: 1.5em;
      margin-top: 20px;
    }

    .account-balance {
      font-size: 1.5em;
      margin-top: 20px;
    }

    a {
      color: black;
      text-decoration: none;
    }

    h1 {
      text-align: center;
    }

    h2 {
      text-align: center;
    }

    .button {
      background-color: #4CAF50;
      border: none;
      color: white;
      text-shadow: black 0.1em 0.1em 0.2em;
      padding: 20px;
      text-decoration: none;
      font-size: 20px;
      margin: 4px 2px;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: #4261a9;
      padding: 20px;
      border-radius: 10px;
      transition-duration: 0.4s;
    }

    .button:hover {
      box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 14px 18px 0 rgba(0, 0, 0, 0.19);
    }

    .buttondeco {
      background-color: rgb(255, 74, 74);
      border: none;
      color: white;
      padding: 12px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 17px;
      margin-left: 88%;
      margin-top: 20px;
      cursor: pointer;
      border-radius: 3px;
    }
  </style>

</head>

<header>
  <a href="logout.php" class="buttondeco">Déconnexion</a>

</header>

<body>

  <h1>
    <?php echo 'Bienvenue ' . $_SESSION['prenom'] . ' !'; ?>
  </h1> </br>

  </br>
  <h2>Mes comptes</h2>
  <div class="account-container">
    <a href="comptes.php" class="button">
      <div class="account-name"><b>Compte courant</b></div><br>
      <div class="account-name">SARICAM Aylin</div>
      <div class="account-balance">Solde : 200 €</div>
    </a>
  </div>

  <div class="account-container">
    <a href="compteepargne.php" class="button">
      <div class="account-name"><b>Compte épargne</b></div><br>
      <div class="account-name">SARICAM Aylin</div>
      <div class="account-balance">Solde : 2 000 €</div>
    </a>
  </div>

</body>

</html>