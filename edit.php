<?php include('server.php');
$id = $_GET['show_id'];
$sql = "SELECT * from shows where show_id ='" . $id . "'";

$result = pg_query($sql);
$cmdtuples = pg_affected_rows($result);
$row = pg_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
<div>
        <?php foreach ($errors as $error) : ?>
          <?= $error ?> <br>
        <?php endforeach ?>
      </div>
          <div class="row">
          <h1>Edit show</h1>
  <form method="post" action="edit.php">
                            <input type="hidden" name="new" value="1" />
                            <input name="show_id" type="hidden" value="<?php echo $row['show_id']; ?>" />
                            <div class="form-group">
                                <input type="text" class="form-control" id="show_name" placeholder="Add show name" name="show_name"  required value="<?php echo $row['show_name']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="show_start" placeholder="When the Show starts (like 00:00)" name="show_start"  required value="<?php echo $row['show_start']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="actor_id" placeholder="The id of the actor" name="actor_id"  required value="<?php echo $row['actor_id']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="show_img" placeholder="Add the url of the image" name="show_img"  required value="<?php echo $row['show_img']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="show_details" placeholder="Add description" name="show_details"  required value="<?php echo $row['show_details']; ?>">
                            </div>
                            <div class="form-group">
                           <select class="form-control" name="channel_id">
                                    <option name="channel_id" class="form-control" value="1">BBC One</option>
                                    <option name="channel_id" class="form-control" value="2">BBC Two</option>
                                    <option name="channel_id" class="form-control" value="3">BBC Three</option>
                                </select> 
                            </div>
                            <button type="submit" class="btn btn-primary" name="update_list">update</button>
                        </form>
                    </div>
</body>
</html>