<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['username'])){
include("../../config/database.php");
$id = $_SESSION['id'];
$eid = $_SESSION['username'];
$sql = "SELECT * FROM admin WHERE eid = '$eid'";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);
if($row = mysqli_fetch_assoc($result)){
    $fname= ucfirst($row['fname']);
    $lname = ucfirst($row['lname']);
    
    $status = $row['status'];
}
if($status == 'yes' || $status == 'Yes') {
    if(isset($_GET['ret'])) {
        if ($_GET['ret'] == 'success') {
            echo '<script>alert("Replied Successful")</script>';
        }
        if ($_GET['ret'] == 'cancel') {
            echo '<script>alert("Replied Cancel")</script>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Imcoming Complaints-MIS</title>
    <link rel="stylesheet" type="text/css" href="../admin/css/style.css">
</head>
<body>
<h2 align="center" style="color: blue"><?php echo "Super Admin (Main Center)" ?></h2>
<div class="header">

    <span style="font-size:30px;cursor:pointer" class="logo" onclick="openNav()">&#9776; open </span>

    <div class="header-right">
        <a href="profile.php">
            <?php echo $fname . " " . $lname . " (" . strtoupper($eid) . ")" ?></a>
    </div>
</div>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php" class="logo"><span style="color:red;font-size:70px">MIS</span></a>
    <a href="profile.php"><?php echo $fname . " " . $lname . " (" . strtoupper($eid) . ")" ?></a>
    <a href="index.php">Home</a>
    <a href="add.php">Add/Update</a>
    <a href="view.php">View Details</a>
    <a href="incomingcomplaint.php">Incoming Complaint</a>
    <a href="update_password.php">Update Password</a>
    <a href="../../logout.php">Logout</a>
</div>
<?php
    $sql_get_complaint = "SELECT * FROM complaint WHERE eid = '$eid' AND (teacher_type='sadmin' OR teacher_type='SAdmin') ORDER BY  dateofcomp";
    $sql_get_complaint_check = mysqli_query($conn,$sql_get_complaint);
    $sql_get_complaint_check_result = mysqli_num_rows($sql_get_complaint_check);
    if($sql_get_complaint_check_result>0){
        ?>
        <div align="center">
            <h4>Incoming Complaints</h4>
            <table border="2px" cellpadding="10px">
                <tr>
                    <th>Username</th>
                    <th>Center</th>
                    <th>Subject</th>
                    <th>Complaint</th>
                    <th>Date Of Complaint</th>
                    <th>Reply</th>
                </tr>
            <?php while($rown = mysqli_fetch_assoc($sql_get_complaint_check)){
                    $id_get = $rown['id'];
                ?>
                <tr align="center">
                <td><?php echo $rown['username']?></td>
                <td><?php echo ucfirst($rown['center']);?></td>
                <td><?php echo $rown['subject']?></td>
                <td><?php echo $rown['complaint']?></td>
                <td><?php echo $rown['dateofcomp']?></td>
                 <td><?php
                     if($rown['replyed']=='1'){?>
                         <a href="reply.php?complaintid=<?php echo $id_get?>">See Replied</a>
                    <?php }else{?><a href="reply.php?complaintid=<?php echo $id_get?>">Reply</a> </td>
                <?php } ?>
                </tr>
            <?php } ?>
            </table>
        </div>

    <?php }
?>


<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
</body>
    </html>
    <?php
}else{
    ?>
    <h1>Your account is deactivated by admin due to some reasons. kindly contact Admin for further.</h1>
    <h1 align="center"><a href="../../logout.php">Logout</a> </h1>
    <?php
}
}else{
    header("Location: ../../index.php");
}

?>