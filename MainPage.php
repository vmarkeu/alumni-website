<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Main Page | Moonway University</title>
        <style>
            body{
                background-color: #648181;
                display: block;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                width: 100%;

                background-image: url(pics/mountain2.jfif);
                background-size: cover;
                background-repeat: no-repeat;
                background-position: bottom;
                margin:0;
                padding:0;
            }

            .divbutton{
                padding-top: 0px;
                padding-bottom: 15px;
            }

            .button{
                width: 250px;
                height: 50px;
                background-color: rgba(56, 51, 51, 0.5);
                color: white;
                border: 2px white solid;
                cursor: pointer;
            }

            .button:hover{
                width: 250px;
                height: 50px;
                background-color: white;
                color: black;
                transition: color 0.5s;
                cursor: pointer;
            }

            footer{
                bottom: 0;
                width: 100%;
                padding-top: 48px;
                color: white;
                margin-bottom: 30px;
            }
        </style>
    </head>
    
    <body>
        <div style="padding-top: 100px; padding-bottom: 80px;">
            <img src="pics/MoonwayUniversity.png" alt="Moonway University" style="width: 450px; height: 150px;">
        </div>

        <div class="divbutton">
            <button class="button" onclick="window.open('AdminLogin.php', '_self')"><b>Admin</b></button>
        </div>

        <div class="divbutton">
            <button class="button" onclick="window.open('AlumniLogin.php', '_self')"><b>Alumni</b></button>
        </div>
        
        <div style="padding-top: 50px; padding-bottom: 30px;">
            <img src="pics/MoonwayAlumni.png" alt="Moonway Alumni" style="width: 280px; height: 90px;">
        </div>
    </body>

    <footer>
        Moonway Education Group Sdn Bhd
        <br>
        &copy; All Rights Reserved 2021
    </footer>
</html>