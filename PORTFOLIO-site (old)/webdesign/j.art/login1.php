<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
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
  <body>
    <h1>j.art</h1>

<!-- navigation bar-->
    <div class="navigation">
      <a href="home.html">home.</a>
      <a href="contact.html">contact.</a>
      <a href="account.php">account.</a>
    </div>

    <form action="includes/login.inc.php" method="post">
      <ul>
        <li><p>login.<p></li>
        <li>
          <label>username or e-mail.</label><br>
          <input type="text" name="uid">
        </li>
        <li>
          <label>password.</label><br>
          <input type="password" name="pwd">
        </li>
        <li class="button">
          <button type="submit" name="submit">login.</button>
        </li>
      </ul>

      <p>
      <?php
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "emptyinput") {
            echo "fill in all fields!";
          }
          else if ($_GET["error"] == "wronglogin") {
            echo "incorrect login!";
          }
        }
      ?>
      <p>
    </form>
