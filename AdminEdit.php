<?php

include("connectdb.php");
session_start();

if(isset($_POST["Edit"]))
{
    $id=$_POST['alumniid'];
    $sql= "SELECT Alumni_ID, Alumni_Name, DOB, Sex, Contact, Email, Course, Intake, Graduate, Alumni_Password, Profile_Pic FROM alumni WHERE Alumni_ID = '$id'";
    $results= mysqli_query($conn,$sql);
    if (mysqli_num_rows($results)>0){

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="mainstyles.css">
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Edit Alumni Profile | Moonway University</title>
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
                height: 730px;
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
                margin: 10px 170px 80px 200px;
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

            td{
                text-align: center;
            }

            .backbutton{
                background-color: rgba(206, 160, 125, 0);
                float: left;
                color: white;
                padding: 10px 10px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                border-radius:10px;
                font-size: 15px;
            }

            .backbutton:hover{
                background-color: rgba(255, 255, 255, 0.7);
                color: black;
            }

            input[type=text]{
                border: none;
                border-radius: 15px;
                padding: 5px 20px;
                text-align: center;
                color: grey;
                margin-left: 30px;
            }
        </style>
    </head>
    
    <body>
        <button onclick="topFunction()" id="upBtn" class = "content "title="Go to top">Top</button>

        <div class="flex-container">
            <div class="nav">
                <img src="pics/moonwayadmin.png" alt="Moonway Admin" style="width: 120px; height: 49px; padding-top: 16px; padding-left: 25px;">
            </div>
                
            <div class="main3">
                <button class="button" onclick="window.open('AdminAnnouncementBoard.php', '_self')">Announcement Board</button>
                <button class="button" onclick="window.open('AdminGallery.php', '_self')">Gallery</button>
                <button class="button" onclick="window.open('Feedback.php', '_self')">Feedback</button>
                <button class="button" onclick="window.open('AdminUserPost.php', '_self')">Alumni Post</button>
                <button class="button" onclick="window.open('AdminViewUser.php', '_self')">Alumni Profile</button>
                <button class="button" onclick="window.open('Approve.php', '_self')">Register Request</button>
            </div>

            <div class="main2">
                <button class="button2" onclick="window.open('MainPage.php', '_self')">
                    <img src="pics/logout.png" alt="Log Out" style="width: 55px; height: 55px;">
                </button>
            </div>
        </div>

        <?php    
            if(mysqli_num_rows($results) > 0){
                //output data of each row
                while($row = mysqli_fetch_array($results)){ //fetch the result and store as array
        ?>
                
            <div class="center">
                <form action="AdminViewUser.php" method="post">
                    <fieldset>
                        <legend><h1>Registered Alumni Profile</h1></legend>
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
                                        <tr>
                                            <td class="td"><p>Alumni ID</td>
                                            <td>:</td>
                                            <td style="text-indent: 25px;"><input type="hidden" name="id" value="<?php echo $row["Alumni_ID"]?>"><?php echo $row["Alumni_ID"]?></input></td>
                                        </tr>
                                                
                                        <tr>
                                            <td class="td"><p>Name</p></td>
                                            <td>:</td>
                                            <td><input type="text" name="name" value="<?php echo $row["Alumni_Name"]?>"/></td>
                                        </tr>

                                        <tr>
                                            <td class="td"><p>Date of Birth</p></td>
                                            <td>:</td>
                                            <td><input type="text" name="dob" value="<?php echo $row["DOB"]?>"/></td>
                                        </tr>

                                        <tr>
                                            <td class="td"><p>Sex</p></td>
                                            <td>:</td>
                                            <td><input type="text" name="sex" value="<?php echo $row["Sex"]?>"/></td>
                                        </tr>

                                        <tr>
                                            <td class="td"><p>Contact Number</p></td>
                                            <td>:</td>
                                            <td><input type="text" name="contact" value="<?php echo $row["Contact"]?>"/></td>
                                        </tr>
                                                
                                        <tr>
                                            <td class="td"><p>Email</p></td>
                                            <td>:</td>
                                            <td><input type="text" name="email" value="<?php echo $row["Email"]?>"/></td>
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
                                            <td><input class="box" type="text" name="course" value="<?php echo $row["Course"]?>"/></td>
                                        </tr>

                                        <tr>
                                            <td class="td"><p>Intake Year</p></td>
                                            <td>:</td>
                                            <td><input type="text" name="intake" value="<?php echo $row["Intake"]?>"/></td>
                                        </tr>

                                        <tr>
                                            <td class="td"><p>Graduate Year</p></td>
                                            <td>:</td>
                                            <td><input type="text" name="graduate" value="<?php echo $row["Graduate"]?>"/></td>
                                        </tr>

                                        <!--<tr>
                                            <td class="td"><p>Password</p></td>
                                            <td>:</td>
                                            <td><input type="text" name="password" value="<?php echo $row["Alumni_Password"]?>"/></td>
                                        </tr>-->
                                    </table>
                                </div>

                                <br>

                                <button class="backbutton" onclick="window.location.replace('AdminViewUser.php')">Back</button>
                                <input type="submit" name="edit" value="Done" style="margin-right: 20px;"></input>
                            </div>  
                        </fieldset>
                    </form>
                </div>
        
        <?php
                }
            } else {
                echo "0 results";
            }
    }
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
            <p>&nbsp;</p>
            <p><a href="mailto:moonwayalumni@moonway.edu.my">Email Us</a></p>
            <p><a href="tel:+0312345678">Call Us</a></p>
        </div>

        <div class="footerright">
            <h1>LINKS</h1>
            <div class="leftfooter">
                <p><a href="AdminAnnouncementBoard.php">Announcement Board</a></p>
                <p><a href="AdminGallery.php">Gallery</a></p>
                <p><a href="Feedback.php">Feedback</a></p>
            </div>

            <div class="rightfooter">
                <p><a href="AdminUserPost.php">Alumni Post</a></p>
                <p><a href="AdminViewUser.php">Alumni Profile</a></p>
                <p><a href="approve.php">Register Request</a></p>
            </div>
        </div>
    </footer>
</html>