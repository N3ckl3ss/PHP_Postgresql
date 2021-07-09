<?php
include('server.php');
include('query.php');
$newObj = new Shows();
$shows = $newObj->getShows();
$newObj = new NotUsedActors();
$notusedactors = $newObj->getNotUsedActors();
error_reporting(E_ALL);
ini_set('display_errors', '1');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        *,
        html {
            margin: 0;
            padding: 0;
        }

        h1 {
            align-self: start;
            color: white;
            text-align: center;
            padding-bottom: 5%;
            font-size: 100px;

        }
        .banner{
            background-image: url('backg.jpeg');
            color: aliceblue;
            background-position: 100%;
            width: 100%;
            height: 200px;
            background-position-y: 99%;
            background-position-x: center;
            margin-left: 0%;
            background-attachment: fixed;
            background-repeat: no-repeat;
            align-items: center;

        }
        .menu {
            background-color: grey;
            overflow: hidden;
        }

        .menu a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .menu a:hover {
            background-color: #ddd;
            color: black;
        }

        .menu a.active {
            background-color: #4CAF50;
            color: white;
        }

        #show_table {
            border: 1px solid black;
        }

        td {
            border-bottom: 1px solid black;
        }

        input {
            width: 50%;
            height: 36px;
        }

        button {
            height: 36px;
            color: white;
            background-color: black;
            border: 2px solid black;
            border-radius: 25px;
            font-size: medium;
            padding: 8px 10px 10px 10px;
        }

        .sa {
            margin-left: 10%;
        }
        .form-group{
            padding-bottom: 30px;
        }
        .actorlist{
            float: right;
            margin-right: 5%;
        }
        .actorlist td{
            width: 130px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="banner">
        <h1>Admin</h1>
    </div>
    <div class='menu'>
        <?php if (isset($_SESSION['username'])) { ?>
            <div class='my_list'>
                <a class="nav-link" href="index.php?logout='1'"> <button>Logout</button></a>
                <?php if ($_SESSION['username'] == 'admin') { ?>
                    <h2><a class="nav-link" href="index.php"><button>Back to main page</button></a></h2>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <br>
    <div class="actorlist">
        <h2>Not used actors</h2>
    <table id="show_table" class="table" width="100%" cellspacing="0">
        <thead class="thead-dark">
                <th style=" border-bottom:1px solid black;">id</th>
                <th style=" border-bottom:1px solid black;">Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notusedactors as $key => $notusedactor) : ?>
                <tr>
                    <td><?php echo $notusedactor['actor_id'] ?></td>
                    <td><?php echo $notusedactor['actor_name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
   
    <div>
        <?php foreach ($errors as $error) : ?>
            <?= $error ?> <br>
        <?php endforeach ?>
    </div>
    <div class="sa">
        <form method="post" action="admin.php">
            <div class="form-group">
                <input type="text" class="form-control" id="show_name" placeholder="Add show name" name="show_name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="show_start" placeholder="When the Show starts (like 00:00)" name="show_start">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="actor_id" placeholder="The id of the actor" name="actor_id">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="show_img" placeholder="Add the url of the image" name="show_img">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="show_details" placeholder="Add description" name="show_details">
            </div>
            <div class="form-group">
                <select class="form-control" name="channel_id">
                    <option name="channel_id" class="form-control" value="1">BBC One</option>
                    <option name="channel_id" class="form-control" value="2">BBC Two</option>
                    <option name="channel_id" class="form-control" value="3">BBC Three</option>
                </select>
            </div>
            <button type="submit" name="reg_show">Add show</button>

        </form>
    </div>
    <br>
    <br>
    <table id="show_table" class="table" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th style=" border-bottom:1px solid black;">Name</th>
                <th style=" border-bottom:1px solid black;">Starting time</th>
                <th style=" border-bottom:1px solid black;">Details</th>
                <th style=" border-bottom:1px solid black;">Actor</th>
                <th style=" border-bottom:1px solid black;"></th>
                <th style=" border-bottom:1px solid black;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shows as $key => $show) : ?>
                <tr>
                    <td><?php echo $show['show_name'] ?></td>
                    <td><?php echo $show['show_start'] ?></td>
                    <td><?php echo $show['show_details'] ?></td>
                    <td><?php echo $show['actor_name'] ?></td>
                    <td><?php echo $show['channel_name'] ?></td>
                    <td>
                        <!-- onclick="window.location.href='edit.php?show_id=<?php echo $prod['show_id']; ?>'"!-->
                        <button class="btn btn-warning btn-xs" onclick="window.location.href='edit.php?show_id=<?php echo $show['show_id']; ?>'">Edit</button>
                        <button class="btn btn-danger btn-xs" onclick="window.location.href='delet.php?show_id=<?php echo $show['show_id']; ?>'">Delete</button>
                        <br>
                    </td>
                    </div>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>