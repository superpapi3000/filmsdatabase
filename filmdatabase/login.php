<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "filmdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Welcome to Movies" . "<br>";
}

session_start();
$naam = $_POST["naam"];
$voornaam = $_POST["voornaam"];
$password = $_POST["password"];
$email = $_POST["email"];

if ($naam === 'admin' &&  $email === "mviesadmin@gmail.com" && $password === 'him' ) {
    $_SESSION['is_admin'] = true;
    $_SESSION['naam'] = $naam;
    $_SESSION["voornaam"] = $voornaam;

    $sql = "INSERT INTO admin (naam, achternaam, email, password) VALUES ('$naam', '$voornaam', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Nieuwe film toegevoegd!" . ":" .  "<br>" ;
        echo $titel .  "<br>" . $genre .  "<br>" . $director.  "<br>" . $releaseYear . "<br>" .$beschrijving ;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: add_database.html');
    exit();
} elseif($naam != 'admin' ||  $email != "mviesadmin@gmail.com" || $password != 'him'){
    $sql = "INSERT INTO user (naam, achternaam, email, password) VALUES ('$naam', '$voornaam', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "User toegevoegd!";
        header('Location: home.html');
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
     echo "guest toegevoegd";
    header('Location: home.html');
    exit(); 
}
$conn->close();
?>
