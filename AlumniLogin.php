<?php
include("connectdb.php");
session_start();
if(isset($_POST["login"]))
{
    $id = $_POST["userid"];
    $pword = $_POST["pword2"];
    $sql = "SELECT Alumni_Password, Alumni_ID, Email, Alumni_Name, Profile_Pic, DOB, Sex, Contact, Course, Intake, Graduate FROM alumni WHERE Alumni_ID='$id' or Email='$id' or Alumni_Name='$id' ";
    $sql2 = "SELECT Alumni_Password, Alumni_ID, Email, Alumni_Name, Profile_Pic, DOB, Sex, Contact, Course, Intake, Graduate FROM alumni WHERE Alumni_Password='$pword'";
    
    $results = mysqli_query($conn, $sql);
    $results2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_array($results);
    $row2 = mysqli_fetch_array($results2);
    if (mysqli_num_rows($results) > 0 and mysqli_num_rows($results2) > 0)
    {
        if ($row["Alumni_Password"] == $row2["Alumni_Password"]){
            $_SESSION['userid'] = $row["Alumni_ID"];
            $_SESSION['username'] = $row["Alumni_Name"];
            $_SESSION['userdob'] = $row["DOB"];
            $_SESSION['usersex'] = $row["Sex"];
            $_SESSION['usercontact'] = $row["Contact"];
            $_SESSION['useremail'] = $row["Email"];
            $_SESSION['usercourse'] = $row["Course"];
            $_SESSION['userintake'] = $row["Intake"];
            $_SESSION['usergraduate'] = $row["Graduate"];
            $_SESSION['userimage'] = $row["Profile_Pic"];

            echo "<script> location.href='AlumniAnnouncementBoard.php'; </script>";
            exit;
            
        } else {
            echo '<script type="text/javascript"> window.onload=function(){alert("Invalid ID/Name/Email or Password!");} </script>';
        }    
    } else {
        echo '<script type="text/javascript"> window.onload=function(){alert("Invalid ID/Name/Email or Password!");} </script>';
    }    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" href="mainstyles.css">
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Alumni Log-In | Moonway University</title>
        <style>
            body{
                color: #e6e6e6;
            }

            body, html{
                width: 100%;
                height: 100%;
                margin: 0;
            }

            .bg{
                /* The image used */
                background-image: url("pics/moon.jpeg");
                opacity: 0.9;

                /* Full height */
                width: 100%; 
                height: 100%;

                /* Center and scale the image nicely */
                float: left;
                background-repeat: no-repeat;
                background-size: cover;
            }

            *{
                box-sizing: border-box;
            }

            .form{ 
                background-color: rgba(246, 238, 235,0.1); 
                padding-top:20px;
                margin:100px 500px 100px 500px;
                width: 40%;
                height: 75%;
                color: black;
                border-radius:5%;
            }

            input[type=text], input[type=password]{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-sizing: border-box;
            }

            input[type=submit], button{
                background-color: rgba(0,0,0,0.6);
                color: white;
                font-weight: bold;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                width: 100%;
            }

            input[type=submit]:hover, button:hover{
                background-color: rgba(255,255,255,0.5);
                color: black;
            }

            .container{
                margin: 20px;
                padding: 16px;
                width: 90%;
            }

            a{
                text-decoration: none;
            }

            /* unvisited link */
            a:link{
                color: black;
            }

            /* visited link */
            a:visited{
                color: black;
            }

            /* mouse over link */
            a:hover{
                color: rgb(255,255,179);
            }
        </style>
    </head>

    <body>
        <div class="bg">
            <div class="form">
                <form action="AlumniLogin.php" method="post">
                    <div class="imgcontainer">
                        <img src="pics/MoonwayAlumniMoon.png" alt="Moonway Alumni" class="avatar">
                    </div>

                    <div class="container">
                        <label for="userid"><b>Alumni ID/Name/Email</b></label>
                        <input type="text" placeholder="Enter here" name="userid">

                        <label for="pword2"><b>Password</b></label>
                        <input type="password" placeholder="Enter here" name="pword2">
                                
                        <input type="submit" name="login" value="Login"></input>
                        <br>
                    </div>
                </form>

                <div class="container">
                    <button class="cancelbtn" onclick="window.location.replace('MainPage.php')">Cancel</button>
                    <div class="link2">
                        <br>
                        <a href="AlumniSignUp.php"><b>Register now</b></a><br>
                        <a href="AlumniForgetPassword.php"><b>Forget Password</b></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>