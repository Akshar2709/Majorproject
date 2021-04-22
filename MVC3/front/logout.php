<?php include "../includes/db.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php $_SESSION['id']=null;
session_destroy();
 header("Location:login.php");

?>

