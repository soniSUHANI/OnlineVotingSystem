


<?php
session_start();
include('connect.php');

$votes = (int) $_POST['gvotes']; // Cast to integer for security
$total_votes = $votes + 1;
$gid = (int) $_POST['gid']; // Cast to integer for security
$uid = (int) $_SESSION['userdata']['id']; // Cast to integer for security

// Update the votes for the selected group
$update_votes = mysqli_query($connect, "UPDATE user SET votes = '$total_votes' WHERE id='$gid' AND role = 2");

// Update the user status to show that they have voted
$update_user_status = mysqli_query($connect, "UPDATE user SET status=1 WHERE id='$uid'");

if($update_votes && $update_user_status){
    // Retrieve updated group data
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;
    
    echo '
    <script>
        alert("Voting Successful!");
        window.location = "../routes/dashboard.php";
    </script>
    ';
} else {
    echo '
    <script>
        alert("An error occurred while voting. Please try again.");
        window.location = "../routes/dashboard.php";
    </script>
    ';
}
?>
