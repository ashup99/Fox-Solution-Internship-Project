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
        $center = $row['center'];
        $course = $row['course'];
        $status = $row['status'];
    }
    if($status == 'yes' || $status == 'Yes') {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>SAdmin-MIS</title>
            <link rel="stylesheet" type="text/css" href="../admin/css/style.css">
            <style>
                .linking{
                    background-color: #ddffff;
                    padding: 7px;
                    text-decoration: none;
                }
                .linking:hover{
                    background-color: blue;
                    color: white;
                }

                input,button,select{
                    padding: 5px;
                    border: 2px solid blue;
                    border-radius: 10px;
                    margin: 2px;
                }
                input[type=submit],button{
                    width: 200px;
                }
                input:hover{
                    background-color: lightblue;
                }
                input[type=submit]:hover{
                    background-color: green;
                    color: white;
                }
                th,td{
                    width: 200px;
                }

                hr{
                    width: 60%;
                }



            </style>
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

        <div align="center" style="background-color: aquamarine;padding: 10px">
            <a href="add.php?addadmin=true" class="linking">Add Admin</a>
            <a href="add.php?updateadmin=true" class="linking">Update Admin</a>
            <a href="add.php?addcenters=true" class="linking">Add Centers</a>
            <a href="add.php?updatecenter=true" class="linking">Update Centers</a>
        </div>


        <?php
        if(!isset($_GET['addadmin']) AND !isset($_GET['updateadmin']) AND !isset($_GET['addcenters'])  AND !isset($_GET['updatecenter'])){
            ?>
                <h2 style="color: red;" align="center">Select One From Top navigation Bar</h2>
            <?php
        }
            if(isset($_GET['addadmin'])){
                $sql = "SELECT eid FROM teachers ORDER BY eid DESC LIMIT 1";
                $sql_q = mysqli_query($conn, $sql);
                $ro = mysqli_fetch_assoc($sql_q);
                $eid_get_from_sql = $ro['eid'];
//                function increment($sid)
//                {
//                    return ++$sid[1];
//                }
//
//                $eid_get_from_sql = preg_replace_callback("|(\d+)|", "increment", $eid_get_from_sql);
                ?>
                <div align="center">
                    <h3>Add Admin</h3>
                    <form method="post">
                        <b>EID:</b> <input type="text" name="username" value="" placeholder="Enter A Username" >
                        <b>First Name:</b> <input type="text" name="fname" placeholder="First Name" required>
                        &nbsp;&nbsp;<b>Last Name:</b> <input type="text" name="lname" placeholder="Last Name" required>
                        <br><b>Email:</b> <input type="email" name="email" placeholder="Email" required>
                        &nbsp;&nbsp;<b>Mobile:</b> <input type="text" name="mobile" placeholder="Mobile" required><br>
                        <b>Address:</b> <input type="text" name="address" placeholder="Address" required>
                        <b>Course:</b> <input type="text" name="course" placeholder="Course" required>
                        &nbsp;&nbsp;<b>City:</b> 
        
          
         
          <?php
                            $sql = "SELECT `city_name` FROM `cities` WHERE `city_state`='maharashtra' ORDER BY `city_name`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="city" name="city" required>
                                                        <option value="">No City Found</option>
                                                    </select>
                                                        <?php }
    else {?>                                            <select class="custom-select d-block w-100" id="city" name="city" required>
                                                        <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['city_name']; ?>"><?php echo $num['city_name']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
 <?php    }?>
           &nbsp;&nbsp;<b>Center:</b> 
        
          
         
          <?php
                            $sql = "SELECT `city_name` FROM `cities` WHERE `city_state`='maharashtra' ORDER BY `city_name`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="center" name="center" required>
                                                        <option value="">No City Found</option>
                                                    </select>
                                                        <?php }
    else {?>                                            <select class="custom-select d-block w-100" id="center" name="center" required>
                                                        <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['city_name']; ?>"><?php echo $num['city_name']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
 <?php    }?>
                                                                                                                                                     
    
          
          
        
                        
                        &nbsp;&nbsp;<b>Pin code:</b> <input type="text" name="postalcode" placeholder="Pin Code" required><br>
                        <b>Date Of Joining:</b> <input type="date" name="dateofjoining" required>
                        <hr width="80%">
                        <br><b>Salary:</b> <input type="text" name="salary" placeholder="Salary Per Month" required>
                        <b>Position:</b> <input type="text" name="position" value="Admin" disabled>
                        <br><br><input type="submit" name="add">
                    </form>
                </div>

            <?php
                if (isset($_POST['add'])) {
                    $eid=$_POST['username'];
                    $te_course=$_POST["course"];
                    $te_fname = $_POST['fname'];
                    $te_lname = $_POST['lname'];
                    $te_email = $_POST['email'];
                    $te_mobile = $_POST['mobile'];
                    $te_address = $_POST['address'];
                    $te_city = $_POST['city'];
                    $te_center=$_POST['center'];
                    $te_pin = $_POST['postalcode'];
                    $te_salary = $_POST['salary'];
                    $te_dateofjoining = $_POST['dateofjoining'];
                    $te_position = 'admin';
                    $sql_get_insert = "INSERT INTO admin(eid, fname, lname, email, mobile, address, city, postalcode, salary, position,  dateofjoining,center,course , status) VALUES ('$eid','$te_fname','$te_lname','$te_email','$te_mobile','$te_address','$te_city','$te_pin','$te_salary','$te_position','$te_dateofjoining','$te_center','$te_course','yes')";
                    echo $sql_get_insert;
                    $sql_get_insert_quary = mysqli_query($conn, $sql_get_insert);
                    $insert_into_users = "INSERT INTO users (username, password, type) VALUES ('$eid','$eid','$te_position')";
                    $insert_into_users_check = mysqli_query($conn,$insert_into_users);
                    if ($sql_get_insert_quary AND $insert_into_users_check) {
                        echo '<script>alert("data success")</script>';
                        echo '<script>location.href="add.php"</script>';
                    } else {
                        echo '<script>alert("Failed Try Again")</script>';
                        echo '<script>location.href="add.php?addadmin=true"</script>';
                    }

                }
               
            }


            if(isset($_GET['updateadmin'])){
                if(isset($_GET['updateadmin']) AND !isset( $_GET['eid'])) {
                    $sql_get_admins = "SELECT * FROM admin WHERE position='admin' ORDER BY eid";
                    $sql_get_admins_query = mysqli_query($conn, $sql_get_admins);
                    $sql_get_admins_query_check = mysqli_num_fields($sql_get_admins_query);
                    if ($sql_get_admins_query_check > 0) {
                        ?>
                        <div align="center">
                            <h4>All admins Details With Centers</h4>
                            <table border="2">
                                <tr>
                                    <th>Center</th>
                                    <th>Admin(EID)</th>
                                    <th>Admin(Name)</th>
                                    <th>Update Details</th>
                                    <th>Course</th>
                                </tr>
                                <?php while ($get_details = mysqli_fetch_assoc($sql_get_admins_query)) { ?>
                                    <tr align="center">
                                        <td><?php echo $get_details['center'] ?></td>
                                        <td><?php echo $get_details['eid'] ?></td>
                                        <td><?php echo $get_details['fname'] . ' ' . $get_details['lname'] ?></td>
                                        <td><?php echo $get_details['course'] ?></td>
                                        
                                        <td><a href="add.php?updateadmin=true&eid=<?php echo $get_details['eid']; ?>">Update
                                                Details</a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>

                    <?php }
                }
                if(isset($_GET['updateadmin']) AND isset($_GET['eid'])){
                    $get_eid = mysqli_real_escape_string($conn,$_GET['eid']);
                    $get_details_of_admin = "SELECT * FROM admin WHERE eid='$get_eid' AND position='admin'";
                    $get_details_of_admin_query = mysqli_query($conn,$get_details_of_admin);
                    $get_details_of_admin_check = mysqli_num_rows($get_details_of_admin_query);
                    if($get_details_of_admin_check > 0){
                     $admin_details = mysqli_fetch_assoc($get_details_of_admin_query); ?>
                        <div align="center">
                            <h4>Update admin <span style="color: blue;">(<?php echo $get_eid?>)</span> Details</h4>
                            <br>
                            <form method="post">
                                <b>EID: </b><input type="text" name="eid_admin" value="<?php echo $admin_details['eid']; ?>" disabled><br>
                                <b>First Name: </b><input type="text" name="fname_admin" value="<?php echo $admin_details['fname']; ?>" placeholder="Enter Fname" required>
                                <b>Last Name: </b><input type="text" name="lname_admin" value="<?php echo $admin_details['lname']; ?>" placeholder="Enter Lname" required><br>
                                <b>Email: </b><input type="text" name="email_admin" value="<?php echo $admin_details['email']; ?>" placeholder="Enter Email" required>
                                <b>Mobile: </b><input type="text" name="mobile_admin" value="<?php echo $admin_details['mobile']; ?>" placeholder="Enter Mobile Number" required><br>
                                <hr><b>Address: </b><input type="text" name="address_admin" value="<?php echo $admin_details['address']; ?>" placeholder="Enter Address" required >
                                <b>Course: </b><input type="text" name="course_admin" value="<?php echo $admin_details['course']; ?>" placeholder="Enter Course" required>
                                
                                <b>City: </b>
                                <?php
                            $sql = "SELECT `city_name` FROM `cities` WHERE `city_state`='maharashtra' ORDER BY `city_name`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="center" name="city_admin" required>
                                                        <option value="">No City Found</option>
                                                    </select>
                                                        <?php }
    else {?>                                            <select class="custom-select d-block w-100" id="center" name="city_admin" required>
        <option value="<?php echo $admin_details['city'];?>"><?php echo $admin_details['city'];?></option>
                                                                <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['city_name']; ?>"><?php echo $num['city_name']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
 <?php    }?>
                                
                                <b>Pin Code: </b><input type="text" name="pin_admin" value="<?php echo $admin_details['postalcode']; ?>" placeholder="Enter pin code" required><hr>
                                <b>Position: </b><input type="text" name="position_admin" value="<?php echo $admin_details['position']; ?>" disabled required>
                                <b>Salary: </b><input type="text" name="salary_admin" value="<?php echo $admin_details['salary']; ?>" placeholder="Enter Salary" required>
                                <b>Center: </b>  <?php
                            $sql = "SELECT `city_name` FROM `cities` WHERE `city_state`='maharashtra' ORDER BY `city_name`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="center" name="center_admin" required>
                                                        <option value="">No City Found</option>
                                                    </select>
                                                        <?php }
                                                        else {?>                                            <select class="custom-select d-block w-100" id="center" name="center_admin" required disabled>
        <option value="<?php echo $admin_details['center']; ?>"><?php echo $admin_details['center']; ?></option>
                                                                <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['city_name']; ?>"><?php echo $num['city_name']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
                                                        <?php }?>
                                <br><b>Date Of Joining: </b><input type="date" name="date_admin" value="<?php echo $admin_details['dateofjoining']; ?>" disabled>
                                <hr>
                                <br><input type="submit" name="update_admin" value="Update">
                            </form>
                        </div>
                    <?php }

                    if(isset($_POST['update_admin'])){
                        $admin_fname = $_POST['fname_admin'];
                        $admin_lname = $_POST['lname_admin'];
                        $admin_email = $_POST['email_admin'];
                        $admin_mobile = $_POST['mobile_admin'];
                        $admin_address = $_POST['address_admin'];
                        $admin_city = $_POST['city_admin'];
                        $admin_course = $_POST['course_admin'];
                        $admin_pin = $_POST['pin_admin'];
                        $admin_salary = $_POST['salary_admin'];
                        
                        $admin_update = "UPDATE admin SET fname='$admin_fname',lname='$admin_lname',email='$admin_email',mobile='$admin_mobile',address='$admin_address',city='$admin_city',postalcode='$admin_pin',salary='$admin_salary',course='$admin_course' WHERE eid='$get_eid'";
                        $admin_update_q = mysqli_query($conn,$admin_update);
                        if($admin_update_q){
                            echo '<script>alert("Update success")</script>';
                            echo '<script>location.href="add.php"</script>';
                        } else {
                            echo '<script>alert("Update Failed Try Again")</script>';
                            echo '<script>location.href="add.php?addadmin=true"</script>';
                        }
                    }
                }

            }

            if(isset($_GET['addcenters'])){?>

                <div align="center">
                    <h4>Add <span style="color:blue;">Center</span></h4>
                    <span style="color: red;font-size: 20px">## Before adding center You have to add admin ##</span><hr>
                    <form method="post">
                        <b>Center code ( <span style="color: lightslategrey">"City_Name-Center Code"</span>): </b>
                        <input type="text" name="center" placeholder="Enter Center Code" required>
                        <br><b>Location: </b>
                        <?php
                            $sql = "SELECT `city_name` FROM `cities` WHERE `city_state`='maharashtra' ORDER BY `city_name`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="location" name="location" required>
                                                        <option value="">No City Found</option>
                                                    </select>
                                                        <?php }
                                                        else {?>                                            <select class="custom-select d-block w-100" id="location" name="location" required>
        
                                                                <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['city_name']; ?>"><?php echo $num['city_name']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
                                                        <?php }?>
                        <b>Admin</b>:<?php
                            $sql = "SELECT DISTINCT eid FROM `admin` WHERE position='admin' ORDER BY `eid`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="admin" name="admin" required>
                                                        <option value="">No Admin Found</option>
                                                    </select>
                                                        <?php }
                                                        else {?>       
                        <select class="custom-select d-block w-100" id="admin" name="admin" required>
        
                                                                <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['eid']; ?>"><?php echo $num['eid']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
                                                        <?php }?>
                        <b>Course</b>:<?php
                            $sql = "SELECT DISTINCT course FROM `admin` WHERE position='admin' ORDER BY `course`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="admin" name="coursee" required>
                                                        <option value="">No Course Found</option>
                                                    </select>
                                                        <?php }
                                                        else {?>       
                        <select class="custom-select d-block w-100" id="admin" name="coursee" required>
        
                                                                <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['course']; ?>"><?php echo $num['course']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
                                                        <?php }?>
                        
                        <b>Date Of Start: </b><input type="date" name="dateoofbuild" placeholder="Enter Date OF Build" required><br>
                        <!--<b>Enter Course<span style="color: red;">*</span> ( <span style="color: lightslategrey">like IIT</span>): </b><input type="text" name="course" placeholder="Enter Course" required><br><span style="color: red; font-size: 10px">* Only One course at a time. For more courses click on add center and add center again.</span>-->
                        <br><input type="submit" name="addcenter"  value="Add Center">
                    </form>

                </div>
           <?php
                if(isset($_POST['addcenter'])){
                    $center_code = mysqli_real_escape_string($conn,$_POST['center']);
                    $center_location = mysqli_real_escape_string($conn,$_POST['location']);
                    $center_date = $_POST['dateoofbuild'];
                    $center_course = $_POST['coursee'];
                    $center_admin=$_POST["admin"];
                    $select_from_centers = "SELECT * FROM centers WHERE center='$center_code' AND location='$center_location' AND coures='$center_course'";
                    $select_from_centers_q = mysqli_query($conn,$select_from_centers );
                    if(mysqli_num_rows($select_from_centers_q) > 0){
                        echo '<script>alert("Center with same course And same location exist")</script>';
                    }else {
                        $checkquery = "SELECT * FROM admin WHERE eid = '$center_admin'";
//                                echo $checkquery;
                                $checkqueryresult = mysqli_query($conn, $checkquery);
                                
                                
                                $row = mysqli_fetch_assoc($checkqueryresult);
                                if($row["course"]==$center_course)
                                {
                                    
                                $insert_into_centers = "INSERT INTO centers(center, location, dateofbuild,coures,admin) VALUES ('$center_code','$center_location','$center_date','$center_course','$center_admin')";
                       echo $insert_into_centers;
                        $insert_into_centers_q = mysqli_query($conn, $insert_into_centers);
                        if ($insert_into_centers_q) {
                            echo '<script>alert("Add success")</script>';
                            echo '<script>location.href="add.php"</script>';
                        } else {
                            echo '<script>alert("Add Failed Try Again")</script>';
                            echo '<script>location.href="add.php?addcenter=true"</script>';
                        }
                                }
                                else 
                                {
                                    echo '<script>alert("Wrong Coourse And Admin Choosen");</script>';
                                    
                                }
                    }
                }

            }

            if(isset($_GET['updatecenter'])){
            if(isset($_GET['updatecenter']) AND !isset($_GET['id'])){?>
                <div align="center">
                    <h3>Update Center</h3>
                    <form method="post">
                        <input type="text" name="centerid" placeholder="Enter Center Code" required/>
                        <input type="submit" name="search" value="search">
                    </form>
                </div>
            <?php }
            if(isset($_POST['search'])){
                $center_id = mysqli_real_escape_string($conn,$_POST['centerid']);
                $sql_select_from_centers = "SELECT * FROM centers WHERE center='$center_id'";
                $sql_select_from_centers_q = mysqli_query($conn,$sql_select_from_centers);
                $sql_select_from_centers_check = mysqli_num_rows($sql_select_from_centers_q);
                if($sql_select_from_centers_check > 0)
                {?>
                    <div align="center">
                        <table border="2px">
                            <tr>
                                <th>Center Id</th>
                                <th>Location</th>
                                <th>Date Of Build</th>
                                <th>Admin</th>
                                <th>Course</th>
                                <th>Update</th>
                            </tr>
                            <?php
                            while($reow = mysqli_fetch_assoc($sql_select_from_centers_q)){
                                ?>
                                <tr>
                                    <td><?php echo $reow['center']?></td>
                                    <td><?php echo $reow['location']?></td>
                                    <td><?php echo $reow['dateofbuild']?></td>
                                    <td><?php echo $reow['admin']?></td>
                                    <td><?php echo $reow['coures']?></td>
                                    <td><a href="add.php?updatecenter=true&id=<?php echo $reow['id']?>">Update</a></td>
                                </tr>
                <?php
                            }
                            ?>
                        </table>
                    </div>
                <?php }else{
                    echo '<h3 style="color: red" align="center">Wrong Center Code Try Again</h3>';
                }
            }
                if(isset($_GET['id']) AND isset($_GET['updatecenter'])){
                    $get_id = (int)$_GET['id'];
                    $sql_select_from_centers = "SELECT * FROM centers WHERE id='$get_id'";
                    $sql_select_from_centers_q = mysqli_query($conn,$sql_select_from_centers);
                    $sql_select_from_centers_check = mysqli_num_rows($sql_select_from_centers_q);
                    if(!$sql_select_from_centers_check>0){
                        echo '<h3>Some thing went Wrong Please Try again</h3>';
                    }else{
                        $new = mysqli_fetch_assoc($sql_select_from_centers_q);
                        $cente_code = $new['center'];
                        ?>
                        <div align="center">
                            <form method="post">
                                <h3>Details Which can Be Updated for <span style="color: blue"><?php echo ucfirst($new['center']);?></span></h3>
                                <b>Center Code: </b><input type="text" name="center" value="<?php echo $new['center']?>" disabled required><br>
                                <b>Center Location: </b><input type="text" name="center_location" value="<?php echo $new['location'] ?>" disabled required><br>
                                <b>Date of Build: </b><input type="date" name="dateofbuild" value="<?php echo $new['dateofbuild']?>" required><br>
                                <b>Course</b>:<?php
                            $sql = "SELECT DISTINCT course FROM `admin` WHERE position='admin' ORDER BY `course`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="admin" name="coursees" required>
                                                        <option value="">No Course Found</option>
                                                    </select>
                                                        <?php }
                                                        else {?>       
                        <select class="custom-select d-block w-100" id="admin" name="coursees" required>
                            <option value="<?php echo $new['coures']?>"><?php echo $new['coures']?></option>
                                                                <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['course']; ?>"><?php echo $num['course']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
                                                        <?php }?>
                        
                        
                                <b>Admin: </b>
                                <?php
                            $sql = "SELECT DISTINCT eid FROM `admin` WHERE position='admin' ORDER BY `eid`";
                                            $resultc = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($resultc) < 1) {
                            ?>
                                                    
                                                    <select class="custom-select d-block w-100" id="admin" name="admin_for" required>
                                                        <option value="">No Admin Found</option>
                                                    </select>
                                                        <?php }
                                                        else {?>       
                        <select class="custom-select d-block w-100" id="admin" name="admin_for" required>
                            <option value="<?php echo $new['admin']; ?>"><?php echo $new['admin']; ?></option>
                                                                <?php while ($num = mysqli_fetch_assoc($resultc)) { ?>
                                                            <option value="<?php echo $num['eid']; ?>"><?php echo $num['eid']; ?></option>
                                                            <?php
                                                        }?>
                                                    </select>
                                                        <?php }?>
                                &nbsp;
                                <br>
                                <input type="submit" name="update_center" value="Update">
                            </form>
                            <a href="add.php?updatecenter=true">Cancel</a>
                        </div>
                    <?php
                        if(isset($_POST['update_center'])){
                            $course_update = mysqli_real_escape_string($conn,$_POST['coursees']);
                            $admin_id = $_POST['admin_for'];
                           
                            $checkquery = "SELECT * FROM admin WHERE eid = '$admin_id'";
//                                echo $checkquery;
                                $checkqueryresult = mysqli_query($conn, $checkquery);
                                
                                
                                $row = mysqli_fetch_assoc($checkqueryresult);
                                if($row["course"]==$course_update)
                                {
                                    
                            $update_centers = "UPDATE centers SET coures='$course_update',admin='$admin_id' WHERE id='$get_id'";
                            $update_centers_q = mysqli_query($conn,$update_centers);
                            $update_tea = "UPDATE admin SET center='$cente_code' WHERE eid='$admin_id'";
                            $update_tea_q = mysqli_query($conn,$update_tea);
                            if($update_centers_q AND $update_tea_q){
                                echo '<script>alert("Update success")</script>';
                                echo '<script>location.href="add.php"</script>';
                            } else {
                                echo '<script>alert("Update Failed Try Again")</script>';
                                echo '<script>location.href="add.php?updatecenter=true"</script>';
                            }
                                }
                                else
                                {
                                    echo '<script>alert("Wrong Coourse And Admin Choosen");</script>';
                                   
                                }
                        }
                    }
                }
        }
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
        <?php
    }
}else{
    header("Location: ../../index.php");
}

?>