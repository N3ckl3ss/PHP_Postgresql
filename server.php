<?php

session_start();


$username = "";
$email    = "";
$errors = array();
$_SESSION['success'] = "";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$db = pg_connect("host=localhost port=5432 dbname=gp6khz user=gp6khz password=gp6khz") or die('Cannot log in');



if (isset($_POST['reg_user'])) {

    $username = pg_escape_string($db ,$_POST['username']);
    $email = pg_escape_string($db ,$_POST['email']);
    $password_1 = pg_escape_string($db ,$_POST['password_1']);
    $password_2 = pg_escape_string($db ,$_POST['password_2']);
    $usertype = pg_escape_string($db ,$_POST['password_2']);



    if (empty($username)) {
        array_push($errors, "User name must be set!");
    }
    if (empty($email)) {
        array_push($errors, "Email  name must be set!");
    }
    if (empty($password_1)) {
        array_push($errors, " Password name must be set!");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "Passwords do not match!");
    }
    

    if (count($errors) === 0) {

    $sql_u = "SELECT * FROM account WHERE username='$username'";
    $sql_e = "SELECT * FROM account WHERE email='$email'";
    $res_u = pg_query($db, $sql_u);
    $res_e = pg_query($db, $sql_e);
    if (pg_num_rows($res_u) > 0) {
        
        $name_error = "Username is already taken";
        echo '<script type="text/javascript">';
        echo 'alert("Username is already taken");';
        echo 'window.location.href = "registration.php";';
        echo '</script>';
    } else if (pg_num_rows($res_e) > 0) {

        echo '<script type="text/javascript">';
        echo 'alert("Email is already taken");';
        echo 'window.location.href = "registration.php";';
        echo '</script>';
    }else{ 
        

            $password = md5($password_1);
            $query = "INSERT INTO account (username, email, password) 
					  VALUES('$username', '$email', '$password')";
            pg_query($db, $query);


            $query1 = "SELECT id from account where username='$username'";
            $result = pg_query($db, $query1);
            if (pg_num_rows($result) > 0) {
                while ($row = pg_fetch_assoc($result)) {
                    $id = $row['id'];
                }
            }
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "Succesfull login";
                header('location: login.php');
            
        }
    }
}


if (isset($_POST['login_user'])) {
    $username = pg_escape_string($db, $_POST['username']);
    $password = pg_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is empty!");
    }
    if (empty($password)) {
        array_push($errors, "Password is empty!");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM account WHERE username='$username' AND password='$password'";

        $results =  pg_query($db, $query);
        $data = pg_fetch_all($results);




        if (pg_num_rows($results) > 0) {
            while ($row = pg_fetch_assoc($results)) {
                $id = $row['id'];
            }
        }

        if (pg_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;

            $_SESSION['success'] = "Succfully logedin!";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username or password!");
        }
    }
}



if (isset($_POST['reg_show'])) {

    $show_name = pg_escape_string($db,$_POST['show_name']);
    $show_start = pg_escape_string($db,$_POST['show_start']);
    $show_details = pg_escape_string($db,$_POST['show_details']);
    $actor_id = pg_escape_string($db,$_POST['actor_id']);
    $channel_id = pg_escape_string($db,$_POST['channel_id']);
    $show_img = pg_escape_string($db,$_POST['show_img']);


    if (empty($show_name)) {
        array_push($errors, "Show name must be added!");
    }
    if (empty($show_start)) {
        array_push($errors, "Starting time must be added!");
    }
    if (empty($show_details)) {
        array_push($errors, "Deatails must be added!");
    }
    if (empty($actor_id)) {
        array_push($errors, "Actor must be added!");
    }
    if (empty($channel_id)) {
        array_push($errors, "Channel must be added!");
    }



    if (count($errors) == 0) {
        $query = "INSERT into shows (show_name,show_start,show_details,actor_id,channel_id,show_img) 
        values('$show_name','$show_start','$show_details',$actor_id,$channel_id,'$show_img')";
        pg_query($db, $query);

        $_SESSION['show_name'] = $show_name;
        $_SESSION['success'] = "Succes!";

        header('location: admin.php');
    }
}


if(isset($_POST['update_list'])){

    $username = $_SESSION['username'];
    $show_id = pg_escape_string($db,$_POST['show_id']);
    $show_name = pg_escape_string($db,$_POST['show_name']);
    $show_start = pg_escape_string($db,$_POST['show_start']);
    $actor_id = pg_escape_string($db,$_POST['actor_id']);
    $show_img = pg_escape_string($db,$_POST['show_img']);
    $show_details = pg_escape_string($db,$_POST['show_details']);
    $channel_id = pg_escape_string($db,$_POST['channel_id']);

    if (empty($username)) {
        array_push($errors, "User name is empty!");
    }
    if (empty($show_id)) {
        array_push($errors, "Show id i empty!");
    }
    if (count($errors) == 0){

             $sql = "UPDATE shows SET show_name ='".$show_name ."', show_details='".$show_details
      ."' , show_start='".$show_start ."', show_img='".$show_img ."', actor_id='".$actor_id
      ."', channel_id='".$channel_id ."' WHERE show_id = '".$show_id."'";

        pg_query($db, $sql);


        header('location: admin.php');
    }

}
if(isset($_POST["add_to_list"]) && $_POST["add_to_list"] == "Add"){

    $username = pg_escape_string($db, $_POST['username']);
    $show_id = pg_escape_string($db, $_POST['show_id']);
    
    if (empty($username)) {
        array_push($errors, "User name is empty!");
    }
    if (empty($show_id)) {
        array_push($errors, "Show id i empty!");
    }
    if (count($errors) == 0) {
        $query = "INSERT INTO my_list (user_n,show_id)  VALUES ('$username',$show_id)";
        pg_query($db, $query);
    }
}