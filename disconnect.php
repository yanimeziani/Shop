<?php
session_start();
if (isset($_SESSION["email"])) {
    session_destroy();
    header("Location: index.php?message=Déconnection réussie.");
} else {
    header("Location: index.php");
}
