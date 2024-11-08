<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status'] == 0){
    $status = '<b style="color: red">Not Voted</b>';
} else {
    $status = '<b style="color: green">Voted</b>';
}
?>

<html>
<head>
    <title>Online Voting System - Dashboard</title>
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        #headerSection {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        #headerSection h1 {
            margin: 0;
        }
        #backbtn, #logoutbtn {
            padding: 10px 20px;
            font-size: 15px;
            background-color: #555;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            text-decoration: none;
        }
        #backbtn:hover, #logoutbtn:hover {
            background-color: #444;
        }
        #mainpanel {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }
        #Profile, #Group {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 45%;
        }
        #Profile img {
            border-radius: 50%;
        }
        #votebtn {
            padding: 10px 15px;
            font-size: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #votebtn:hover {
            background-color: #0056b3;
        }
        #voted {
            padding: 10px 15px;
            font-size: 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: not-allowed;
        }
        #Group div {
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
    </style>

    <div id="headerSection">
        <a href="../"><button id="backbtn">Back</button></a>
        <a href="logout.php"><button id="logoutbtn">Logout</button></a>
        <h1>Online Voting System</h1>
    </div>
    <div id="mainpanel">
        <div id="Profile">
            <center>
                <img src="../uploads/<?php echo $userdata['photo']; ?>" height="100" width="100">
            </center>
            <br><br>
            <b>Name:</b> <?php echo $userdata['name']; ?><br><br>
            <b>Mobile:</b> <?php echo $userdata['mobile']; ?><br><br>
            <b>Address:</b> <?php echo $userdata['address']; ?><br><br>
            <b>Status:</b> <?php echo $status; ?><br><br>
        </div>

        <div id="Group">
            <?php
            if($groupsdata){
                foreach ($groupsdata as $group) {
                    echo '<div>';
                    echo '<img style="float: right" src="../uploads/' . $group['photo'] . '" height="100" width="100"><br>';
                    echo '<b>Group Name: </b>' . $group['name'] . '<br>';
                    echo '<b>Votes: </b>' . $group['votes'] . '<br>';
                    echo '<form action="../api/vote.php" method="POST">';
                    echo '<input type="hidden" name="gvotes" value="' . $group['votes'] . '">';
                    echo '<input type="hidden" name="gid" value="' . $group['id'] . '">';

                    if($_SESSION['userdata']['status'] == 0) {
                        echo '<input type="submit" name="votebtn" value="Vote" id="votebtn">';
                    } else {
                        echo '<button type="button" id="voted" disabled>Voted</button>';
                    }
                    echo '</form><br><br></div><hr>';
                }
            } else {
                echo "<p>No groups available.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
