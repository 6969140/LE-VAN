<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=banque;charset=utf8';

try {
    $bdd = new PDO($dsn, 'root', '');

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $bdd->prepare("SELECT * FROM client
WHERE mail = :varMail AND motdepasse = :varMdp");
    $statement->execute(
        [
            'varMail' => $_POST['mail'],
            'varMdp' => $_POST['motdepasse'],
        ]
    );
    $user = $statement->fetch();
    if ($user) {
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['identifiant'] = $user['identifiant'];
        header('location: index.php');
    } else {
        header('Location: pagedeconnexion.php');
    }
} catch (PDOException $Exception) {
    echo $Exception->getMessage() . 'code erreur : ' . $Exception->getCode();
    die();
}
?>