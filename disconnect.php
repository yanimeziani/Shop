<?php
session_start();
if (isset($_SESSION["email"])) {
    unset($_SESSION['email']);
    unset($_SESSION['address']);
    header("Location: index.php?message=Deconnexion réussie!");
    exit();
} else {
    header("Location: index.php");
    exit();
}
