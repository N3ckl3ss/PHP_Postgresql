<?php
include("server.php");
error_reporting(E_ALL);
include("query.php");
$newObj = new Channel1();
$channel1 = $newObj->getChannel1Shows();
$newObj = new Channel2();
$channel2 = $newObj->getChannel2Shows();
$newObj = new Channel3();
$channel3 = $newObj->getChannel3Shows();


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = null;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport1' content='widtd=device-widtd, initial-scale=1.0'>
    <title>Start Page</title>
    <style>
        *,
        html {
            margin: 0;
            padding: 0;
        }

        .banner {
            background-image: url('backg.jpg');
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
            width: 50%;
            height: 20px;
            color: white;
            background-color: black;
            border: 2px solid black;
            border-radius: 25px;
            font-size: medium;
            padding: 8px 10px 10px 10px;
        }

        .search {

            margin-left: 30%;
        }

        .addToList {
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

        /*Welcoming Message*/
        .wmsg {
            text-align: right;
        }

        .guidlist table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .guidlist table td,
        .guidlist table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .guidlist td:ntd-child(even) {
            background-color: #faeeba;
        }

        .guidlist td:hover {
            background-color: rgba(221, 221, 221, 0.911);
        }

        a:link {
            color: black;
        }

        /* visited link */
        a:visited {
            color: rgb(255, 255, 255);
        }

        /* mouse over link */
        a:hover {
            color: rgb(214, 206, 206);
        }

        /* selected link */
        a:active {
            color: rgb(255, 255, 255);
        }

        button {
            background-color: transparent;
            background-repeat: no-repeat;
            padding: 15px 32px;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
        }

        .row {
            display: flex;
        }

        .column {
            flex: 50%;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        .bbc_1 img {
            width: 200px;
            height: 150px;
            padding: 10px;
            border-bottom: 3px solid black;
        }

        .bbc_2 img {
            width: 190px;
            height: 150px;
            padding: 10px;
            border-bottom: 3px solid black;
        }

        .bbc_3 img {
            width: 190px;
            height: 150px;
            padding: 10px;
            border-bottom: 3px solid black;
        }

        #bbc1 {
            margin-left: 10%;
            width: 70%;
            height: 10%;

        }

        #bbc2 {
            margin-left: 10%;
            width: 70%;
            height: 10%;

        }

        #bbc3 {
            margin-left: 10%;
            width: 70%;
            height: 10%;

        }

        .bbc_3 {
            -webkit-animation-name: fadeInDown;
            animation-name: fadeInDown;
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

        .btn input {
            width: 30%;
            height: 36px;
            color: white;
            background-color: black;
            border: 2px solid black;
            border-radius: 25px;
            font-size: medium;
            padding: 8px 10px 10px 10px;
        }


        .details {
            width: 80%;
            margin-left: 8%;
        }

        .actors {
            margin-right: 10%;
            float: right;
        }

        .time {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class='banner'>
        <?php if (!isset($_SESSION['username'])) { ?>
            <div class='login'>
                <a class="nav-link" href='login.php'>
                    <h2>Sign in</h2>
                </a>
            </div>
        <?php } else { ?>
            <div class='wmsg'>
                <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
            </div>
        <?php } ?>
        <h1>What is oN?</h1>

        <div class='menu'>
            <?php if (isset($_SESSION['username'])) { ?>
                <div class='my_list'>
                    <a class="nav-link" href="mylist.php"><button>My list</button></a>
                    <a class="nav-link" href="game/Dama.html"><button>Till the Show begins</button></a>
                    <a class="nav-link" href="index.php?logout='1'"> <button>Logout</button></a>
                    <?php if ($_SESSION['username'] == 'admin') { ?>
                        <a class="nav-link" href="admin.php"> <button>Admin</button></a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <br>
    </div>
    <div class='search'>
        <br>
        <input type="text" id="search" onkeyup="searchFunction()" placeholder="Search for names..">
    </div>
    <br>
    <div class="row">
        <div class="column">
            <table class="listtable" data-name="listtable">
                <th>
                    <tr>
                        <div class="bbc_1">
                            <center><img src="bbc1.jpg" /></center>
                        </div>
                    </tr>
                    <br />
                    <?  while($result = pg_fetch_assoc($results)) { ?>
                    <?php foreach ($channel1 as $key => $channel1) : ?>
                        <tr>
                        <div class="boxdiv" id="<?php echo $channel1['show_id'] ?>">
                            <div class="time">
                                <?php echo $channel1['show_start'] ?>
                            </div>
                            <br />
                            <center>
                            <div class="title" id="<?php echo $channel1['show_id'] ?>">
                                <h3><?php echo $channel1['show_name'] ?></h3>
                            </div>
                            </center>
                            <br />
                            <?php if (!empty($channel1['show_img'])) : ?>
                                <img id="bbc1" src='<?php echo $channel1['show_img'] ?> '>
                            <?php endif; ?>
                            <br />
                            <br />
                            <div class="details" id="<?php echo $channel1['show_id'] ?>">
                                <?php echo $channel1['show_details'] ?>
                            </div>
                            <br />
                            <div class="actors" id="<?php echo $channel1['show_id'] ?>">
                                <h5>Actor: <?php echo $channel1['actor_name'] ?></h5>
                            </div>
                            <form method="post" action="index.php">
                                <input type="hidden" name="show_id" id="show_id" value="<?php echo $channel1['show_id'] ?>" />
                                <input type="hidden" name="username" id="username" value="<?php echo $username ?>" />
                                <div class="btn">
        <?php if (isset($_SESSION['username'])) { ?>
            <input type='submit' name="add_to_list" class="addToList" value='Add' />
        <?php } ?>
        </form>
        </div>
                        </div>        
        </div>
    </div>
        </tr>
        <br />
    </div>
<?php endforeach; ?>
</th>
</table>
</div>
<div class="column">
    <table class="listtable" data-name="listtable">
        <th>
            <tr>
                <div class="bbc_2">
                    <center><img src="bbc-2-three-logo.png" /></center>
                </div>
            </tr>
            <br />
            <?  while($result = pg_fetch_assoc($results)) { ?>
            <?php foreach ($channel2 as $key => $channel2) : ?>
                <tr>
                <div class="boxdiv" id="<?php echo $channel2['show_id'] ?>">
                            <div class="time">
                                <?php echo $channel2['show_start'] ?>
                            </div>
                            <br />
                            <center>
                            <div class="title" id="<?php echo $channel2['show_id'] ?>">
                                <h3><?php echo $channel2['show_name'] ?></h3>
                            </div>
                            </center>
                            <br />
                            <?php if (!empty($channel2['show_img'])) : ?>
                                <img id="bbc1" src='<?php echo $channel2['show_img'] ?> '>
                            <?php endif; ?>
                            <br />
                            <br />
                            <div class="details" id="<?php echo $channel2['show_id'] ?>">
                                <?php echo $channel2['show_details'] ?>
                            </div>
                            <br />
                            <div class="actors" id="<?php echo $channel2['show_id'] ?>">
                                <h5>Actor: <?php echo $channel2['actor_name'] ?></h5>
                            </div>
                    <form method="post" action="index.php">
                        <input type="hidden" name="show_id" id="show_id" value="<?php echo $channel2['show_id'] ?>" />
                        <input type="hidden" name="username" id="username" value="<?php echo $username ?>" />
</div>
</div>
<div class="btn">
    <?php if (isset($_SESSION['username'])) { ?>
        <input type='submit' name="add_to_list" class="addToList" value='Add' />
    <?php } ?>
    </form>
    </form>
    </tr>
    <br />
</div>
<?php endforeach; ?>
</th>
</table>
</div>
<div class="column">
    <table class="listtable" data-name="listtable">
        <th>
            <tr>
                <div class="bbc_3">
                    <center><img src="bbc-3-three-logo.png" /></center>
                </div>
            </tr>
            <br />
            <?  while($result = pg_fetch_assoc($results)) { ?>
            <?php foreach ($channel3 as $key => $channel3) : ?>
                <tr>
                <div class="boxdiv" id="<?php echo $channel3['show_id'] ?>">
                            <div class="time">
                                <?php echo $channel3['show_start'] ?>
                            </div>
                            <br />
                            <center>
                            <div class="title" id="<?php echo $channel3['show_id'] ?>">
                                <h3><?php echo $channel3['show_name'] ?></h3>
                            </div>
                            </center>
                            <br />
                            <?php if (!empty($channel3['show_img'])) : ?>
                                <img id="bbc1" src='<?php echo $channel3['show_img'] ?> '>
                            <?php endif; ?>
                            <br />
                            <br />
                            <div class="details" id="<?php echo $channel3['show_id'] ?>">
                                <?php echo $channel3['show_details'] ?>
                            </div>
                            <br />
                            <div class="actors" id="<?php echo $channel3['show_id'] ?>">
                                <h5>Actor: <?php echo $channel3['actor_name'] ?></h5>
                            </div>
                    <form method="post" action="index.php">
                        <input type="hidden" name="show_id" id="show_id" value="<?php echo $channel3['show_id'] ?>" />
                        <input type="hidden" name="username" id="username" value="<?php echo $username ?>" />
</div>
</div>
<div class="btn">
    <?php if (isset($_SESSION['username'])) { ?>
        <input type='submit' name="add_to_list" class="addToList" value='Add' />
    <?php } ?>
    </form>
    </form>
    </tr>
    <br />
</div>
<?php endforeach; ?>
</th>
</table>
</div>
</div>
<script>
    function searchFunction() {
    var boxdiv = document.getElementsByClassName("boxdiv");
    var input = document.getElementById("search");
    var filter = input.value.toUpperCase();
    var titles = document.getElementsByClassName("title");
    for (i = 0; i < boxdiv.length; i++) {
      for (i = 0; i < titles.length; i++) {
        title = titles[i];
        txtValue = title.textContent || title.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            boxdiv[i].style.display = "";
        } else {
            boxdiv[i].style.display = "none";
        }
    }
    }
}
</script>
</body>
</html>