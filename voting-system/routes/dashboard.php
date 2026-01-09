<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("Location: ../");
    exit();
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];
?>

<html>
<head>
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>

<div id="headerSection">
    <button id="backbtn" onclick="history.back()">Back</button>
    <a href="../"><button id="logoutbtn">Logout</button></a>
    <h1>Online Voting System</h1>
</div>
<hr>

<!-- USER PROFILE SECTION -->
<div id="profile">
    <h2>Your Profile</h2>

    <p><b>Name:</b> <?php echo $userdata['name']; ?></p>
    <p><b>Mobile:</b> <?php echo $userdata['mobile']; ?></p>
    <p><b>Address:</b> <?php echo $userdata['address']; ?></p>
    <p><b>Status:</b> 
        <?php 
            if($userdata['status'] == 0){
                echo "<span style='color:red;'>Not Voted</span>";
            } else {
                echo "<span style='color:green;'>Voted</span>";
            }
        ?>
    </p>
</div>

<hr>

<!-- GROUP LIST SECTION -->
<div id="Group">
    <h2>Groups Available</h2>

    <?php 
    if(count($groupsdata) > 0){
        foreach($groupsdata as $group){
            echo "
            <div class='groupBox'>
                <p><b>Group Name:</b> ".$group['name']."</p>
                <p><b>Votes:</b> ".$group['votes']."</p>
                <form action='../api/vote.php' method='POST'>
                    <input type='hidden' name='gvotes' value='".$group['votes']."'>
                    <input type='hidden' name='gid' value='".$group['id']."'>
                    <input type='submit' value='Vote' name='votebtn'>
                </form>
            </div>
            <hr>";
        }
    } else {
        echo "<p>No groups found.</p>";
    }
    ?>

</div>

</body>
</html>
