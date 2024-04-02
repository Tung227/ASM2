<?php
require_once('dbhelp.php');

$s_fullname = $s_age = $s_address = $s_masv = ''; // Thêm $s_masv vào

if (!empty($_POST)) {
    $s_id = '';

    if (isset($_POST['fullname'])) {
        $s_fullname = $_POST['fullname'];
    }

    if (isset($_POST['age'])) {
        $s_age = $_POST['age'];
    }

    if (isset($_POST['address'])) {
        $s_address = $_POST['address'];
    }

    if (isset($_POST['masv'])) { // Lấy dữ liệu từ trường masv
        $s_masv = $_POST['masv']; 
    }

    if (isset($_POST['id'])) {
        $s_id = $_POST['id'];
    }

    $s_fullname = str_replace('\'', '\\\'', $s_fullname);
    $s_age = str_replace('\'', '\\\'', $s_age);
    $s_address = str_replace('\'', '\\\'', $s_address);
    $s_masv = str_replace('\'', '\\\'', $s_masv); 

    if ($s_id != '') {
        
        $sql = "UPDATE colleges SET fullname = '$s_fullname', age = '$s_age', address = '$s_address', masv = '$s_masv' WHERE id = " . $s_id;
    } else {
        
        $sql = "INSERT INTO colleges(fullname, age, address, masv) VALUES ('$s_fullname', '$s_age', '$s_address', '$s_masv')";
    }

    execute($sql);

    header('Location: index.php');
    die();
}

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'SELECT * FROM colleges WHERE id = ' . $id;
    $studentList = executeResult($sql);
    if ($studentList != null && count($studentList) > 0) {
        $std = $studentList[0];
        $s_fullname = $std['fullname'];
        $s_age = $std['age'];
        $s_address = $std['address'];
        $s_masv = $std['masv']; // Lấy dữ liệu masv từ cơ sở dữ liệu
    } else {
        $id = '';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration Form * Form Tutorial</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</head>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="border-0">Add Student</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="usr">Name:</label>
                        <input type="number" name="id" value="<?= $id ?>" style="display: none;">
                        <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?= $s_fullname ?>">
                    </div>
                    <div class="form-group">
                        <label for="masv">Student ID:</label>
                        <input required="true" type="text" class="form-control" id="masv" name="masv" value="<?= $s_masv ?>">
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" value="<?= $s_age ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= $s_address ?>">
                    </div>
                    <button class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>



</body>

</html>
