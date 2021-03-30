<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM gallery WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$image) {
        die ('Image doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            unlink($image['path']);
            $stmt = $pdo->prepare('DELETE FROM gallery WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            echo '<script>alert("Deleted successfuly!")</script>';
            echo "<script> location.href='AdminGallery.php'; </script>";
            //$msg = 'You have deleted the image!';
        } else {
            header('Location: AdminGallery.php');
            exit;
        }
    }
} else {
    die ('No ID specified!');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="mainstyles.css">
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Moonway Gallery | Moonway University</title>
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

            .center{
                margin: 100px 400px 80px 400px;
                background-color: rgba(255, 255, 255, 0.5);
                padding: 55px 20px;
                border-radius: 50px;
                text-align: center;
            }

            .ay, .an{
                border-radius: 10px;
                background-color: rgba(0,0,0,0.5);
                padding: 10px 25px;
                margin: 50px 50px 50px 50px;
                font-weight: bold;
                font-size: 1.1em;
            }

            .ay:hover{
                background-color: darkred;
                color: white;
            }

            .an:hover{
                background-color: darkgreen;
                color: white;
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
        
        <div class="center">
        <div class="content delete">
            <h1>Delete image <?=$image['title']?></h1>
            <?php if ($msg): ?>
            <p><?=$msg?></p>
            <?php else: ?>
            <p style="margin-bottom: 50px;">Are you sure you want to delete <?=$image['title']?>?</p>
            <div class="yesno">
                <a class="ay" href="delete.php?id=<?=$image['id']?>&confirm=yes">Yes</a>
                <a class="an" href="delete.php?id=<?=$image['id']?>&confirm=no">No</a>
            </div>
            <?php endif; ?>
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