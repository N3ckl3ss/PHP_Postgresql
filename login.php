<?php include('server.php');

if (isset($_SESSION['username'])) {
  $_SESSION['msg'] = "Already loged in";
  header('location: index.php');
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Login</title>
</head>

<body>
  <style>
    *,
    html {
      margin: 0;
      padding: 0;
    }

    html {
      position: absolute;
      z-index: 1;
      height: 100%;
      width: 100%;
      overflow: hidden;
    }

    html::before {
      content: '';
      display: block;
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: #fff url('backg.jpeg') center center fixed no-repeat;
      background-size: cover;
      -webkit-filter: blur(3px);
      filter: blur(3px);
      -webkit-transform: scale(1.3);
      transform: scale(1.3);
    }

    button {
      background-color: rgb(247, 170, 55);
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
    }

    .log {
      background-color: rgba(20, 1, 1, 0.863);
      color: rgb(255, 255, 255);
      font-weight: bold;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 30%;
      padding: 20px;
      text-align: center;
    }

    .log button {
      background-color: rgb(247, 170, 55);
      border: none;
      color: white;
      width: 180px;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
    }

    input {

      width: 90%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
  </style>
  <div class='log'>
    <h1>Login</h1>
    <br>
    <div class="container text-center">
      <div>
        <?php foreach ($errors as $error) : ?>
          <?= $error ?> <br>
        <?php endforeach ?>
      </div>
      <form method="post" action="login.php">

        <div class="form-group">
          <input type="text" class="form-control" id="username" aria-describedby="username" placeholder="User name" name="username">
          <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="password" placeholder="password" name="password">
        </div>
        <br />
        <button type="submit" class="btn btn-primary" name="login_user">login</button>
        <button formaction="registration.php">Create account</button>
      </form>
    </div>
  </div>
</body>

</html>