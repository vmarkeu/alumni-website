<?php
include("connectdb.php");
if(isset($_POST["login"]))
{
    $pword=$_POST["pword"];
    $id=$_POST["adminid"];
    $password=$_POST["pword"];
    $sql= "SELECT Admin_ID,Admin_Password FROM admin_ WHERE Admin_ID='$id' ";
    $sql2= "SELECT Admin_ID,Admin_Password FROM admin_ WHERE Admin_Password='$password' ";
    $results= mysqli_query($conn,$sql);
    $results2= mysqli_query($conn,$sql2);
    if(mysqli_num_rows($results)>0 and mysqli_num_rows($results2)>0){
        $row = mysqli_fetch_array($results);
        $row2 = mysqli_fetch_array($results2);

        if ($row["Admin_Password"]==$row2["Admin_Password"]){
            echo "<script> location.href='AdminAnnouncementBoard.php'; </script>";
            exit;
        } else {
            echo '<script type="text/javascript"> window.onload=function(){alert("Invalid ID or Password!");} </script>';
        }
    } else {
        echo '<script type="text/javascript"> window.onload=function(){alert("Invalid ID or Password!");} </script>';
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
        <title>Admin Log-in | Moonway University</title>
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
                color: white;
            }

            a:hover{
                color: black;
                text-decoration: underline;
            }

            a:link{
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <div class="bg">
            <div class="form">
                <form action="AdminLogin.php" method="post">
                    <div class="imgcontainer">
                        <img src="pics/MoonwayAlumniMoon.png" alt="Moonway Alumni" class="avatar">
                    </div>

                    <div class="container">
                        <label for="adminid"><b>Admin ID</b></label>
                        <input type="text" placeholder="Enter your Admin ID" name="adminid">

                        <label for="pword"><b>Password</b></label>
                        <input type="password" placeholder="Enter your Password" name="pword">
                            
                        <input type="submit" name="login" value="Login"></input>
                        <br>
                    </div>
                </form>

                <div class="container">
                    <button class="cancelbtn" onclick="window.location.replace('MainPage.php')">Cancel</button>
                </div>
            </div>    
        </div>
    </body>
</html>