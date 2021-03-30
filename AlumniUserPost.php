<?php

include("connectdb.php"); //include database connection
session_start();

//--------------------------save data part ---------------------------

$userid = $content = "";
$errors = array('$userid' => "", 'content' => "");

if(isset($_POST['post'])){
    if(empty($_POST['content'])){
        $errors['content'] = "You have entered nothing.";
    } else {
        $content = $_POST['content'];
    }
    
    //<script> alert('You have entered nothing.') </script>

    if(!array_filter($errors)){
        //create sql
        $userid = $_SESSION['userid'];
        $content = mysqli_real_escape_string($conn, $_POST['content']);

        $sql = "INSERT INTO post(alumni_id, content) VALUES('$userid', '$content')";

        if(mysqli_query($conn, $sql)){
            //success
            header("location:AlumniUserPost.php");
        } else {
            //error
            echo "Query error: " . mysqli_error($conn); //showing the database connection error
        }
    }
}

//---------------------------retrive data part --------------------------

//write query to retrive data

$sql = "SELECT post_id, alumni_name, content, profile_pic FROM post, alumni WHERE post.alumni_id=alumni.alumni_id ORDER BY post.post_id DESC";

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
                echo "<script> location.href='AlumniUserPost.php'; </script>";
            } else {
                $sql3="UPDATE alumni SET Newsletter = 'yes' WHERE Alumni_ID='$id'";
                if(mysqli_query($conn, $sql3)){
                    echo '<script>alert("Subscribed Successfully!")</script>';
                    echo "<script> location.href='AlumniUserPost.php'; </script>";
                } else {
                    echo '<script>alert("Subscribe Failed!")</script>';
                    echo "<script> location.href='AlumniUserPost.php'; </script>";
                }
            }
        } else {
            echo '<script>alert("Incorrect Email.")</script>';
            echo "<script> location.href='AlumniUserPost.php'; </script>";
        }
    } else {
        echo '<script>alert("Subscribe Failed.")</script>';
        echo "<script> location.href='AlumniUserPost.php'; </script>";
    }
}

?>

<?php
//--------------------------------search------------------------------
$errors = array('alumniname' => "");

if(isset($_POST["search"])){

    $_SESSION['searchpostname'] = $_POST["alumniname"];

    if(empty($_POST['alumniname'])){
        $errors['alumniname'] = "Please enter a name.";
    }

    if(!array_filter($errors)){
        echo "<script> location.href='SearchPost.php'; </script>";
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
                margin-bottom: 60px;
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

            .postbutton{
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

            .postbutton:hover{
                background-color: rgba(69,69,69, 0.5);
                color: white;
                transition: color 0.5s;
                cursor: pointer;
            }

            .postbox {
                background-color: rgba(255, 255, 255, 0.4);
                border: none;
                border-radius: 20px;
                color: rgb(255,255,179);
                height: 100px;
                width: 100%;
            }

            .search-container {
                text-align: center;
                margin-bottom: 25px;
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
 
        <div class="header">Alumni Newsfeed</div>


        <div class="row">
            <div class="leftcolumn">
                <div class="card">
                    <div class="post">
                        <img src=<?php echo $_SESSION['userimage']?> alt="Profile Picture" style="width: 60px; height: 60px; float: left;">
                        <h2 style="text-indent: 20px"><?php echo $_SESSION['username']?></h2>
                        <div style="padding-left: 80px; padding-bottom: 20px; text-align: justify;">
                            <form action="AlumniUserPost.php" method="post">
                                <h3 style="color: rgb(255,255,179)"><b>What's on your mind?</b></h3>
                                <br>
                                <input class="postbox" type="text" name="content" value=<?php echo $content?>></input>
                                <br><br>
                                <input class="postbutton" type="submit" name="post" value="Post"></input>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if(mysqli_num_rows($results) > 0){
                    //output data of each row
                    while($row = mysqli_fetch_array($results)){ //fetch the result and store as array
                ?>
                <div class="card">
                    <div class="post">
                        <img src=<?php echo $row["profile_pic"]?> alt="Profile Picture" style="width: 60px; height: 60px; float: left;">
                        <h2 style="text-indent: 20px"><?php echo $row["alumni_name"]?></h2>
                        <p style="font-weight: normal; padding-left: 80px; text-align: justify; color: rgb(255,255,179)">
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
                    <div class="search-container">
                        <form action="AlumniUserPost.php" method="POST">
                            <h1>Search for Alumni Post</h1>
                            <input type="text" placeholder="Search Alumni Name ..." name="alumniname">
                            <button class="search" type="submit" name="search">Search</button>
                            <div class="errors" style="padding-right: 80px;"><?php echo $errors['alumniname']?></div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <h1 style="text-align:center;">About Us</h1>
                    <div class="fakeimg"><img src="pics/moonway.png" alt="Italian Trulli" style="height:80px;"></div>
                    <p style="font-weight: normal; text-align:justify; padding-left:20px; padding-right:20px;">The Moonway Alumni Relations team looks after all aspects of the institution's relations with its former students and fully concentrates on alumni issues. We provide valuable benefits and programmes that allow our alumni to stay connected with their alma mater. As an independent unit in Student LIFE Centre, we cultivate a mutually beneficial relationship with and among current and future Moonway alumni worldwide. In all that we do, we believe in the importance of education and are fully committed in providing excellent service with utmost integrity. </p>
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
                <form action="AlumniUserPost.php" method="POST">
                    <h1>NEWSLETTER</h1>
                    <p>Enter your email to get the latest news</p>
                    <input type="text" placeholder="Enter your email ..." name="email">
                    <button class="search" type="submit" name="subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </footer>
</html>