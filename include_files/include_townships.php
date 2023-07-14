<?php

$db_townships = [];
$sql = "SELECT id, name FROM `townships`";
$result = $mysqli->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $id         = (int)($row['id']);
        $name       = htmlspecialchars($row['name']);
        $data['id'] = $id;
        $data['name'] = $name;
        array_push($db_townships, $data);
    }
} else {
    echo "DB Error: " . $mysqli->error;
    exit();
}
