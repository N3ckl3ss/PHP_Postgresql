<?php include('server.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Registration</title>
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
    <h1>Registration</h1>
    <br>

    <div>
        <?php foreach ($errors as $error) : ?>
          <?= $error ?> <br>
        <?php endforeach ?>
      </div>

    <form method="post" action="registration.php">
      <div class="form-group">
        <input type="text" class="form-control" id="username" aria-describedby="username" placeholder="Username" name="username" value="<?php echo $username; ?>">
      </div>
      <div class="form-group">
        <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Email" name="email" value="<?php echo $email; ?>">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password_1" placeholder="password" name="password_1">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password_2" placeholder="password again" name="password_2">
      </div>
      <button type="submit" class="btn btn-primary" name="reg_user">Registrate</button>
    </form>
  </div>
</body>

</html>