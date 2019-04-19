<?php
session_start();

require_once "../config/config.php";

ini_set('display_errors', 1);

// In de superglobal $_GET zitten alle parameters in de url
$verificatie_code = filter_var($_GET['code'], FILTER_SANITIZE_STRING);
$email = filter_var($_GET['e'], FILTER_VALIDATE_EMAIL);

//Als er gegevens missen dan stoppen we met een foutmelding
if(empty($verificatie_code) || empty($email)){
    echo 'Ongeldige gegevens!';
    exit();
}

// Dit doen we met een prepared statement
$sql = 'SELECT * FROM users WHERE verificatie_code = ? AND email = ?';
$statement = $pdo->prepare($sql);

// Een array met voor elk vraagteken in de query een waarde
$data = [
    $verificatie_code,
    $email
];
$result = $statement->execute($data);

if(!$result){
    echo "Fout bij ophalen van gegevens";
    exit();
}

// Haal het eerste resultaat op (de gevonden gebruiker)
$username = $statement->fetch();

// Als $gebruiker leeg is, dan is de link ongeldig OF al gebruikt
if(empty($username)){
    echo 'Ongeldige verificatie link of al gebruikte';
    exit();
}

// Als we tot hier komen is er dus een rij gevonden in de database!
// Nu kunnen we de verificatie code leegmaken en een melding tonen
$users_id = $username['id'];
$sql = 'UPDATE users SET verificatie_code = "" WHERE id = ?';
$statement = $pdo->prepare($sql);

// Op de plek van het vraagteken in de query komt de id van de gebruiker
$data = [
    $users_id
];
$result = $statement->execute($data);

if(!$result){
    echo 'Er ging iets fout bij het opslaan van de gegevens';
    exit();
} else {
  echo '<h2>Verificatie gelukt, je kunt nu <a href="login.php">inloggen</a>.</h2>';
}

session_destroy();
 ?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <title>Verify</title>
   </head>
   <body>
     <script> history.forward(); </script>
   </body>
 </html>
