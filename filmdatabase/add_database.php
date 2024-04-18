<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "filmdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo " M-vies" . "<br>";
}

$film_id = $_POST["film_id"];
$titel = $_POST["titel"];
$genre = $_POST["genre"];
$director_naam = $_POST["director_naam"];
$director_geboortedatum = $_POST["director_geboortedatum"];
$director_voornaam = $_POST["director_voornaam"];
$release_year = $_POST["release_year"];
$beschrijving = $_POST["beschrijving"];

if (isset($_FILES['poster'])) {
    $poster_name = $_FILES['poster']['name'];
    $poster_tmp_name = $_FILES['poster']['tmp_name'];
    $poster_size = $_FILES['poster']['size'];
    $poster_error = $_FILES['poster']['error'];

    if ($poster_error === 0) {
        $poster = 'posters/' . $poster_name;
        move_uploaded_file($poster_tmp_name, $poster);
    } else {
        echo "Error uploading poster." . "<br>";
    }
} else {
    echo "Error getting poster." . "<br>";
}

$sql = "INSERT INTO director (director_naam, director_voornaam, director_geboortedatum) VALUES ('$director_naam', '$director_voornaam', $director_geboortedatum)";
if ($conn->query($sql) === TRUE) {
    $director_id = $conn->insert_id;
    echo "Nieuwe director toegevoegd" . "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    $conn->close();
    exit();
}

$sql = "INSERT INTO films (titel, genre, director_id, release_year, beschrijving, poster) VALUES ('$titel', '$genre', '$director_id', '$release_year', '$beschrijving', '$poster')";
if ($conn->query($sql) === TRUE) {
    echo "Nieuwe film toegevoegd!" . ":" .  "<br>";
    echo "poster file:" . $poster . "<br>";
    echo "Titel: " . $titel . "<br>";
    echo "Director: " . $director_id . "<br>";
    echo "Beschrijving: " . $beschrijving . "<br>";
    echo "Release year: " . $release_year . "<br>";
    $sql_genre = "INSERT INTO genre (genre_name) VALUES ('$genre')";
    if ($conn->query($sql_genre) === TRUE) {
        echo "Genre: " . $genre . "<br>";
    } else {
        echo "could not inserting genre: " . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>