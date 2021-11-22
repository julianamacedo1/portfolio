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

  <?php
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
  ?>
  <h2>
    <?php echo "<br>", "so...", "<br>", "<br>", "your name is ", "<br>"; ?>
    <?php echo $name, "<br>"; ?>
    <?php echo "<br>", "your email is ", "<br>"; ?>
    <?php echo $email, "<br>"; ?>
    <?php echo "<br>", "and the message you sent us says... ", "<br>"; ?>
    <?php echo $message, "<br>"; ?>
    <?php echo "<br>", "<br>", "got it!", "<br>"; ?>
  </h2>

  </body>
</html>
