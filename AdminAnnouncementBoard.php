<?php

include("connectdb.php");
//--------------------------retrive post number-------------------------
$result = mysqli_query($conn, "SELECT count(alumni_id) AS total FROM alumni");
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
                    <h1 style="text-align: center;">Total Alumni</h1>
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
            <!--
            <p><a href="AdminGallery.php">Gallery</a></p>
            <p><a href="AdminUserPost.php">Alumni Post</a></p>
            <p><a href="AdminViewUser.php">Alumni Profile</a></p>
            <p><a href="approve.php">Register Request</a></p>
            -->
        </div>
    </footer>
</html>