<?php

include("connectdb.php"); //include database connection
session_start();

//-------------------------retrive data part --------------------------
$id = $_SESSION['userid'];
//write query to retrive data
$sql = "SELECT Alumni_ID,Alumni_Name,DOB,Sex,Contact,Email,Course,Intake,Graduate,Alumni_Password,Profile_Pic FROM alumni WHERE alumni.alumni_id != '$id' ORDER BY Alumni_ID ASC";

//make query and get results
$results = mysqli_query($conn, $sql);

?>

<?php

include("connectdb.php"); //include database connection

//---------------------------newsletter--------------------------------
if(isset($_POST['subscribe']))
{
    $id = $_SESSION['userid'];
    $email = $_POST["email"];
    $sql1 = "SELECT Alumni_ID, Email, Newsletter FROM alumni WHERE Alumni_ID = '$id'";
    $sql2 = "SELECT Alumni_ID, Email, Newsletter FROM alumni WHERE Email = '$email'";
    
    $results1 = mysqli_query($conn, $sql1);
    $results2 = mysqli_query($conn, $sql2);
    $row1 = mysqli_fetch_array($results1);
    $row2 = mysqli_fetch_array($results2);

    if (mysqli_num_rows($results1) > 0 and mysqli_num_rows($results2) > 0)
    {
        if ($row1["Email"] == $row2["Email"]){
            if ($row1["Newsletter"] == 'yes'){
                echo '<script>alert("You have subscribed!")</script>';
                echo "<script> location.href='AlumniViewUser.php'; </script>";
            } else {
                $sql3="UPDATE alumni SET Newsletter = 'yes' WHERE Alumni_ID='$id'";
                if(mysqli_query($conn, $sql3)){
                    echo '<script>alert("Subscribed Successfully!")</script>';
                    echo "<script> location.href='AlumniViewUser.php'; </script>";
                } else {
                    echo '<script>alert("Subscribe Failed!")</script>';
                    echo "<script> location.href='AlumniViewUser.php'; </script>";
                }
            }
        } else {
            echo '<script>alert("Incorrect Email.")</script>';
            echo "<script> location.href='AlumniViewUser.php'; </script>";
        }
    } else {
        echo '<script>alert("Subscribe Failed.")</script>';
        echo "<script> location.href='AlumniViewUser.php'; </script>";
    }
}

?>

<?php
//--------------------------------search------------------------------
$errors = array('alumniname' => "");

