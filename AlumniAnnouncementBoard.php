<?php

include("connectdb.php"); //include database connection
session_start();

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
                echo '<script>alert("You have subscribed before!")</script>';
                echo "<script> location.href='AlumniAnnouncementBoard.php'; </script>";
            } else {
                $id = $_SESSION['userid'];
                $sql3="UPDATE alumni SET Newsletter = 'yes' WHERE Alumni_ID='$id'";
                if(mysqli_query($conn, $sql3)){
                    echo '<script>alert("Subscribed Successfully!")</script>';
                    echo "<script> location.href='AlumniAnnouncementBoard.php'; </script>";
                } else {
                    echo '<script>alert("Subscribe Failed!")</script>';
                    echo "<script> location.href='AlumniAnnouncementBoard.php'; </script>";
                }
            }
        } else {
            echo '<script>alert("Incorrect Email.")</script>';
            echo "<script> location.href='AlumniAnnouncementBoard.php'; </script>";
        }
    } else {
        echo '<script>alert("Subscribe Failed.")</script>';
        echo "<script> location.href='AlumniAnnouncementBoard.php'; </script>";
    }
}

?>

<?php

//--------------------------save data part ---------------------------

$id = $feedback = "";
$errors1 = array('$id' => "", 'feedback' => "");

if(isset($_POST['submit'])){
    if(empty($_POST['feedback'])){
        $errors1['feedback'] = "You have entered nothing.";
    } else {
        $feedback = $_POST['feedback'];
    }
    
    //<script> alert('You have entered nothing.') </script>

    if(!array_filter($errors1)){
        //create sql
        $id = $_SESSION['userid'];
        $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

        $sql = "INSERT INTO feedback(alumni_id, feedback) VALUES('$id', '$feedback')";

        if(mysqli_query($conn, $sql)){
            //success
            echo '<script type="text/javascript"> window.onload=function(){alert("Thanks for your FEEDBACK");} </script>';
        } else {
            //error
            echo "Query error: " . mysqli_error($conn); //showing the database connection error
        }
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
        <title>Announcement Board | Moonway University</title>
        <style>
            body{
                margin: 0;
                padding: 0;
                background-image: url(pics/beach.jpg);
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

            @media screen and (max-width: 800px) {
                .leftcolumn, .rightcolumn {   
                    width: 100%;
                    padding: 0;
                }
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

            .card input[type=textarea]{
                margin: 10px;
                width: 380px;
                height: 100px;
                border-radius: 10px;
                border: none;
                opacity: 0.5;
            }

            .card button[type=submit]{
                text-align: center;
                padding: 8px 15px;
                margin-top: 8px;
                margin-left: 305px;
                background: #282828;
                font-size: 17px;
                border: none;
                cursor: pointer;
                border-radius: 20px;
                color: white;
            }

            .card button:hover{
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

        <div class="header">Anouncement Board</div>

        <div class="row">
            <div class="leftcolumn">
                <div class="card">
                    <h1 style="padding-left:20px; padding-right:20px;">Graduation Season</h1>
                    <h5 style="padding-left:20px; padding-right:20px;"><em>Moonway Admin, April 1, 2021</em></h5>
                    <div class="fakeimg"><img src="pics/mountain.jfif" alt="Italian Trulli" style="height:400px; border-radius: 40px;"></div>
                    <p style="padding-left:20px; padding-right:20px;">“What we learn with pleasure we never forget.” —Alfred Mercier</p>
                    <p style="text-align: justify; padding-left:20px; padding-right:20px;"> Graduation may look a little different this year – families and friends will gather for a toast remotely from a safe distance as students toss their caps collectively over the video chat. Regardless, graduation will always be a time to celebrate your favorite student’s accomplishments and the exciting things that lay ahead in their futures. As a relative or close friend of the grad, you’ve already done your job of shaping their mind and filling their heart. Now it’s time to take a step back and let them shine.</p>
                </div>
                
                <div class="card">
                    <h1 style="padding-left:20px; padding-right:20px;">Movie Night</h1>
                    <h5 style="padding-left:20px; padding-right:20px;"><em>Moonway Admin, March 31 , 2021</em></h5>
                    <div class="fakeimg"><img src="pics/movienight.jpeg" alt="Italian Trulli" style="height:400px; border-radius: 40px;"></div>
                    <p style="padding-left:20px; padding-right:20px;">"See you at the movies." — Roger Ebert</p>
                    <p style="text-align: justify; padding-left:20px; padding-right:20px;">You don't need to travel very far when you want to go out for date night. With a cozy backyard movie setup, you and your partner can enjoy a romanic and easy-to-put-together evening. All it takes is a good movie projector, screen, throw pillows, and movie nights to get everything just right. </p>
                </div>


                <div class="card">
                    <h1 style="padding-left:20px; padding-right:20px;">Moonway University Open Day</h1>
                    <h5 style="padding-left:20px; padding-right:20px;"><em>Moonway Admin, March 27, 2021</em></h5>
                    <div class="fakeimg"><img src="pics/openday.png" alt="Italian Trulli" style="height:400px; border-radius: 40px;"></div>
                    <p style="padding-left:20px; padding-right:20px;">"You and you alone are the only person that can live the life that writes the story that you were meant to tell. And the world needs your story because the world needs your voice." – Kerri Washington</p>
                    <p style="text-align: justify; padding-left:20px; padding-right:20px;">You have the opportunity to give talks and presentations about the university for the current and future staffs and students. To let the students to discover what university life is like and help them to make the right decisions.</p>
                </div>

                <div class="card">
                    <h1 style="padding-left:20px; padding-right:20px;">Reading Season</h1>
                    <h5 style="padding-left:20px; padding-right:20px;"><em>Moonway Admin, March 22, 2021</em></h5>
                    <div class="fakeimg"><img src="pics/collegeact.jpg" alt="Italian Trulli" style="height:400px; border-radius: 40px;"></div>
                    <p style="padding-left:20px; padding-right:20px;">“Never trust anyone who has not brought a book with them.” – Lemony Snicket</p>
                    <p style="text-align: justify; padding-left:20px; padding-right:20px;">You may ask, what book quotes have to do with the ebook site. Ebook sites are still mostly focused on the issues related to technology rather than pleasures of reading.<br><br>We believe that a reader has to learn only as much technology as it’s needed to fully enjoy the magic of reading. Reading in times of digital content is changing, but it doesn’t mean it gives less pleasure. Just the opposite.</p>
                </div>
            </div>

            <div class="rightcolumn">
                <div class="card">
                    <h1 style="text-align: center;">About Us</h1>
                    <div class="fakeimg"><img src="pics/moonway.png" alt="Italian Trulli" style="height:80px;"></div>
                    <p style="text-align: justify; padding-left:20px; padding-right:20px;">The Moonway Alumni Relations team looks after all aspects of the institution's relations with its former students and fully concentrates on alumni issues. We provide valuable benefits and programmes that allow our alumni to stay connected with their alma mater. As an independent unit in Student LIFE Centre, we cultivate a mutually beneficial relationship with and among current and future Moonway alumni worldwide. In all that we do, we believe in the importance of education and are fully committed in providing excellent service with utmost integrity. </p>
                </div>

                <div class="card">
                    <h2 style="text-align: center;">Other Events</h2>
                        <br>
                        <div style="padding-left:20px; padding-right:20px;">
                            <a href="AlumniGallery.php">
                                <img src="pics/college33.jfif" alt="Italian Trulli" style="height:100px;width:360px;border-radius: 15px;">
                            </a>
                        </div><br>

                        <div style="padding-left:20px; padding-right:20px;">
                            <a href="AlumniGallery.php">
                                <img src="pics/college34.jfif" alt="Italian Trulli" style="height:100px;width:360px;border-radius: 15px;">
                            </a>
                        </div><br>

                        <div style="padding-left:20px; padding-right:20px;">
                            <a href="AlumniGallery.php">
                                <img src="pics/college35.jfif" alt="Italian Trulli" style="height:100px;width:360px;border-radius: 15px;">
                            </a>
                        </div>
                </div>

                <div class="card">
                    <h2 style="text-align: center;">Feedback For Us</h2>
                    <form action="AlumniAnnouncementBoard.php" method="post">
                        <p style="padding-left:20px; padding-right:20px; padding-top:10px;">Tell us about your experience with Moonway Alumni.</p>
                        <input type=textarea name="feedback"></input>
                        <div style="text-align: center; color: rgb(255,255,179);"><?php echo $errors1['feedback']?></div>
                        <button type="submit" name="submit">Submit</button>
                    </form>
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
            <p><a href="mailto:moonwayalumni@moonway.edu.my">Email Us</a></p>
            <p><a href="tel:+0312345678">Call Us</a></p>
        </div>

        <div class="footerright">
            <div class="footerbox">
                <form action="AlumniAnnouncementBoard.php" method="POST">
                    <h1>NEWSLETTER</h1>
                    <p>Enter your email to get the latest news</p>
                    <input type="text" placeholder="Enter your email ..." name="email">
                    <button class="search" type="submit" name="subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </footer>
</html>