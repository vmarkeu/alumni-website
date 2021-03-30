
<?php
include("connectdb.php"); //include database connection
session_start();
?>

<?php
if(isset($_POST["viewpost"])){
    echo "<script> location.href='MyPost.php'; </script>";
}
?>

<?php
if(isset($_POST["edit"])){
    echo "<script> location.href='AlumniEdit.php'; </script>";
}
?>

<?php
include("connectdb.php");

if(isset($_POST["Done"]))
{
    $id=$_SESSION['userid'];
    $name=$_POST["name"];
    $dob=$_POST["dob"];
    $sex=$_POST["sex"];
    $contact=$_POST["contact"];
    $email=$_POST["email"];
    $password=$_POST["password"];

    $sql="UPDATE alumni SET Alumni_Name='$name',DOB='$dob',Sex='$sex',Contact='$contact',Email='$email',Alumni_Password='$password' WHERE Alumni_ID='$id'";
    $results= mysqli_query($conn,$sql);
    
    if($results){
    $_SESSION['userid'] = $id;
    $_SESSION['username'] = $name;
    $_SESSION['userdob'] = $dob;
    $_SESSION['usersex'] = $sex;
    $_SESSION['usercontact'] = $contact;
    $_SESSION['useremail'] = $email;
    $_SESSION['password']=$password;
        echo "<script> location.href='OwnProfile.php'; </script>";
    }
    else{
      echo "<script> alert('Update failed, try again') </script>";
      echo "<script> location.href='AlumniEdit.php'; </script>";
    }
}
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
                echo "<script> location.href='OwnProfile.php'; </script>";
            } else {
                $sql3="UPDATE alumni SET Newsletter = 'yes' WHERE Alumni_ID='$id'";
                if(mysqli_query($conn, $sql3)){
                    echo '<script>alert("Subscribed Successfully!")</script>';
                    echo "<script> location.href='OwnProfile.php'; </script>";
                } else {
                    echo '<script>alert("Subscribe Failed!")</script>';
                    echo "<script> location.href='OwnProfile.php'; </script>";
                }
            }
        } else {
            echo '<script>alert("Incorrect Email.")</script>';
            echo "<script> location.href='OwnProfile.php'; </script>";
        }
    } else {
        echo '<script>alert("Subscribe Failed.")</script>';
        echo "<script> location.href='OwnProfile.php'; </script>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="mainstyles.css">
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Own Profile | Moonway University</title>
        <style>
            body{
                margin:0;
                padding:0;
                background-image: url(pics/obg1.jpg);
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

            .fieldset{
                margin: 50px 80px;
                height: 1200px;
                width: 745px;
                background-color: rgba(0, 0, 0, 0.3);
                border-color: rgba(0, 0, 0, 0);
                border-radius: 30px;
            }

            legend{
                text-align: center;
                color: white;
                font-size: 20px;
            }

            .center{
                text-align: center;
                margin-left: 300px;
            }

            .center input[type=submit]{
                background-color: rgba(206, 160, 125, 0);
                float: right;
                color: white;
                font-size: 15px;
                padding: 10px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                border-radius:10px;
            }

            .center input[type=submit]:hover{
                background-color: rgba(255, 255, 255, 0.7);
                color: black;
            }

            .center .chip {
                display: inline-block;
                padding: 10px ;
                margin: 10px;
              
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

            .leftcolumn {   
                float: left;
                width: 45%;
                padding-right: 50px;
                margin-top: 50px;
                margin-left:30px;
            }

            /* Right column */
            .rightcolumn {
                float: right;
                width:45%;
                padding-left: 20px;
                margin-top: 50px;
                margin-right: 30px;
            }

            .card {
                padding: 20px;
                margin-top: 40px;
                margin-left: 30px;
                background-color: rgba(0, 0, 0, 0.7);
                font-size: 18px;
                width: 550px;
                color: white;
                border-color: rgba(0, 0, 0, 0);
                border-radius: 30px;
            }

            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            @media screen and (max-width: 1500px) {
                .center, fieldset, legend {   
                    width: 100%;
                    padding: 0;
                    margin: 0;
                }
            }

            .legend{
                color: white;
                font-size: 1.8em;
                font-weight: bold;
            }

            table{
                color: white;
                margin: 10px 20px;
                width: 600px;
            }

            td{
                padding: 10px;
            }

            .backbutton{
                background-color: rgba(0, 0, 0, 0.7);
                float: center;
                color: white;
                padding: 10px 100px;
                margin-top: 100px;
                border: none;
                cursor: pointer;
                border-radius: 20px;
                font-size: 20px;
                font-weight: bold;
            }

            .backbutton:hover{
                background-color: rgba(255, 255, 255, 0.5);
                color: black;
            }
        </style>
    </head>
    
    <body>
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

        <div class="center">
            <form action="MyFriend.php" method="POST" style="float: left;">
                <button class="backbutton" style="margin-left: 80px;" type="submit" name="viewfriend">View My Followings</button>
            </form>
            <form action="OwnProfile.php" method="POST" style="float: right;">
                <button class="backbutton" style="margin-right: 370px;" type="submit" name="viewpost">View My Posts</button>
            </form>

            <fieldset class="fieldset">
                <legend><h1>Alumni Profile</h1></legend>
                
                <div class="chip">
                    <img src=<?php echo $_SESSION['userimage']?> alt="Profile Picture" width="50" height="96">
                </div>

                <p style="font-size:30px; color:white;"><?php echo $_SESSION['username']?><br></p>

                    <fieldset class="card">
                        <legend class="legend">Alumni Basic Info</legend>
                        <table>
                            <tr class="tr">
                                <td>Alumni ID</td>
                                <td><?php echo $_SESSION['userid']?></td>
                            </tr>

                            <tr>
                                <td>Name</td>
                                <td><?php echo $_SESSION['username']?></td>
                            </tr>

                            <tr>
                                <td>Date of Birth</td>
                                <td><?php echo $_SESSION['userdob']?></td>
                            </tr>

                            <tr>
                                <td>Sex</td>
                                <td><?php echo $_SESSION['usersex']?></td>
                            </tr>

                            <tr>
                                <td>Contact Number</td>
                                <td><?php echo $_SESSION['usercontact']?></td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td><?php echo $_SESSION['useremail']?></td>
                            </tr>
                        </table>
                    </fieldset>
               
                    <fieldset class="card">
                        <legend class="legend">Alumni Course Info</legend>
                        <table>
                            <tr class="tr">
                                <td>Course Studied</td>
                                <td><?php echo $_SESSION['usercourse']?></td>
                            </tr>

                            <tr>
                                <td>Intake Year</td>
                                <td><?php echo $_SESSION['userintake']?></td>
                            </tr>

                            <tr>
                                <td>Graduate Year</td>
                                <td><?php echo $_SESSION['usergraduate']?></td>
                            </tr>
                        </table>
                    </fieldset>
                  
                <br><br>
                
                <form action="OwnProfile.php" method="POST">
                    <input type="submit" name="edit" value="Edit"></input>
                </form>
            </fieldset>
        </div>
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
                <form action="OwnProfile.php" method="POST">
                    <h1>NEWSLETTER</h1>
                    <p>Enter your email to get the latest news</p>
                    <input type="text" placeholder="Enter your email ..." name="email">
                    <button class="search" type="submit" name="subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </footer>
</html>