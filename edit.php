<?php
require('require.php');
$header_title = "Edit Form";

$form        = true;
$error       = false;
$error_msg   = "";

if (isset($_POST['submit']) && $_POST['form-sub'] == 1) {
    $id = (int)$_POST['id'];
    $student_name   = $mysqli->real_escape_string($_POST["name"]);
    $student_age    = $mysqli->real_escape_string($_POST["age"]);
    $student_gender = $mysqli->real_escape_string($_POST["gender"]);
    $student_grade  = $mysqli->real_escape_string($_POST["grade"]);
    $student_reg    = $mysqli->real_escape_string($_POST["register-date"]);

    // Validation
    $process_err    = false;

    // Name check for already exists or not
    $nameCheckSql = "SELECT id FROM `student_db` WHERE name = '$student_name' AND id != $id WHERE deleted_at IS NULL";
    $name_result  = $mysqli->query($nameCheckSql);
    if ($name_result && $name_result->num_rows > 0) {
        $process_err = true;
        $error       = true;
        $error_msg   = "This name (" . $student_name . ") already exists.";
    }

    if ($student_name == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in your Name. <br />";
    }
    if ($student_age == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please enter a valid Age. <br />";
    }
    if ($student_gender == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in your Gender. <br />";
    }
    if ($student_grade == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in your Grade. <br />";
    }
    if ($student_reg == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in the Registration Date. <br />";
    }
    if ($process_err == false) {
        $student_reg = date('Y-m-d', strtotime($student_reg));
        $updateSql = "UPDATE `student_db` SET " .
            "name = '$student_name'," .
            "age = $student_age," .
            "gender = '$student_gender'," .
            "grade = '$student_grade'," .
            "register_date = '$student_reg'" .
            " WHERE id = $id";
        $result =  $mysqli->query($updateSql);
        if ($result) {
            $url = $base_url . "index.php?msg=update";
            header("Refresh: 0; url=$url");
        } else {
            $error = true;
            $error_msg = "Please contact the administrator.";
        }
    }
} else {
    $id = (int)$_GET['id'];

    $sql = "SELECT * FROM `student_db` WHERE id = $id";
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows == 0) {
        $form = false;
        $error = true;
        $error_msg = "Something is wrong.";
    } else {
        $row = $result->fetch_assoc();
        $student_name   = htmlspecialchars($row['name']);
        $student_age    = (int)$row['age'];
        $student_gender = (int)$row['gender'];
        $student_grade  = (int)$row['grade'];
        $register_date  = $row['register_date'];
        $student_reg    = changemdYFormat($register_date);
    }
}
?>

<?php require('template/form_header.php'); ?>
<div>
    <p style="color:red">
    <div style="display: flex; justify-content: center; align-items: right; height: 100vh;">
        <div style="text-align: center;">
            <?php if ($error_msg) : ?>
                <p style="color:red; background-color: lightyellow; padding: 10px; border: 1px solid red; border-radius: 5px;"><?php echo $error_msg ?></p>
            <?php endif; ?>
            </p>
            <?php if ($form) : ?>
                <form action="<?php echo $base_url . 'edit.php?id=' . $id; ?>" method="POST">
                    <div class="container">
                        <h2 class="header">Edit</h2>
                        <label for="name"><b>Name</b></label>
                        <input type="text" placeholder="Enter your name" name="name" id="name" value="<?php echo $student_name ?>">
                        <hr>

                        <label for="age"><b>Age</b></label>
                        <input type="text" placeholder="Enter age" name="age" id="age" value="<?php echo $student_age ?>">
                        <hr>

                        <label for="gender"><b>Gender</b></label>
                        <select name="gender" id="gender">
                            <option value="">Select gender</option>
                            <option value="1" <?php if ($student_gender == 1) echo "selected"; ?>>Male</option>
                            <option value="2" <?php if ($student_gender == 2) echo "selected"; ?>>Female</option>
                            <option value="3" <?php if ($student_gender == 3) echo "selected"; ?>>Other</option>
                        </select>
                        <?php if ($error && $student_gender == '') : ?>
                            <p style="color:red;">Please fill in your Gender.</p>
                        <?php endif; ?>
                        <hr>

                        <label for="grade"><b>Grade</b></label>
                        <input type="text" placeholder="Enter grade" name="grade" id="grade" value="<?php echo $student_grade ?>">
                        <?php if ($error && $student_grade == '') : ?>
                            <p style="color:red;">Please fill in your Grade.</p>
                        <?php endif; ?>
                        <hr>

                        <label for="register-date"><b>Registration Date</b></label>
                        <input type="text" placeholder="Enter Date" name="register-date" id="register-date" value="<?php echo $student_reg ?>">

                        <hr>

                        <input class="button button5" type="submit" value="Submit" name="submit">
                        <input type="hidden" value="1" name="form-sub" />
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#register-date").datepicker();
    });
</script>
