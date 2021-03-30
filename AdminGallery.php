<?php

include 'functions.php';

$pdo = pdo_connect_mysql();
$stmt = $pdo->query('SELECT * FROM gallery ORDER BY uploaded_date DESC');
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                margin-bottom: 60px;
            }

            .center{
                margin: -100px 220px 80px 220px;
                background-color: rgba(255, 255, 255, 0.1);
                padding: 55px 60px;
                border-radius: 50px;
            }

            .backbutton{
                color: white;
                font-weight: bold;
                font-size: 25px;
                margin: 60px 220px 150px 220px;
                background-color: rgba(0, 0, 0, 0.5);
                border: none;
                border-radius: 35px;
                cursor: pointer;
                width: 1075px;
                padding: 15px;
            }

            .backbutton:hover {
                background-color: rgba(255,255,255,0.5);
                color: black;
            }
        </style>
    </head>
    
    <body>
        <button onclick="topFunction()" id="upBtn" class = "upBtn "title="Go to top">Top</button>

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

        <div class="header">Gallery</div>
        
        <button class="backbutton" onclick="window.open('upload.php', '_self')">Upload Image</button>

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
                    document.querySelectorAll('.images a').forEach(img_link => {
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
                                        <a href="delete.php?id=${img_meta.dataset.id}" class="DeleteBtn">Delete</a>
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