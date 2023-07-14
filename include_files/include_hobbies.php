<?php 
    $db_hobbies = [];
    $sql = "SELECT id , name FROM `hobbies`";

    $result =$mysqli->query($sql);

    if($result){
        while($row = $result->fetch_assoc()){
            $id     = (int)($row['id']);
            $name   = htmlspecialchars($row['name']);
            $id     = $data['id'];
            $name   = $data['name'];
            array_push($db_hobbies,$data);
        }
    }
?>