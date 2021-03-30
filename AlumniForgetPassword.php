

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" href="mainstyles.css">
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Forget Password | Moonway University</title>
        <style>
            body{
                margin: 0;
                padding: 0;
                background-image: url(pics/forgetbg.jpeg);
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }

            .search-container {
                margin-top: 280px;
                text-align: center;
            }

            .search-container input[type=text] {
                padding: 8px 30px;
                margin-top: 3px;
                margin-right: 8px;
                margin-left: 25px;
                font-size: 15px;
                border: none;
                border-radius: 20px;
                width:400px;
                height: 20px;
                opacity:0.6;
                text-align: center;
            }
            
            .search-container button {
                text-align: center;
                padding: 8px 15px;
                margin-top: 8px;
                margin-right: 16px;
                background: rgba(255, 193, 203, 0.4);
                font-size: 17px;
                border: none;
                cursor: pointer;
                border-radius: 20px;
                color: white;
            }

            .search-container button:hover {
                background-color: #FFB7C5;
                color: black;
            }

            .div{
                color: yellow;
                font-style: italic;
            }

            h2{
                font-size:50px;
                color:#673146;
            }

            .backbutton{
                background-color: rgba(206, 160, 125, 0);
                float: right;
                color: white;
                font-size: 15px;
                padding: 10px 20px;
                /*margin: 8px 0;*/
                border: none;
                cursor: pointer;
                border-radius: 10px;
                margin-right: 50px;
                margin-top: 250px;
                font-weight: bold;
            }

            .backbutton:hover{
                background-color: rgba(255, 193, 203, 0.4);
                color: white;
                border-radius: 15px;
            }
        </style>
    </head>

    <body>
        <form action="newpassword.php" method="POST">
        <div class="search-container">
            <h2>Enter Your Email</h2>
            <input type="text" placeholder="Enter your email ..." name="email">
            <button class="search" type="submit" name="enter">Enter</button> 
        </div>
        </form>

        <button class="backbutton" onclick="window.location.replace('AlumniLogin.php')">Back to Login Page</button>
    </body>
</html>