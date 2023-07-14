<?php 
    require('require.php');
    $id         = (int) $_GET['id'];
    $id         = $mysqli->real_escape_string($id);
    $today      = date("Y-m-d H-i-s");
    $sql        = "UPDATE `student_db` Set deleted_at = '".$today."' Where id = '". $id ."'";
    $deleteSql  = $mysqli->query($sql);
    $url        = $base_url . "index.php?msg=delete";
    header("Refresh: 0, url=$url");   
    exit();
?>