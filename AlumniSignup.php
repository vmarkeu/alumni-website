<?php

include("connectdb.php");

$usernamer = $dobr = $sexr = $contactr = $emailr = $courser = $intaker = $graduater = $pwordr = $pword2r = $imager = "";
$errors = array('usernamer' => "", 'dobr' => "", 'sexr' => "", 'contactr' => "", 'emailr' => "", 'courser' => "", 'intaker' => "", 'graduater' => "", 'pwordr' => "", 'pword2r' => "",'imager' => "");

if(isset($_POST['signup'])){
    if(empty($_POST['usernamer'])){
        $errors['usernamer'] = "Full name is required.";
    } else {
        $usernamer = $_POST['usernamer'];
    }

    if(empty($_POST['dobr'])){
        $errors['dobr'] = "Date of birth is required.";
    } else {
        $dobr = $_POST['dobr'];
    }

    if(empty($_POST['sexr'])){
        $errors['sexr'] = "Sex is required.";
    } else {
        $sexr = $_POST['sexr'];
    }

    if (empty($_POST['contactr'])) {
        $errors['contactr'] = "Contact number is required";
    } else {
        $contactr = $_POST['contactr'];
        $regex = "/\+60\d{9,10}/";
        if (!preg_match($regex, $contactr)) {
            $errors['contactr'] = "Please insert a valid contact number. <br> Example: +60123456789, +601234567890";
        }
    }

    if(empty($_POST['emailr'])){
        $errors['emailr'] = "Email is required.";
    } else {
        $emailr = $_POST['emailr'];
        if(!filter_var($emailr, FILTER_VALIDATE_EMAIL)){
            $errors['emailr'] = "Please insert a valid email. Example: email@gmail.com";
        }
    }

    if(empty($_POST['courser'])){
        $errors['courser'] = "Course studied is required.";
    } else {
        $courser = $_POST['courser'];
    }

    if(empty($_POST['intaker'])){
        $errors['intaker'] = "Intake year is required.";
    } else {
        $intaker = $_POST['intaker'];
    }

    if(empty($_POST['graduater'])){
        $errors['graduater'] = "Graduate year is required.";
    } else {
        $graduater = $_POST['graduater'];
    }

    if(empty($_POST['pwordr'])){
        $errors['pwordr'] = "Password is required.";
    } else{ 
        $pwordr = $_POST['pwordr'];
        $regex = "/\w{5,10}/";
        if(!preg_match($regex, $pwordr)){
            $errors['pwordr'] = "Please insert a valid password. <br> Password should consist of at least 5 to 10 alphanumeric.";
        }
    }

    if(empty($_POST['pword2r'])){
        $errors['pword2r'] = "Password comfirmation is required.";
    } else{ 
        $pword2r = $_POST['pword2r'];
        if($pwordr != $pword2r){
            $errors['pword2r'] = "The password is not same as above. Please try again.";
        }
    }

    if (isset($_FILES['imager'])){

        $target_dir = 'profile/';
        $image_path = $target_dir . basename($_FILES['imager']['name']);

        if (!empty($_FILES['imager']['tmp_name']) && getimagesize($_FILES['imager']['tmp_name'])){
            if (file_exists($image_path)) {
                $errors['imager'] = "Image already exists, please choose another or rename that image.";
            } else if ($_FILES['imager']['size'] > 50000000) {
                $errors['imager'] = "Image file size too large, please choose an image less than 500kb.";
            } else {
                move_uploaded_file($_FILES['imager']['tmp_name'], $image_path);


            }

        } else {
            $errors['imager'] = 'Please upload an image.';
        }
    }
    if(!array_filter($errors)){

        //create sql
        $usernamer = mysqli_real_escape_string($conn, $_POST['usernamer']);
        $dobr = mysqli_real_escape_string($conn, $_POST['dobr']);
        $sexer = mysqli_real_escape_string($conn, $_POST['sexr']);
        $contactr = mysqli_real_escape_string($conn, $_POST['contactr']);
        $emailr = mysqli_real_escape_string($conn, $_POST['emailr']);
        $courser = mysqli_real_escape_string($conn, $_POST['courser']);
        $intaker = mysqli_real_escape_string($conn, $_POST['intaker']);
        $graduater = mysqli_real_escape_string($conn, $_POST['graduater']);
        $pwordr = mysqli_real_escape_string($conn, $_POST['pwordr']);

        $sql = "INSERT INTO register(alumni_namer, dobr, sexr, contactr, emailr, courser, intaker, graduater, passwordr, profile_picr) VALUES('$usernamer', '$dobr',  '$sexr',  '$contactr', '$emailr', '$courser', '$intaker', '$graduater', '$pwordr', '$image_path')";

        //save to db and check
        if(mysqli_query($conn, $sql)){
            //success
            echo "<script> location.href='WaitingPage.php'; </script>";
        } else {
            //error
            echo '<script type="text/javascript"> window.onload=function(){alert("Sign Up Failed!");} </script>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" href="mainstyles.css">
        <link rel="icon" type="image/png" href="pics/moon.png">
        <title>Alumni Sign-Up | Moonway University</title>
        <style>
            body{
                display: block;
                margin-left: auto;
                margin-right: auto;

                background-image: url(pics/subg.jpg);
                background-size: 103% 314%;
                background-repeat: no-repeat;
                background-position: cover;
                margin:0;
                padding:0;
                opacity: 0.9;
            }

            body, html{
                width: 100%;
                height: 100%;
                margin: 0;
            }

            *{
                box-sizing: border-box;
                padding-bottom: 1px;
            }

            .form{ 
                background-color: rgba(246, 238, 235, 0.1); 
                padding-top: 20px;
                margin: 140px 500px 100px 440px;
                width: 45%;
                height: 70%;
                color: white;
                border-radius: 30px;
            }

            input[type=text], input[type=password], input[type=date], input[type=number], .datalist{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-sizing: border-box;
            }

            input[type=file]{
                padding: 12px 20px;
                margin: 8px 0;
            }

            input[type=submit], button{
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                font-weight: bold;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                width: 100%;
            }

            input[type=submit]:hover, button:hover{
                background-color: rgba(255, 255, 255, 0.5);
                color: black;
            }

            .button{
                width: auto;
                padding: 10px 18px;
            }

            .container1{
                margin-top: 5px;
                margin-bottom: 0px;
                text-align: center;
            }

            .container{
                margin: 20px;
                padding: 16px;
                width: 90%;
            }

            a{
                color: white;
            }

            a:hover{
                color: red;
                text-decoration: underline;
            }

            a:link{
                text-decoration: none;
            }

            .div{
                color: yellow;
                font-style: italic;
            }

            fieldset {
                border: none;
                margin-left: 20px;
            }
            
            legend {
                font-size: 1.3em;
                font-weight: bold;
            }
            
            .number {
                background-color: rgba(0, 0, 0, 0.5);
                color: white;
                height: 30px;
                width: 30px;
                display: inline-block;
                font-size: 0.8em;
                margin-right: 10px;
                line-height: 30px;
                text-align: center;
                border-radius: 100%;
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        <div class="bg">
            <div class="form">
                    <div class="container1">
                        <img src="pics/MoonwayAlumniMoon.png" alt="Moonway Alumni" class="avatar">
                        <h1>Registration Form</h1>
                    </div>

                    <div class="container">
                        <form action="AlumniSignup.php" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <legend><span class="number">1</span>Alumni Basic Info</legend>
                                
                                <br>

                                <label for="usernamer"><b>Full Name</b></label>
                                <input type="text" placeholder="Enter your Full Name" name="usernamer" value=<?php echo $usernamer?>></input>
                                <div class="div"><?php echo $errors['usernamer']?></div>

                                <br><br>

                                <label for="dobr"><b>Date of Birth</b></label><br>
                                <input type="date" id="age" name="dobr" value=<?php echo $dobr?>></input>
                                <div class="div"><?php echo $errors['dobr']?></div>

                                <br><br>

                                <label for="sexr"><b>Sex</b></label><br>
                                <input list="sex" placeholder="Choose your Sex" name="sexr" class="datalist" value=<?php echo $sexr?>></input>
                                <datalist id="sex">
                                    <option value="Male"></option>
                                    <option value="Female"></option>
                                </datalist>
                                <div class="div"><?php echo $errors['sexr']?></div>

                                <br><br>

                                <label for="contactr"><b>Contact Number</b></label>
                                <input type="text" placeholder="Enter your Contact Number" name="contactr" value=<?php echo $contactr?>></input>
                                <div class="div"><?php echo $errors['contactr']?></div>

                                <br><br>

                                <label for="emailr"><b>Email</b></label>
                                <input type="text" placeholder="Enter your Email" name="emailr" value=<?php echo $emailr?>></input>
                                <div class="div"><?php echo $errors['emailr']?></div>

                                <br><br>

                                <legend><span class="number">2</span>Alumni Course Info</legend>
                                
                                <br>

                                <label for="courser"><b>Course Studied</b></label><br>
                                <input list="course" placeholder="Choose your Course Studied" name="courser" class="datalist" value=<?php echo $courser?>></input>
                                <datalist id="course">
                                    <option value="Degree in Accounting"></option>
                                    <option value="Degree in Business Administration"></option>
                                    <option value="Degree in Computer Science"></option>
                                    <option value="Degree in Information Technology"></option>
                                    <option value="Diploma in Accounting"></option>
                                    <option value="Diploma in Business Administration"></option>
                                    <option value="Diploma in Computer Science"></option>
                                    <option value="Diploma in Information Technology"></option>
                                </datalist>
                                <div class="div"><?php echo $errors['courser']?></div>

                                <br><br>

                                <label for="intaker"><b>Intake Year</b></label><br>
                                <input type="number" name="intaker" placeholder="Select your Intake Year" min="2010" max="2021" value=<?php echo $intaker?>>
                                <div class="div"><?php echo $errors['intaker']?></div>

                                <br><br>

                                <label for="graduater"><b>Graduate Year</b></label>
                                <br>
                                <input type="number" name="graduater" placeholder="Select your Graduate Year" min="2010" max="2021" value=<?php echo $graduater?>>
                                <div class="div"><?php echo $errors['graduater']?></div>

                                <br><br>

                                <legend><span class="number">3</span>Alumni Account Info</legend>
                                
                                <br>

                                <label for="pword"><b>Password</b></label>
                                <input type="password" placeholder="Enter your Password" name="pwordr" value=<?php echo $pwordr?>></input>
                                <div class="div"><?php echo $errors['pwordr']?></div>
                                
                                <br><br>

                                <label for="pword2r"><b>Comfirm Password</b></label>
                                <input type="password" placeholder="Enter your Password again" name="pword2r" value=<?php echo $pword2r?>></input>
                                <div class="div"><?php echo $errors['pword2r']?></div>

                                <br><br>

                                <label for="imager"><b>Profile Picture</b></label><br>
                                <input type="file" name="imager" accept="image/*" id="imager" value=<?php echo $imager?>></input>
                                <div class="div"><?php echo $errors['imager']?></div>
                                
                                <br><br>

                                <input type="submit" name="signup" value="Sign Up"></input>
                            </fiedlset>
                        </form>
                    </div>
                </form>

                <div class="container">
                    <button class="button" onclick="window.location.replace('AlumniLogin.php')">Cancel</button>
                </div>
            </div>
        </div>
    </body>
</html>