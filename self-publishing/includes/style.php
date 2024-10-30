<?php
ob_start();
session_start();


if (isset($_SERVER['HTTPS'])) {
  $requesMet = "https";
} else {
  $requesMet = "http";
}
?>

<base href="<?= $requesMet . '://' . $_SERVER['HTTP_HOST'] . '/' ?>">
<link rel="stylesheet" href="self-publishing/assets/css/layout.css">
<link rel="stylesheet" href="self-publishing/assets/css/style.css">

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<?php
  include_once("includes/token.php");
  

$url = $_SERVER['REQUEST_URI'];
  ?>
