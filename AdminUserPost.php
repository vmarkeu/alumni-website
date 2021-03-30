<?php

include("connectdb.php"); //include database connection
session_start();

//-------------------------retrive data part --------------------------
//write query to retrive data
$sql = "SELECT post_id, alumni_name, content, profile_pic FROM post, alumni WHERE post.alumni_id=alumni.alumni_id ORDER BY post.post_id DESC";

//make query and get results
$results = mysqli_query($conn, $sql);

?>

<?php

//--------------------------delete data part ---------------------------
if(isset($_POST["delete"]))
{
    $postid = $_POST["postid"];

    $sql1 = "DELETE FROM post WHERE post_id = $postid";
    $results1= mysqli_query($conn, $sql1);
    
    if($results1){
        echo '<script type="text/javascript"> window.onload=function(){alert("Deleted successfuly!");} </script>';
        echo "<script> location.href='AdminUserPost.php'; </script>";
    } else {
        echo '<script type="text/javascript"> window.onload=function(){alert("Failed to detele post.");} </script>';
        echo "<script> location.href='AdminUserPost.php'; </script>";
    }
    
    //header("location:AdminUserPost.php");
}

?>

<?php
//--------------------------retrive post number-------------------------
$result = mysqli_query($conn, "SELECT count(post_id) AS total FROM post");
$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="mainstyles.css">
        <script type="text/javascript" src="mainscript.js"></script>
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Alumni Newsfeed | Moonway University</title>
        <style>
            body{
                margin: 0;
                padding: 0;
                background-image: url(pics/ppbg.jpg);
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

            /* Create two unequal columns that floats next to each other */
            /* Left column */
            .leftcolumn{   
                float: left;
                width: 60%;
                border-radius: 30px;
                margin-left: 50px;
                padding-right: 50px;
                margin-top: 60px;
                margin-bottom: 50px;
            }

            /* Right column */
            .rightcolumn {
                float: left;
                width: 30%;
                padding-left: 20px;
                border-radius: 30px;
                margin-top: 60px;
                margin-bottom: 50px;
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
                background-color: rgba(0, 0, 0, 0.4);
                border-radius: 30px;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            img{
                border-radius: 10%;
            }

            @media screen and (max-width: 800px) {
                .leftcolumn, .rightcolumn {   
                    width: 100%;
                    padding: 0;
                }
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

            .deletebutton{
                background-color: #282828;
                color: white;
                border: #afaed7;
                border-radius: 20px;
                cursor: pointer;
                font-family: "Helvetica";
                float: right;
                padding: 8px 15px;
                font-size: 17px;
            }

            .deletebutton:hover{
                background-color: rgba(69,69,69, 0.5);
                color: white;
                transition: color 0.5s;
                cursor: pointer;
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

        <div class="header">Alumni Newsfeed</div>

        <div class="row">
            <div class="leftcolumn">
                <?php    
                if(mysqli_num_rows($results) > 0){
                    //output data of each row
                    while($row = mysqli_fetch_array($results)){ //fetch the result and store as array
                ?>
                        <div class="card">
                            <div class="post">
                                <img src=<?php echo $row["profile_pic"]?> alt="Profile Picture" style="width: 60px; height: 60px; float: left;">
                                
                                <form action = "AdminUserPost.php" method = "post">
                                    <input style="float: right;" type="hidden" name="postid" value="<?php echo $row["post_id"]?>"></input>
                                    <input class="deletebutton" style="float: right;" type="submit" name="delete" value="Delete"></input>
                                </form>
                                
                                <h2 style="text-indent: 20px"><?php echo $row["alumni_name"]?></h2>
                                
                                <p style="padding-left: 80px; text-align: justify; color: rgb(255,255,179)">
                                    <?php echo $row["content"]?>
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
                            <h2 style="text-align: center;">No alumni post yet.</h2>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

            <div class="rightcolumn">
                <div class="card">
                    <h1 style="text-align: center;">Total Post</h1>
                    <p style="font-size: 5em; text-align: center; margin-top:-15px; margin-bottom:5px;"><?php echo $data['total'] ?></p>
                </div>

                <div class="card">
                    <h1 style="text-align: center;">About Us</h1>
                    <div class="fakeimg"><img src="pics/moonway.png" alt="Italian Trulli" style="height:80px;"></div>
                    <p style="text-align: justify; padding-left:20px; padding-right:20px;">The Moonway Alumni Relations team looks after all aspects of the institution's relations with its former students and fully concentrates on alumni issues. We provide valuable benefits and programmes that allow our alumni to stay connected with their alma mater. As an independent unit in Student LIFE Centre, we cultivate a mutually beneficial relationship with and among current and future Moonway alumni worldwide. In all that we do, we believe in the importance of education and are fully committed in providing excellent service with utmost integrity. </p>
                </div>

                <div class="card">
                    <h2 style="text-align: center;">Other Events</h2>
                        <br>
                        <div style="padding-left:20px; padding-right:20px;">
                            <a href="AdminGallery.php">
                                <img src="pics/college33.jfif" alt="Italian Trulli" style="height:100px;width:360px;border-radius: 15px;">
                            </a>
                        </div><br>

                        <div style="padding-left:20px; padding-right:20px;">
                            <a href="AdminGallery.php">
                                <img src="pics/college34.jfif" alt="Italian Trulli" style="height:100px;width:360px;border-radius: 15px;">
                            </a>
                        </div><br>

                        <div style="padding-left:20px; padding-right:20px;">
                            <a href="AdminGallery.php">
                                <img src="pics/college35.jfif" alt="Italian Trulli" style="height:100px;width:360px;border-radius: 15px;">
                            </a>
                        </div>
                </div>
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