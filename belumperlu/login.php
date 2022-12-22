<?php
session_start();
require 'functions.php';

if(isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
  $id = $_COOKIE["id"];
  $key = $_COOKIE["key"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  if($key === hash('sha224', $row["nip"])) {
    $_SESSION["login"] = true;
  }
}

if(isset($_SESSION["login"])) {
  header("Location: suratkeluar/index.php");
  exit;
}

if(isset($_POST["login"])) {
  $nip = $_POST["nip"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE nip = '$nip'");
  if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row["password"])) {
      $_SESSION["login"] = true;

      if(isset($_POST["rememberme"])) {
        setcookie("id", $row["id"], time()+60);
        setcookie("key", hash("sha224", $row["nip"]), time()+60);
      }
      
      $_SESSION["nip"] = $nip;
      header("Location: suratkeluar/index.php");
      exit;
    }
  }
  $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
<div class="login-box">
  <h1>Login</h1>
  <?php if(isset($error)) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      NIP / Password tidak sesuai
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  <form action="" method="post" autocomplete="off">
    <div class="textbox">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
      </svg>
      <input type="text" name="nip" placeholder="xxx">
    </div>
    <div class="textbox">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
      </svg>
      <input type="password" name="password" placeholder="xxx">
    </div>
    <div class="rememberbox">
      <input type="checkbox" name="rememberme">
      <label for="rememberme">Remember Me</label>
    </div>
    <div class="d-grid gap-2 mb-3">
      <button type="submit" name="login" class="btn">Login</button>
    </div>
  </form>
</div>

</body>
</html>