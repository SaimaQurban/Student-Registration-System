<?php
require_once 'connection.php';
function display_data(){
    global $con;
    $query = "selet* from students";
    $result = mysqli_query($con,$query);
    return $result;
}
?>