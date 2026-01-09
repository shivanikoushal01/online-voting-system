<?php
session_start();
include('connect.php');
if ($_SESSION['userdata']['status'] == 1) {
    echo '
    <script>
    alert("You have already voted!");
    window.location = "../routes/dashboard.php";
    </script>
    ';
    exit();
}

$votes = $_POST['gvotes'];
$total_votes = $votes + 1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

$update_votes = mysqli_query($connect, "UPDATE users SET votes = '$total_votes' WHERE id = '$gid'");
$update_user_status = mysqli_query($connect, "UPDATE users SET status = 1 WHERE id = '$uid'");

if ($update_votes && $update_user_status) {
    $groups = mysqli_query($connect, "SELECT id, name, votes, photo FROM users WHERE role = 2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '
    <script>
    alert("Voting successful!");
    window.location = "../routes/dashboard.php";
    </script>
    ';
} else {
    echo '
    <script>
    alert("Some error occurred");
    window.location = "../routes/dashboard.php";
    </script>
    ';
}
?>
