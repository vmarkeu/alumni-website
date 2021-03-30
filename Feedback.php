<?php

include("connectdb.php"); //include database connection
session_start();

//--------------------------retrive post number-------------------------
$result = mysqli_query($conn, "SELECT count(feedback_id) AS total FROM feedback");
$data = mysqli_fetch_assoc($result);
?>

<?php
//-------------------------retrive data part --------------------------
$sql = "SELECT feedback_id, alumni_name, feedback, profile_pic FROM feedback, alumni WHERE feedback.alumni_id=alumni.alumni_id ORDER BY feedback.feedback_id DESC";
$results = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="mainstyles.css">
        <script type="text/javascript" src="mainscript.js"></script>
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Feedback | Moonway University</title>
        <style>
            body{
                margin: 0;
                padding: 0;
                background-image: url(pics/fbg.jpg);
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

            * {
                box-sizing: border-box;
            }

            .center{
                margin: 10px 170px 80px 200px;
            }

            .total{
                margin: 80px 80px 125px 80px;
                height: 100px;
                width: 900px;
                background-color: rgba(0, 0, 0, 0.4);
                border-color: rgba(0, 0, 0, 0);
                border-radius: 20px;
                color: white;
                text-align: center;
            }

            /* Fake image */
            .fakeimg {
                width: 100%;
                border-radius: 50px;
                text-align: center;
            }

            /* Add a card effect for articles */
            .card {
                color: rgb(255,255,230);
                padding: 20px;
                margin-top: 20px;
                margin-left: 80px;
                background-color: rgba(0, 0, 0, 0.4);
                border-radius: 30px;
                width: 900px;
            }

            img{
                border-radius: 10%;
            }

            /* inside */
            div.post{
                padding: 25px;
            }

            .header{
                color: white;
                text-shadow: 1px 1px black;
                text-align: center;
                font-size: 4em;
                font-weight: bold;
                margin-top: 120px;
                margin-bottom: 60px;
            }

            .left{
                width: 50%;
                float: left;
                margin-left: 30px;
            }

            .right{
                margin-left: 50%;
                font-size: 5em;
                margin-top: -83px;
            }
        </style>
    </head>
    
    <body>
        <button onclick="topFunction()" id="upBtn" class = "content "title="Go to top">Top</button>

        <div class="flex-container">
            <div class="nav">
                <img src="pics/moonwayadmin.png" alt="Moonway Admin" style="width: 145px; height: 65px; padding-top: 16px; padding-left: 25px;">
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

        <div class="header">Feedback</div>

        <div class="center" style="margin-top: 130px;">
            <fieldset class="total">
                <div class="left">
                    <h1>TOTAL &nbsp; FEEDBACK</h1>
                </div>
                <div class="right">
                    <p><?php echo $data['total'] ?></p>
                </div>
            </fieldset>

            <?php    
                if(mysqli_num_rows($results) > 0)
                {
                    while($row = mysqli_fetch_array($results))
                    {
            ?>
                        <div class="card">
                            <div class="post">
                                <img src=<?php echo $row["profile_pic"]?> alt="Profile Picture" style="width: 60px; height: 60px; float: left;">  
                                <h2 style="text-indent: 20px"><?php echo $row["alumni_name"]?></h2>
                                <p style="padding-left: 80px; padding-top: 10px; text-align: justify; color: rgb(255,255,179)">
                                    <?php echo $row["feedback"]?>
                                </p>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    //echo "0 results";
                    ?>

                    <div class="card">
                        <div class="post">
                            <h2 style="text-align: center;">No feedback yet.</h2>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
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