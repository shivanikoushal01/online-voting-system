<?php
include("connect.php");
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

if ($password == $cpassword) {

    // Move the uploaded file
    if (move_uploaded_file($tmp_name, "../uploads/$image")) {

        // Insert query (correct order)
        $insert = mysqli_query($connect, 
            "INSERT INTO users (name, mobile, address, password, photo, role, status, votes) 
             VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', 0, 0)");

        if ($insert) {
            echo '
            <script>
            alert("Registration Successful!");
            window.location = "../";
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Database error! Please try again.");
            window.location = "../routes/register.html";
            </script>
            ';
        }

    } else {
        echo '
        <script>
        alert("Failed to upload image!");
        window.location = "../routes/register.html";
        </script>
        ';
    }

} else {
    echo '
    <script>
    alert("Password and Confirm password do not match");
    window.location = "../routes/register.html";
    </script>
    ';
}
?>
