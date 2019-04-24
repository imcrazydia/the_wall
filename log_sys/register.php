<?php
session_start();

// Include config file
require_once "../config/config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";
$default_pic = "prof_pic_uploads/default.png";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    //Validate Email
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if(!$email){
    // Ongeldige email
    $email_err = 'Please enter a email address.';
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, verificatie_code, email, user_pic) VALUES (:username, :password, :verificatie_code, :email, :user_pic)";

        if($stmt = $pdo->prepare($sql)){
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_profPic = $default_pic;
            $random_bytes = bin2hex(random_bytes(32));
            $param_verificatie = hash('md5', $random_bytes);

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":user_pic", $param_profPic, PDO::PARAM_STR);
            $stmt->bindParam(":verificatie_code", $param_verificatie, PDO::PARAM_STR);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                //header("location: login.php");

            $verify_link = 'http://25682.hosts2.ma-cloud.nl/bewijzenmap/periode1.3/proj/the_wall/log_sys/verify.php?code=' . $param_verificatie . '&e=' . $_POST['email'];

            $email_to = $_POST['email'];
            $email_from = '25682@ma-web.nl';
            $subject = 'Verificatie The Wall';

            // Hier maken we een heel kort email bericht
            $message = 'Beste ' . $_POST['username'] . ', ' . "\n" . 'Iemand gebruikt dit email address om in te loggen op onze site,'
            . "\n" . 'als u dit bent klik op deze link om je account te bevestigen: ' . "\n" .  $verify_link ;

            // Het afzender en reply-to adres moeten we in een speciale $headers string zetten
            $headers = 'From:' .  $email_from . "\r\n";
            $headers .= 'Reply-To:' .  $email_from . "\r\n";

            $result = mail (
             $email_to,
             $subject,
             $message,
             $headers
            );

            if(!$result){
             echo 'Er ging iets fout bij het versturen van de verificatie e-mail';
             exit;
            } else{
             echo '<h2>Klik de link in de verificatie email om je account te bevestigen</h2>';
             exit;
            }

            } else{
                echo "Something went wrong. Please try again later.";
                echo '<a href="register.php">Back</a>';
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Diaquino Fortmeier, MD1A">
    <link rel="icon" type="image/jpeg" href="../img/image.png">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../css/register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
      <img id="logo" src="../img/image.png" alt="logo" style="width: 110px;">
      <br>
      <h3 id="logoText"><b>Social Direct Messages</b></h3>
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
    <script> history.forward(); </script>
</body>
</html>
