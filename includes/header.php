<?php
  require "includes/db.php";
  require "includes/auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Bungee|Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <title><?=$tittle?></title>
</head>
<body>
  <header>
    <img src="img/mango.png" id="imgLogo">
    <a href="/" id="titleLogo"><?=$tittle?></a>
    <nav>
      <div>
        <?php if( isset($_SESSION['logged_user']) ) : ?>
          <?php if('/index.php' == $_SERVER['REQUEST_URI'] || '/' == $_SERVER['REQUEST_URI']) : ?>
              <p id="welcomeText">Hello, <?php echo $_SESSION['logged_user']->login; ?>!</p>
              <a href="addnote.php">Add note</a>
            <?php else : ?>
              <a href="/">Home</a>
            <?php endif; ?>
          <a href="logout.php">Logout</a>
        <?php else : ?>
        <a onclick="show('block', 'registerForm', 'darkBackgroundRegister')">Register</a>
        <a onclick="show('block', 'loginForm', 'darkBackgroundLogin')">Login</a>
      <?php endif; ?>
      </div>
    </nav>
  </header>
