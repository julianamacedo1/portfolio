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

    <form action="includes/signup.inc.php" method="post">
      <ul>
        <li><p>sign-up.<p></li>
        <li>
          <label>full name.</label><br>
          <input type="text" name="name">
        </li>
        <li>
          <label>e-mail.</label><br>
          <input type="text" name="email">
        </li>
        <li>
          <label>username.</label><br>
          <input type="text" name="uid">
        </li>
        <li>
          <label>password.</label><br>
          <input type="password" name="pwd">
        </li>
        <li>
          <label>repeat password.</label><br>
          <input type="password" name="pwdrepeat">
        </li>
        <li>
          <button type="submit" name="submit">sign up</button>
        </li>
      </ul>

      <p>
        <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
              echo "fill in all fields!";
            }
            else if ($_GET["error"] == "invaliduid") {
              echo "invalid username!";
            }
            else if ($_GET["error"] == "invalidemail") {
              echo "invalid e-mail!";
            }
            else if ($_GET["error"] == "nomatch") {
              echo "passwords don't match!";
            }
            else if ($_GET["error"] == "stmtfailed") {
              echo "something went wrong, try again!";
            }
            else if ($_GET["error"] == "usernametaken") {
              echo "username already taken!";
            }
            else if ($_GET["error"] == "none") {
              echo "you have signed up!";
            }
          }
        ?>
      </p>
    </form>
