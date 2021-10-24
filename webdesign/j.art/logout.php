<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <head>
  <!-- head formatting -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- link to style sheet -->
      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- link to favicon -->
      <link rel="icon" href="favicon.ico">
      <title>j.art</title>
    </head>
  </head>
  <body>
    <h1>j.art</h1>

<!-- navigation bar-->
    <div class="navigation">
      <a href="home.html">home.</a>
      <a href="contact.html">contact.</a>
      <a href="account.php">account.</a>
    </div>

    <div class="echo">
      <?php
         $_SESSION["loggedin"] = false;
         session_start();
         session_unset();
         session_destroy();

         header("location: ../account.php");
         exit();
      ?>
    </div>

  </body>
</html>
