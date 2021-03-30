<?php

include("connectdb.php");

//---------------------------retrive data part --------------------------

//write query to retrive data

$sql = "SELECT alumni_namer FROM register WHERE alumni_idr=(SELECT max(alumni_idr) FROM register)";

//make query and get results

$results = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="mainstyles.css">
            <link rel="icon" type="image/png" href="pics/moon.png">
            <title>Waiting Page | Moonway University</title>
            <style>
                body, html {
                    width: 100%;
                    height: 100%;
                    margin: 0;
                }

                .bg {
                    /* The image used */
                    background-image: url("pics/wpbg.jpg");
                    opacity: 0.8;

                    /* Full height */
                    width: 100%; 
                    height: 100%;

                    /* Center and scale the image nicely */
                    float: left;
                    background-repeat: no-repeat;
                    background-size: cover;
            
                    color: white;
                }


                h2{
                    text-align: center;
                    border: 1px;
                    border-style: none;
                    width: 50%;
                    margin: 50px 350px 0px 350px;
                    padding: 50px;
                    border-radius: 4%;
                    font-size: 30px;
                    font-family: "Roboto";
                    letter-spacing: 2px;
                    line-height: 1.4;
                }

                .imgcontainer {
                    text-align: center;
                    margin: 80px 0px 0px 15px;
                }

                .backbutton{
                    background-color: rgba(206, 160, 125, 0);
                    float: right;
                    color: black;
                    font-size: 15px;
                    padding: 10px 20px;
                    /*margin: 8px 0;*/
                    border: none;
                    cursor: pointer;
                    border-radius: 10px;
                    margin-right: 50px;
                    margin-top: 60px;
                    font-weight: bold;
                }

                .backbutton:hover{
                    background-color: rgba(0, 0, 0, 0.5);
                    color: white;
                    border-radius: 15px;
                }
            </style>
        </head>
    <body>
        <div class="bg">
            <div class="imgcontainer">
                <img src="pics/MoonwayAlumni2.png" alt="unilogo" class="avatar" style="width:400px;height:120px;">
            </div>

            <?php    
                if(mysqli_num_rows($results) > 0){
                    //output data of each row
                    while($row = mysqli_fetch_array($results)){ //fetch the result and store as array
            ?>

            <h2>
                Your registration is successful!
                <br><br>
                Thank you <?php echo $row["alumni_namer"]?> for registering to Moonway Alumni.
                <br><br>
                Your registration will be approved within 24 hours.
            </h2>

            <?php
                    }
                } else {
                    //echo "0 results";
                }
            ?>

            <button class="backbutton" onclick="window.location.replace('AlumniLogin.php')">Back to Login Page</button>
        </div>
        
    </body>
</html>