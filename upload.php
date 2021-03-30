<?php

include 'functions.php';

$msg = '';
if (isset($_FILES['image'], $_POST['title'], $_POST['description'])) {
	$target_dir = 'images/';
	$image_path = $target_dir . basename($_FILES['image']['name']);
	if (!empty($_FILES['image']['tmp_name']) && getimagesize($_FILES['image']['tmp_name'])) {
		if (file_exists($image_path)) {
			$msg = 'Image already exists, please choose another or rename that image.';
		} else if ($_FILES['image']['size'] > 50000000) {
			$msg = 'Image file size too large, please choose an image less than 500kb.';
		} else {
			
			move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
		
			$pdo = pdo_connect_mysql();
            
			$stmt = $pdo->prepare('INSERT INTO gallery VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP)');
	        $stmt->execute([$_POST['title'], $_POST['description'], $image_path]);
			//$msg = 'Image uploaded successfully!';
            echo '<script>alert("Image uploaded successfuly!")</script>';
            echo "<script> location.href='AdminGallery.php'; </script>";
		}
	} else {
		$msg = 'Please upload an image!';
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
        <title>Upload Image | Moonway University</title>
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
                margin: 120px 350px 80px 350px;
                background-color: rgba(0, 0, 0, 0.3);
                padding: 55px 80px;
                border-radius: 50px;
                color: white;
            }

            fieldset{
                border: none;
            }

            .text, input[type=file], textarea{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: none;
                border-radius: 15px;
                box-sizing: border-box;
            }

            input[type=submit]{
                background-color: rgba(0,0,0,0.5);
                color: white;
                font-weight: bold;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 15px;
                cursor: pointer;
                width: 100%;
                font-size: 17px;
            }

            input[type=submit]:hover, .backbutton:hover{
                background-color: rgba(255,255,255,0.5);
                color: black;
            }

            label{
                font-size: 25px;
                font-weight: bold;
            }

            .backbutton{
                color: white;
                font-weight: bold;
                font-size: 15px;
                background-color: rgba(0, 0, 0, 0.5);
                border: none;
                border-radius: 35px;
                cursor: pointer;
                padding: 10px 20px;
                margin-left: 565px;
            }

            #image-preview{
                display:none;
                width : 250px;
                height : 250px;
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

        <div class="header">Upload Image</div>

        <div class="center">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <label for="image">Choose Image</label>
                    <img id="image-preview" alt="image preview"/>
                    <input type="file" name="image" accept="image/*" id="image" onchange="previewImage();">
                    <br><br>
                    <label for="title">Title</label>
                    <input class="text" type="text" name="title" id="title">
                    <br><br>
                    <label for="description">Description</label>
                    <textarea name="description" id="description"></textarea>
                    <br><br>
                    <input type="submit" value="Upload Image" name="submit">
                    <br><br>
                    <div class="errors" style="text-align: center;"><?php echo $msg?></div>
                    <br><br>
                </fieldset>
            </form>
            
            <button class="backbutton" onclick="window.open('AdminGallery.php', '_self')">Back</button>

            <!--<p><?=$msg?></p>-->
        
            <script>
                function previewImage() {
                    document.getElementById("image-preview").style.display = "block";
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("image").files[0]);

                    oFReader.onload = function(oFREvent) {
                    document.getElementById("image-preview").src = oFREvent.target.result;
                    };
                };
            </script>
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