if(isset($_POST["search"])){

    $_SESSION['searchalumniname'] = $_POST["alumniname"];

    if(empty($_POST['alumniname'])){
        $errors['alumniname'] = "Please enter a name.";
    }

    if(!array_filter($errors)){
        echo "<script> location.href='AlumniSearchUser.php'; </script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="mainstyles.css">
        <script type="text/javascript" src="mainscript.js"></script>
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Alumni Profile | Moonway University</title>
        <style>
             body{
                margin: 0;
                padding: 0;
                background-image: url(pics/abg.jpg);
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .button{
                width: 190px;
                height: 80px;
                background-color: rgba(40,40,40,0);
                color: white;
                padding: 0px;
                border: #282828;
                cursor: pointer;
                font-family: "Helvetica";
                font-size: 1.2em;
                padding-top: -5px;
            }

            .button:hover{
                width: 190px;
                height: 70px;
                background-color: rgb(40,40,40);
                border-radius: 15px;
                transition: color 0.5s;
                cursor: pointer;
            }

            fieldset{
                margin: 30px 80px;
                height: 650px;
                width: 900px;
                background-color: rgba(0, 0, 0, 0.4);
                border-color: rgba(0, 0, 0, 0);
                border-radius: 20px;
            }

            legend{
                text-align: center;
                color: white;
                font-size: 20px;
            }

            .center{
                margin: 10px 170px 100px 200px;
            }

            .center input[type=submit]{
                background-color: rgba(206, 160, 125, 0);
                float: right;
                color: white;
                font-size: 15px;
                padding: 10px 10px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                border-radius: 10px;
                margin-bottom: 20px;
            }

            .center input[type=submit]:hover{
                background-color: rgba(255, 255, 255, 0.7);
                color: black;
            }

            .center .chip {
                padding-bottom: 30px ;
                margin-left: 60px;
              
            }

            .center p{
                margin: 10px ; 
            }

            .center .chip img {
                display: inline-block;
                float: left;
                height: 250px;
                width: 250px;
                border-radius: 50%;
            }

            .card {
                color: black;
                padding: 10px;
                background-color: rgba(255, 255, 255, 0.7);
                font-size: 18px;
                text-align: left;
                border-radius: 10px;
                margin-right: 20px;
            }

            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            .leftcolumn{   
                float: left;
                width: 30%;
                border-radius: 30px;
                margin-top: 30px;
                margin-bottom: 50px;
                margin-left: 30px;
            }

            /* Right column */
            .rightcolumn {
                float: right;
                width: 50%;
                padding-left: 20px;
                border-radius: 30px;
                margin-top: 15px;
            }

            .number {
                background-color: rgba(255, 255, 255, 0.7);
                height: 30px;
                width: 30px;
                display: inline-block;
                font-size: 0.8em;
                margin-right: 10px;
                margin-bottom: 10px;
                line-height: 30px;
                text-align: center;
                border-radius: 100%;
                font-weight: bold;
            }

            .td{
                text-align: center;
            }

            .search-container {
                margin-top: 90px;
                margin-bottom: 70px;
                text-align: center;
            }

            .search-container input[type=text] {
                padding: 8px 30px;
                margin-top: 3px;
                margin-right: 8px;
                margin-left: 25px;
                font-size: 15px;
                border: none;
                border-radius: 20px;
            }
            
            .search-container button {
                text-align: center;
                padding: 8px 15px;
                margin-top: 8px;
                margin-right: 16px;
                background: #282828;
                font-size: 17px;
                border: none;
                cursor: pointer;
                border-radius: 20px;
                color: white;
            }

            .search-container button:hover {
                background-color: rgba(69,69,69, 0.5);
            }

        </style>
    </head>
    
    <body>
        <button onclick="topFunction()" id="upBtn" class = "content "title="Go to top">Top</button>

        <div class="flex-container">
            <div class="nav">
                <img src="pics/MoonwayAlumniMoon.png" alt="Moonway Alumni" style="width: 180px; height: 80px;">
            </div>
            
            <div class="main1">
                <button class="button" onclick="window.open('AlumniAnnouncementBoard.php', '_self')">Announcement Board</button>
                <button class="button" onclick="window.open('AlumniGallery.php', '_self')">Gallery</button>
                <button class="button" onclick="window.open('FindFriend.php', '_self')">Follow</button>
                <button class="button" onclick="window.open('AlumniUserPost.php', '_self')">Alumni Post</button>
                <button class="button" onclick="window.open('AlumniViewUser.php', '_self')">Alumni Profile</button>
                <button class="button" onclick="window.open('OwnProfile.php', '_self')">Own Profile</button>
            </div>

            <div class="main2">
                <button class="button2" onclick="window.open('MainPage.php', '_self')">
                    <img src="pics/logout.png" alt="Log Out" style="width: 55px; height: 55px;">
                </button>
            </div>     
        </div>

        <div class="search-container">
            <form action="AlumniViewUser.php" method="POST">
                <h1 style="color: white;">Search for Alumni</h1>
                <input type="text" placeholder="Search Alumni Name ..." name="alumniname">
                <button class="search" type="submit" name="search">Go</button>
                <div class="errors" style="padding-right: 55px;"><?php echo $errors['alumniname']?></div>
            </form>
        </div>

        <?php    
            if(mysqli_num_rows($results) > 0){
                //output data of each row
                while($row = mysqli_fetch_array($results)){ //fetch the result and store as array
        ?>
                
        <div class="center">
            <fieldset>
                <legend><h1>Alumni Profile</h1></legend>
                <div class="row">
                    <div class="leftcolumn">
                        <div class="chip">
                            <img src=<?php echo $row["Profile_Pic"]?> alt="Profile Picture" width="50" height="96">
                        </div>
                    </div>

                    <div class="rightcolumn">
                        <span class="number">1</span><span style="color: white;">Alumni Basic Info</span>
                        <div class="card">
                            <table>
                                <!--<tr>
                                    <td class="td"><p>ID</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Alumni_ID"]?></td>
                                </tr>-->

                                <tr>
                                    <td class="td"><p>Name</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Alumni_Name"]?></td>
                                </tr>

                                <tr>
                                    <td class="td"><p>Date of Birth</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["DOB"]?></td>
                                </tr>

                                <tr>
                                    <td class="td"><p>Sex</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Sex"]?></td>
                                </tr>

                                <tr>
                                    <td class="td"><p>Contact Number</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Contact"]?></td>
                                </tr>
                                    
                                <tr>
                                    <td class="td"><p>Email</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Email"]?></td>
                                </tr>
                            </table>
                        </div>

                        <br>

                        <span class="number">2</span><span style="color: white;">Alumni Course Info</span>
                        <div class="card">
                            <table>
                                <tr>
                                    <td class="td"><p>Course</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Course"]?></td>
                                </tr>

                                <tr>
                                    <td class="td"><p>Intake Year</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Intake"]?></td>
                                </tr>

                                <tr>
                                    <td class="td"><p>Graduate Year</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Graduate"]?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
                
        <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </body>

    <footer class="footer">
        <div class="footerleft">
            <img src="pics/moonway.png" alt="Moonway Alumni" style="width: 320px; height: 120px;">
            <br><br>
            <p>
                Moonway Education Group Sdn Bhd
                <br>
                &copy; All Rights Reserved 2021
            </p>
        </div>

        <div class="footercenter">
            <h1>CONTACT US</h1>
            <p><a href="mailto:moonwayalumni@moonway.edu.my">Email Us</a></p>
            <p><a href="tel:+0312345678">Call Us</a></p>
        </div>

        <div class="footerright">
            <div class="footerbox">
                <form action="AlumniViewUser.php" method="POST">
                    <h1>NEWSLETTER</h1>
                    <p>Enter your email to get the latest news</p>
                    <input type="text" placeholder="Enter your email ..." name="email">
                    <button class="search" type="submit" name="subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </footer>
</html>