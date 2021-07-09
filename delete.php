<?php
$show_id = $_GET['show_id'];
$dbname = "gp6khz";
$conn = pg_connect("host=localhost port=5432 dbname= gp6khz user=gp6khz password=gp6khz") or die('Cannot log in');

$show_sql = "DELETE FROM my_list WHERE show_id=$show_id";

$show_result = pg_query($show_sql);
$cmdtuples = pg_affected_rows($show_result);

if (count($errors) == 0) {
    $query = "DELETE FROM my_list WHERE show_id= $show_id";
    pg_query($conn, $query);

    header('location: mylist.php');
}