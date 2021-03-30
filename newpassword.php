
<?php 
include("connectdb.php");
if(isset($_POST["enter3"]))
{
    $id = $_POST['id'];
    $password = $_POST['password'];
    $cpassword=$_POST['cpassword'];
    if(!empty($_POST['password'])){
        $password = $_POST['password'];
        $regex = "/\w{5,10}/";
        if(preg_match($regex, $password)){
            if($password==$cpassword){
                $sql = "UPDATE alumni SET Alumni_Password='$password' WHERE Alumni_ID='$id'";
                if(mysqli_query($conn, $sql)){
                    //success
                    echo "<script> alert('Updated') </script>";
                    echo "<script> location.href='AlumniLogin.php'; </script>";
                } else {
                    //error
                    echo '<script> alert("Password not updated."); </script>';
                    echo "<script> location.href='newpassword.php'; </script>";
                }
            }
            else{
                echo "<script> alert('Password not same. You Need to Enter Your Email Again.') </script>";
                echo "<script> location.href='AlumniForgetPassword.php'; </script>";
            }
        }
        else{
            echo "<script> alert('Please insert a valid password. Password should consist of at least 5 to 10 alphanumeric.'); </script>";
            echo "<script> location.href='AlumniForgetPassword.php'; </script>";
        }
    }
    else{
        echo '<script> alert("Password need to be enter, if not what you want to use to login??"); </script>';
        echo "<script> location.href='AlumniForgetPassword.php'; </script>";
    }
}
?>

<?php
include("connectdb.php");


if(isset($_POST["enter"]))
{
        $email = $_POST["email"];
        $sql = "SELECT Alumni_Password, Alumni_ID, Email FROM alumni WHERE Email='$email' ";
        $results= mysqli_query($conn,$sql);?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" href="mainstyles.css">
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Change Password | Moonway University</title>
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
                margin-top: 50px;
                text-align: center;
            }

            .search-container input[type=password] {
                padding: 8px 30px;
                margin-top: 3px;
                margin-right: 8px;
                margin-left: 25px;
                font-size: 15px;
                border: none;
                border-radius: 20px;
                text-align: center;
                width:400px;
                opacity:0.6;
            }
            
            .search-container button {
                float:right;
                padding: 8px 15px;
                margin-top: 35px;
                margin-right: 16px;
                background: rgba(164, 113, 163, 0.8);
                font-size: 17px;
                border: none;
                cursor: pointer;
                border-radius: 20px;
                color: white;
            }

            .search-container button:hover {
                background-color: #E68FAC;
                color: white;
            }

            .div{
                color: yellow;
                font-style: italic;
            }

            fieldset{
                margin: 150px 80px;
                height: 380px;
                width: 400px;
                background-color: rgba(224, 176, 255, 0.1);
                border-color: rgba(0, 0, 0, 0);
                border-radius: 20px;
                text-align:center;
            }

            h2{
                font-size:25px;
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
                margin-top: -15px;
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
    <?php if (mysqli_num_rows($results)>0){ 
        while($row = mysqli_fetch_array($results))
            { ?>

        <form action="newpassword.php" method="POST">
            <center><fieldset>
            <div class="search-container">
                <h2>Enter Your New Password</h2>
                <input type="password" placeholder="New Password" name="password"></input>
                
            </div>

            <div class="search-container">
                <h2>Confirm Your New Password</h2>
                <input type="password" placeholder="Confirm Password" name="cpassword" ></input>
                <input type="hidden" name="id" value=<?php echo $row['Alumni_ID']?>"/>      
               
                <button class="search" type="submit" name="enter3">Enter</button>
            </div>
            </fieldset></center>
        </form>

        <button class="backbutton" onclick="window.location.replace('AlumniForgetPassword.php')">Back to Previous Page</button>
    </body>
</html>

<?php
            }
        }
        else{
            echo '<script> alert("Email NOT FOUND, Please try again."); </script>';
            echo "<script> location.href='AlumniForgetPassword.php'; </script>";
                exit;
        }
}
?>