<?php
error_reporting(E_ALL);
$db = pg_connect("host=localhost port=5432 dbname=gp6khz user=gp6khz password=gp6khz") or die('Cannot log in');
include("query.php");
$newObj = new UserList();
$ulists = $newObj->getUserList();
$username = $_SESSION['username'];


$id = $_SESSION['id'];
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You need to log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport1' content='width=device-width, initial-scale=1.0'>
    <title>My list</title>
</head>

<body>
    <style>
        *,
        html {
            margin: 0;
            padding: 0;
        }

        .banner {
            background-image: url('backg.jpeg');
            color: aliceblue;
            background-position: 100%;
            width: 100%;
            height: 300px;
            background-position-y: 80%;
            background-position-x: center;
            margin-left: 0%;
            background-attachment: fixed;
            background-repeat: no-repeat;
            align-items: center;


        }

        .banner h1 {
            align-self: start;
            color: white;
            text-align: center;
            padding-bottom: 5%;
            font-size: 100px;
        }

        .searchtext {
            width: 50%;
            margin-left: 20%;
            margin-top: 6px;
            height: 30px;
            color: white;
            background-color: black;
            border: 2px solid black;
            font-size: larger;

            border-radius: 25px;
            padding-left: 20px;
        }

        input {
            width: 5%;
            height: 36px;
            color: white;
            background-color: black;
            border: 2px solid black;
            border-radius: 25px;
        }

        .login {
            text-align: right;
        }

        .guidlist table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .guidlist table td,
        .guidlist table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .guidlist tr:nth-child(even) {
            background-color: #faeeba;
        }

        .guidlist th:hover {
            background-color: rgba(221, 221, 221, 0.911);
        }

        .login a:link {
            color: rgb(255, 255, 255);
        }

        /* visited link */
        .login a:visited {
            color: rgb(255, 255, 255);
        }

        /* mouse over link */
        .login a:hover {
            color: rgb(214, 206, 206);
        }

        /* selected link */
        .login a:active {
            color: rgb(255, 255, 255);
        }

        button {
            background-color: transparent;
            background-repeat: no-repeat;
            padding: 15px 30px;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
        }
        .menu {
            background-color: transparent;
            overflow: hidden;
        }

        .menu a {
            float: left;
            color: rgb(247, 170, 55);
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .menu a:hover {
            background-color: transparent;
            color: rgb(247, 170, 55);
        }

        .menu a.active {
            background-color: #4CAF50;
            color: rgb(247, 170, 55);
        }

        .nav-link {
            color: rgb(247, 170, 55);
        }
        #service_grid {
            margin-top: 30px;
            margin-left: 20%;
            width: 50%;
            border: 1px solid black;
        }

        td {
            border-bottom: 1px solid black;
        }
        #service_grid button{
            height: 36px;
            color: white;
            background-color: black;
            border: 2px solid black;
            border-radius: 25px;
            font-size: medium;
            padding: 8px 10px 10px 10px;
        }
    </style>
    <div class='banner'>
        <br />
        <br />
        <h1>My list</h1>
        <div class='menu'>
            <div class='my_list'>
                <a href='index.php'><button>Main</button></a>
                <?php if ($_SESSION['username'] == 'admin') { ?>
                    <a class="nav-link" href="admin.php"> <button>Admin</button></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <table id="service_grid" class="table" width="100%" cellspacing="0">
        <tbody>
            <?php foreach ($ulists as $key => $ulist) {  ?>

                <?php

                if ($ulist['user_n'] == $_SESSION['username']) {

                ?>

                    <tr>
                        <td><?php echo $ulist['show_start'] ?></td>
                        <td><?php echo $ulist['show_name'] ?></td>
                        <td><?php echo $ulist['show_details'] ?></td>
                        <td><button class="btn btn-danger btn-xs" onclick="window.location.href='delete.php?show_id=<?php echo $ulist['show_id']; ?>'">Delete</button></td>

                        <?php
                    }
                        ?>
                        </div>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</body>

</html>