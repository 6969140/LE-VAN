<?php
session_start();

$_SESSION['mail'] = 'aylin@aylin.com';
$_SESSION['password'] = 'aylin';

if (isset($_SESSION['user']))
    echo 'OK';
else
    echo 'NOT OK';

    if (isset($_SESSION['password'])){
        if($_SESSION['password']=='aylin'){
            echo 'MOT DE PASSE OK';
    }else{
        echo 'PAS BON';
    }
}else{
    echo 'AUCUN MOT DE PASSE ENTRE';
}

unset($_SESSION['user']);
echo isset($_SESSION['user']) ? 'OK' : 'PAS OK';

?>

<!DOCTYPE html>
<html lang='fr'>

<head>
    <meta charset="utf-8" />
    <title>Projet</title>
    <link rel="stylesheet" href="comptes.css">
</head>

<body>
    <h1>Compte courant</h1>

    <div class="container">
        <form>
            <ul>
                <li><b>Solde :</b> 950 €</li><br>
                <li><b>Découvert autorisé :</b> 500 €</li><br>
            </ul>

            <h2>Ajouter</h2>
            <input placeholder="Saisir montant">
            <input type="submit" value="Ajouter">

            <h2>Retirer</h2>
            <input placeholder="Saisir montant">
            <input type="submit" value="Valider">
        </form>
    </div>


</body>

</html>