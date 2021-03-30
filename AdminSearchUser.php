<?php

include("connectdb.php");
session_start();

$id = $_SESSION['searchalumniid'];
$sql = "SELECT Alumni_ID, Alumni_Name, DOB, Sex, Contact, Email, Course, Intake, Graduate, Alumni_Password, Profile_Pic FROM alumni WHERE Alumni_ID = '$id'";
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
        <title>Search Profile | Moonway University</title>
        <style>
            body{
                margin:0;
                padding:0;
                background-image: url(pics/abbg.jpg);
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
                margin: 80px;
                height: 730px;
                width: 900px;
                background-color: rgba(255, 255, 255, 0.4);
                border-color: rgba(0, 0, 0, 0);
                border-radius: 20px;
            }

            legend{
                text-align:center;
                color: white;
                font-size: 20px;
            }

            .center{
                margin: 10px 170px 10px 200px;
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
                border-radius:10px;
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
                background-color: rgba(0, 0, 0, 0.3);
                font-size: 18px;
                text-align:left;
                border-radius:10px;
                margin-right:60px;
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
                padding-right: 50px;
                margin-top: 35px;
                margin-bottom: 50px;
            }

            /* Right column */
            .rightcolumn {
                float: right;
                width: 55%;
                padding-left: 20px;
                border-radius: 30px;
                margin-top: 20px;
            }

            .search-container {
                margin-top:10px;
                text-align:center;
            }

            .search-container input[type=text] {
                padding: 6px;
                margin-top: 8px;
                font-size: 17px;
                border: none;
            }
            
            .search-container button {
                text-align:center;
                padding: 6px;
                margin-top: 8px;
                margin-right: 16px;
                background: rgba(206, 160, 125, 0.6);
                font-size: 17px;
                border: none;
                cursor: pointer;
            }

            .search-container button:hover {
                background: #ccc;
            }

            tr{
                color: white;
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
                margin-left: 135px;
            }

            .backbutton:hover{
                background-color: rgba(255, 255, 255, 0.7);
                color: black;
            }

            .number {
                background-color: rgba(0, 0, 0, 0.7);
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
                color: white;
            }

            .td{
                text-align: center;
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

        <?php while($row = mysqli_fetch_array($results))
                {
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
                                <tr>
                                    <td class="td"><p>Alumni ID</p></td>
                                    <td>:</td>
                                    <td><?php echo $row["Alumni_ID"]?></td>
                                </tr>

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
                                    <td class="td"><p>Course Studied</p></td>
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

                        <br>
                
                        <form action="AdminViewUser.php" method="POST">
                            <input style="float: left;" type="submit" name="delete" value="Delete"></input>
                            <input style="float: left;" type="hidden" name="alumniid" value="<?php echo $row["Alumni_ID"]?>"></input>
                        </form>

                        <button class="backbutton" onclick="window.location.replace('AdminViewUser.php')">Back</button>

                        <form action="AdminEdit.php" method="POST" style="padding-right: 60px;">
                            <input style="float: right;" type="submit" name="Edit" value="Edit"></input>
                            <input style="float: left;" type="hidden" name="alumniid" value="<?php echo $row["Alumni_ID"]?>"></input>
                        </form>
                    </div>
                </div>
            </fieldset>
        </div>
        <?php
            }
        } else{
                //echo '<script type="text/javascript"> window.onload=function(){alert("Alumni name is not found!");} </script>';
                //echo "<script> alert('Alumni name is not found!') </script>";
                echo '<script>alert("Alumni ID is not found.")</script>';
                echo "<script> location.href='AdminViewUser.php'; </script>";
        }
        ?> 
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