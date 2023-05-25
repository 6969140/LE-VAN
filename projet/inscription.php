<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
</head>
<header>
    </br>
    <div class="marg">
        <p>Déja inscrit ?</p>
        <a href="pagedeconnexion.php" class="button">Se connecter</a>
    </div>
</header>

<body>

    <style>
        input[type="submit"] {
            background-color: #4261a9;
            color: white;
            border: none;
            cursor: pointer;
            padding: 14px;
            margin-top: 18px;
            border-radius: 3px;
        }

        input[type="submit"]:hover {
            background-color: #3b589c;
        }

        input[type="email"],
        [type="password"],
        [type="text"],
        [type="text"] {
            padding: 10px;
            width: 250px;
        }


        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        h2 {
            text-align: center;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        label {
            margin-bottom: 10px;
        }

        .button {
            background-color: #4261a9;
            border: none;
            color: white;
            padding: 11px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 17px;
            cursor: pointer;
            border-radius: 3px;
        }

        .marg {
            margin-left: 20px;
        }
    </style>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $mail = $_POST["mail"];
        $motdepasse = $_POST["motdepasse"];

        session_start();
        $dsn = 'mysql:host=localhost;dbname=banque;charset=utf8';

        $requete = "INSERT INTO client (nom, prenom, mail, motdepasse) VALUES ('$nom','$prenom','$mail', '$motdepasse')";

        // Exécution
        if ($requete === TRUE) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur lors de l'inscription: ";
        }

    }
    ?>

    <h1>Inscription</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label for="prenom">Prenom :</label>
        <input type="text" name="prenom" id="prenom" required><br>

        <label for="email">Email :</label>
        <input type="email" name="mail" id="mail" required><br>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" name="motdepasse" id="motdepasse" required><br>

        <input type="submit" value="S'inscrire">
    </form>

</body>

</html>