<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "filmdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$film_id = $_POST["film_id"];
$titel = $_POST["titel"];
$genre = $_POST["genre"];
$director_naam = $_POST["director_naam"];
$director_voornaam = $_POST["director_voornaam"];
$director_geboortedatum = $_POST["director_geboortedatum"];
$director_id = $_POST["director_id"];
$release_year = $_POST["release_year"];
$beschrijving = $_POST["beschrijving"];

if (isset($_FILES['poster'])) {
    $poster_name = $_FILES['poster']['name'];
    $poster_tmp_name = $_FILES['poster']['tmp_name'];
    $poster_size = $_FILES['poster']['size'];
    $poster_error = $_FILES['poster']['error'];
    

    if (!empty($poster_input)) {
        if ($poster_error === 0) {
            $poster = 'posters/' . $poster_name;
            move_uploaded_file($poster_tmp_name, $poster);
        } else {
            echo "poster: empty." . "<br>";
        }
    } else {
        echo "poster:empty." . "<br>";
    
    }
}
if (!empty($film_id)) {
    $sql = "UPDATE films SET ";
    if (!empty($titel)) {
        $sql .= "titel='$titel', ";
    
    }
    if (!empty($genre)) {
        $sql .= "genre='$genre', ";
    }
    if (!empty($release_year)) {
        $sql .= "release_year='$release_year', ";
    }
    if (!empty($beschrijving)) {
        $sql .= "beschrijving='$beschrijving', ";
    }
    if (!empty($poster)) {
        $sql .= "poster='$poster', ";
    } 
    $sql = rtrim($sql, ', ');
    
    $sql .= " WHERE film_id='$film_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Film updated successfully" . "<br>";
       
    } else {
        echo "Error updating film: " . $conn->error;
    }
} else {
    echo "no film id selected" . "<br>";
}


if (!empty($director_id)) {
    $sql = "UPDATE director SET ";
    if (!empty($director_naam)) {
        $sql .= "director_naam='$director_naam', ";
    }
    if (!empty($director_voornaam)) {
        $sql .= "director_voornaam='$director_voornaam', ";
    }
    if (!empty($director_geboortedatum)) {
        $sql .= "director_geboortedatum='$director_geboortedatum', ";
    }
    $sql = rtrim($sql, ', ');

    $sql .= " WHERE director_id='$director_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Director updated successfully" . "<br>";
    } else {
        echo "error updating director: " . $conn->error;
    }
} else {
    echo "no director id selected";
}