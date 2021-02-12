<?php
$con = new mysqli("localhost", "root", "", "showRoom");
if (!$con) {
    die("connexion a échoué: " . $con->connect_error);
}
?>
