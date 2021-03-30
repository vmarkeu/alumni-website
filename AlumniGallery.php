<?php

include 'functions.php';
$pdo = pdo_connect_mysql();
$stmt = $pdo->query('SELECT * FROM gallery ORDER BY uploaded_date DESC');
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

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
                echo '<script>alert("You have subscribed!")</script>';
                echo "<script> location.href='AlumniGallery.php'; </script>";
            } else {
                $sql3="UPDATE alumni SET Newsletter = 'yes' WHERE Alumni_ID='$id'";
                if(mysqli_query($conn, $sql3)){
                    echo '<script>alert("Subscribed Successfully!")</script>';
                    echo "<script> location.href='AlumniGallery.php'; </script>";
                } else {
                    echo '<script>alert("Subscribe Failed!")</script>';
                    echo "<script> location.href='AlumniGallery.php'; </script>";
                }
            }
        } else {
            echo '<script>alert("Incorrect Email.")</script>';
            echo "<script> location.href='AlumniGallery.php'; </script>";
        }
    } else {
        echo '<script>alert("Subscribe Failed.")</script>';
        echo "<script> location.href='AlumniGallery.php'; </script>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="mainstyles.css">
        <link rel="stylesheet" href="AdminGalleryStyle.css">
        <script type="text/javascript" src="mainscript.js"></script>
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Gallery | Moonway University</title>
        <style>
            body{
                margin: 0;
                padding: 0;
                background-image: url(pics/pool.jpg);
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

            .header{
                color: white;
                text-shadow: 1px 1px black;
                text-align: center;
                font-size: 4em;
                font-weight: bold;
                margin-top: 120px;
                margin-bottom: 120px;
            }

            .mySlides{
                display: none;
            }

            /* Slideshow container */
            .slideshow-container {
                max-width: 1000px;
                position: relative;
                margin: auto;
            }

            /* Next & previous buttons */
            .prev, .next {
                cursor: pointer;
                position: absolute;
                top: 50%;
                width: auto;
                padding: 16px;
                margin-top: -22px;
                color: white;
                font-weight: bold;
                font-size: 18px;
                transition: 0.6s ease;
                border-radius: 0 3px 3px 0;
            }
            
            /* Position the "next button" to the right */
            .next {
                right: 0;
                border-radius: 3px 0 0 3px;
            }
            
            /* On hover, add a black background color with a little bit see-through */
            .prev:hover, .next:hover {
                background-color: rgba(0,0,0,0.8);
            }

            /* Caption text */
            .text {
                color: #f2f2f2;
                font-size: 15px;
                padding: 8px 12px;
                position: absolute;
                bottom: 8px;
                width: 100%;
                text-align: center;
            }

            /* The dots/bullets/indicators */
            .dot {
                cursor:pointer;
                height: 13px;
                width: 13px;
                margin: 0 2px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
                transition: color 0.6s ease;
                margin-bottom: 150px;
            }
            
            .active, .dot:hover {
                background-color: #717171;
            }
            
            /* Fading animation */
            .fade {
                -webkit-animation-name: fade;
                -webkit-animation-duration: 4.5s;
                animation-name: fade;
                animation-duration: 4.5s;
            }
            
            @-webkit-keyframes fade {
                from {opacity: .6}
                to {opacity: 1}
            }
            
            @keyframes fade {
                from {opacity: .6}
                to {opacity: 1}
            }
            
            /* On smaller screens, decrease text size */
            @media only screen and (max-width: 300px) {
                .prev, .next,.text {font-size: 11px}
            }

            .img{
                border-radius: 30px;
            }

            .center{
                margin: -100px 220px 80px 220px;
                background-color: rgba(255, 255, 255, 0.1);
                padding: 55px 60px;
                border-radius: 50px;
            }
        </style>
    </head>

    <body>
        <button onclick="topFunction()" id="upBtn" class = "upBtn "title="Go to top">Top</button>

        <div class="flex-container">
            <div class="nav">
                <img src="pics/MoonwayAlumniMoon.png" alt="Moonway Alumni" style="width: 180px; height: 80px;">
            </div>
            
            <div class="main1">
                <button class="button" onclick="window.open('AlumniAnnouncementBoard.php', '_self')">Announcement Board</button>
                <button class="button" onclick="window.open('AlumniGallery.php', '_self')">Gallery</button>
                <button class="button" onclick="window.open('FindFriend.php', '_self')">Find Friend</button>
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

        <div class="header">Gallery</div>

        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="background/background1.jpg" style="width:100%;" class="img">
                <div class="text">Caption Text</div>
            </div>
            
            <div class="mySlides fade">
                <img src="background/background2.jpg" style="width:100%" class="img">
                <div class="text">Caption Two</div>
            </div>
           
            <div class="mySlides fade">
                <img src="background/background3.jpg" style="width:100%" class="img">
                <div class="text">Caption Three</div>
            </div>
        
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        
        <br>
        
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    
        <div class="center">
            <div class="content home">
                <div class="images">
                    <?php foreach ($images as $image): ?>
                    <?php if (file_exists($image['path'])): ?>
                    <a href="#">
                        <img src="<?=$image['path']?>" alt="<?=$image['description']?>" data-id="<?=$image['id']?>" data-title="<?=$image['title']?>" width="300" height="200">
                        <span><?=$image['description']?></span>
                    </a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="image-popup">
                <script>
                    let image_popup = document.querySelector('.image-popup');
                    document.querySelectorAll('.images a').forEach(img_link =>{
                        
                        img_link.onclick = e => {
                        e.preventDefault();
                        let img_meta = img_link.querySelector('img');
                        let img = new Image();
                        img.onload = () => {
                            image_popup.innerHTML = `
                                <div class="con">
                                    <h3>${img_meta.dataset.title}</h3>
                                    <p>${img_meta.alt}</p>
                                    <img src="${img.src}" width="540px" height="420px">
                                </div>
                            `;
                            
                            image_popup.style.display = 'flex';
                        };
                
                            img.src = img_meta.src;
                        };
                    });
                            image_popup.onclick = e => {
                                if (e.target.className == 'image-popup') {
                                    image_popup.style.display = "none";
                                }
                    };
                </script>

                <script>
                    var slideIndex = 1;
                    showSlidesByClick(slideIndex);
                    function showSlidesByClick(n) {
                        var i;
                        var slides = document.getElementsByClassName("mySlides");

                        var dots = document.getElementsByClassName("dot");
                        if (n > slides.length) {slideIndex = 1}
                        if (n < 1) {slideIndex = slides.length}
                        
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        
                        slides[slideIndex-1].style.display = "block";
                        dots[slideIndex-1].className += " active";
                    }
                    
                    // Next Image
                    function plusSlides(n) {
                        showSlidesByClick(slideIndex += n);
                    }
                    
                    // Previous Image
                    function currentSlide(n) {
                        showSlidesByClick(slideIndex = n);
                    }
                    
                    // Auto Slideshow
                    showSlides();
                    function showSlides() {
                        slideIndex++;
                        //slides[slideIndex-1].style.display = "block";
                        showSlidesByClick(slideIndex);
                        setTimeout(showSlides, 4000); // Change image every 4 seconds
                    }
                </script>
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
                <form action="AlumniGallery.php" method="POST">
                    <h1>NEWSLETTER</h1>
                    <p>Enter your email to get the latest news</p>
                    <input type="text" placeholder="Enter your email ..." name="email">
                    <button class="search" type="submit" name="subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </footer>
</html>