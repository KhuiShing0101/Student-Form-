<?php
require('require.php');
require('include_files/include_townships.php');
require('include_files/include_hobbies.php');

print_r($db_hobbies);
// print_r($db_townships);
exit();

$process_err = false;
$error       = false;
$error_msg   = "";

$student_name   = '';
$student_age    = '';
$student_gender = '';
$student_grade  = '';
$student_reg    = '';
$success_msg    = '';
$township       = '';
$hobby          = '';

if (isset($_POST['submit']) && $_POST['form-sub'] == 1) {

    $student_name   = $mysqli->real_escape_string($_POST['name']);
    $student_gender = $mysqli->real_escape_string($_POST['gender']);
    $student_reg    = $mysqli->real_escape_string($_POST['register-date']);
    $student_grade  = $mysqli->real_escape_string($_POST['grade']);
    $student_age    = $mysqli->real_escape_string($_POST['age']);
    $township       = $mysqli->real_escape_string($_POST['township']);

    // Same Name Check
    $nameCheckSql = "SELECT id FROM `student_db` WHERE name= '$student_name' ";
    $result   = $mysqli->query($nameCheckSql);
    if ($result->num_rows > 0) {
        $process_err = true;
        $error       = true;
        $error_msg   = "This name (" . $student_name . ") already exists. <br/>";
    }

    // Check Validation Server Side
    if ($student_name == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in your Name <br />";
    }
    if ($student_age == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in your Age <br />";
    }
    if ($student_gender == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in your Gender <br />";
    }
    if ($student_grade == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in your Grade <br />";
    }
    if ($student_reg == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please fill in the Registration Date <br />";
    }

    if ($township == '') {
        $process_err = true;
        $error       = true;
        $error_msg   .= "Please choose Township <br />";
    }

    if ($process_err == false) {
        $insstudent_reg    = changeYmdFormat($_POST['register-date']);
        $sql = "INSERT INTO `student_db` 
                ( name,
                age,
                gender,
                grade,
                register_date,
                township_id
                )
                VALUES 
                (
                    '" . $student_name . "',
                    '" . $student_age . "',
                    '" . $student_gender . "',
                    '" . $student_grade . "',
                    '" . $insstudent_reg . "',
                    '" . $township."'
                )";
        $insert = $mysqli->query($sql);
        if ($insert) {
            $url = $base_url . "index.php?msg=insert";
            header("refresh:0 ; url=$url");
        } else {
            $error = true;
            $error_msg = "Failed to create student record. Please try again.";
        }
    }
}
?>
<?php
require('template/form_header.php')
?>
<div>
    <p style="color:red">
    <div style="display: flex; justify-content: center; align-items: right; height: 100vh;">
        <div style="text-align: center;">
            <?php if ($error_msg == true) : ?>
                <p style="color:red; background-color: lightyellow; padding: 10px; border: 1px solid red; border-radius: 5px;"><?php echo $error_msg ?></p>
            <?php endif; ?>
            </p>
            <?php if ($success_msg) : ?>
                <p style="color:green;"><?php echo $success_msg; ?></p>
            <?php else : ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="container">
                        <h2 class="header">Register</h2>
                        <label for="name"><b> Name</b></label>
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
                        <hr>

                        <label for="grade"><b>Grade</b></label>
                        <input type="text" placeholder="Enter grade" name="grade" id="grade" value="<?php echo $student_grade ?>">
                        <hr>

                        <label for="township"><b>Townships</b></label>
                        <select name="township" id="township">
                            <option value="">Select township</option>
                            <?php
                            foreach ($db_townships as $db_township) {
                                echo '<option value="' . $db_township['id'] . '"';
                                if ($db_township['id'] == $township) {
                                    echo ' selected';
                                }
                                echo '>' . $db_township['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <hr>

                        <label for="hobbies">Hobbies</label> <br />
                        <?php 
                            foreach($db_hobbies as $db_hobby){
                        ?>
                            <div style="display: inline-block;">
                            <input type="checkbox" name="hobby">
                                <label for="hobbie-1" id="<?php echo $db_hobby['id']?>">
                                    <?php echo $db_hobby['name'] ?>
                                </label> &nbsp;&nbsp;
                            </div>
                        <?php
                            }
                        ?>
                        

                        <br />
                        <label for="register-date"><b>Registration Date</b></label>
                        <input type="text" placeholder="Enter Date" name="register-date" id="register-date" value="<?php echo $student_reg ?>">
                        <hr>

                        <input class="button button5" type="submit" value="Submit" name="submit">

                        <input type="hidden" value="1" name="form-sub">
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