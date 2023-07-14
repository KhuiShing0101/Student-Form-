<?php

require('require.php');

$success        = false;
$success_msg    = '';

$sql = "SELECT T01.id, T01.name, T01.age, T01.gender, T01.grade, T01.register_date,T02.name as township_name 
        FROM `student_db` T01 LEFT JOIN `townships` T02 ON T01.township_id = T02.id WHERE T01.deleted_at IS NULL ORDER BY T01.id DESC";
$result     = $mysqli->query($sql);
$res_row    = $result->num_rows;

if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "insert") {
        $success     = true;
        $success_msg = "Successfully Inserted";
    } else if ($_GET['msg'] == "update") {
        $success     = true;
        $success_msg = "Successfully Updated";
    } else {
        $success    = true;
        $success_msg = "successfully Deleted";
    }
}
?>
<?php
require('template/form_header.php');
?>
<h2>Student Information</h2>

<?php
if ($success) {
?>
    <h3 style="color: greenyellow;"><?php echo $success_msg ?></h3>
<?php
}
?>
<a href="<?php echo $base_url ?>create_form.php" style="
        background-color: #bfd200;
        color: white;
        padding: 10px 20px;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px 0;
        border-radius: 10px;
        cursor: pointer;">
    Create Form
</a>

<br />
<table id="customers">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Townships</th>
            <th>Grade</th>
            <th>Register Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    if ($res_row >= 1) {
        while ($row = $result->fetch_assoc()) :
    ?>
            <?php

            ?>
            <tr>
                <td>
                    <?php echo (int) $row['id']; ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['name']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['age']); ?>
                </td>
                <td>
                    <?php
                    $gender = (int) $row['gender'];
                    echo htmlspecialchars($commonGender[$gender]);
                    ?>
                </td>
                <td>
                    <?php
                    echo htmlspecialchars($row['township_name']);
                    ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['grade']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['register_date']); ?>
                </td>
                <td>
                    <a href="<?php echo $base_url . "edit.php?id=" . $row['id']; ?>" style="
                            background-color: #bfd200;
                            color: white;
                            padding: 5px 10px;
                            border: none;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            margin: 10px 0;
                            border-radius: 5px;
                            cursor: pointer;">
                        Edit
                    </a>
                    <a href="<?php echo $base_url . "delete.php?id=" . $row['id']; ?>" style="
                            background-color: red;
                            color: white;
                            padding: 5px 10px;
                            border: none;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            margin: 10px 0;
                            border-radius: 5px;
                            cursor: pointer;">
                        Delete
                    </a>
                </td>
            </tr>
    <?php endwhile;
    }
    ?>
</table>
<?php
require('template/form_footer.php');
?>