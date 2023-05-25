<!DOCTYPE html>
<html>

<head>
  <title>Page de connexion</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="pagedeconnexion.css">
</head>

<header>
  </br>
  <div class="marg">
    <p>Pas encore inscrit ?</p>
    <a href="inscription.php" class="button">S'inscrire</a>
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
    [type="password"] {
      padding: 10px;
      width: 250px;
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
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 3px;
    }

    .marg {
      margin-left: 20px;
    }
  </style>
  <div class="oui">
    <h1>Se connecter</h1>

    <div class="container">
      <form method="post" action="connexionverif.php">
        <label for="mail">Adresse e-mail :</label>
        <input type="email" id="mail" name="mail" required></br>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse" required>

        <input type="submit" value="Se connecter">
    </div>

    </form>
  </div>
</body>
<?php /* echo htmlspecialchars($_SERVER["PHP_SELF"]); */?>

</html>