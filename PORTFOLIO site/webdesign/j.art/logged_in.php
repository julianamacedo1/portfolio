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
      <a href="logged_in.php">account.</a>
    </div>

        <p><?php
          if(isset($_SESSION["useruid"])){
            echo "<br>" . "<br>" . "hello " . $_SESSION["useruid"] . ",";
            $_SESSION["loggedin"] = true;
          } else{
            echo "hello guest!";
          }
        ?></p>

    <br><h2>as a member of the j.art family, you get exclusive access to the digitally created alpaca collection.</h2>

    <div class="container">
      <img src="img/alpacaflower.jpg" alt="alpaca" class="image">
      <div class="overlay">
        <div class="text">peace, love, alpaca.</div>
      </div>
    </div>

    <div class="container">
      <img src="img/alpacapizza.jpg" alt="alpaca" class="image">
      <div class="overlay">
        <div class="text">dinner is served.</div>
      </div>
    </div>

      <h2>which alpaca would be your spirit alpaca?</h2>
      <?php
        $randomChoice = function($array) {return $array[array_rand($array)];};
        $alpacas = ['hippie alpaca.', 'pizza eating alpaca.', 'pilot alpaca.', 'intellectual alpaca.', 'hacker alpaca.', 'ucf alpaca.',
        'cake loving alpaca.', 'dancing alpaca.'];
      ?>
      <p><?php echo $randomChoice($alpacas);?></p><br>

      <br><h2>countdown to a new alpaca:</h2>
      <p><?php
        $date = strtotime("December 25, 2020 12:00 AM");
        $remaining = $date - time();

        $days_remaining = floor($remaining / 86400);
        $hours_remaining = floor(($remaining % 86400) / 3600);
        echo "$days_remaining days and $hours_remaining hours.";
      ?></p>

      <br><h2>stay tuned.</h2>

      <p><?php echo "<br>", '<a href="logout.php">logout.</a>', "<br>";?></p><br>

  </body>
</html>
