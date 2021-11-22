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

<!--login form-->
    <form action="login1.php" method="post">
      <ul>
        <li><h2>already have an account?<h2></li>
        <li class="button1">
          <button type="submit" name="login">login.</button>
        </li>
      </ul>
    </form>

<!--create account form -->
    <form action="signup.php" method="post">
      <ul>
        <li><h2>new to j.art?</h2></li>
        <li class="button1">
          <button type="submit" name="create">create account.</button>
        </li>
      </ul>
    </form>

  </body>
</html>
