
<?php
session_start();
session_destroy();
header('Location: pagedeconnexion.php');
exit;


