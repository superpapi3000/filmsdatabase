<
Copy code
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "filmdatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $film_id = $_POST["film_id"];
    $select_sql = "SELECT * FROM films WHERE film_id = $film_id";
    $result = $conn->query($select_sql);

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "deleted Record:<br>";
            echo "poster file:" . $row["poster"]. "<br>";
            echo "film ID: " . $row["film_id"]. "<br>";
            echo "titel: " . $row["titel"]. "<br>";
            echo "director: " . $row["director_id"]. "<br>";
            echo "beschrijving: " . $row["beschrijving"]. "<br>";
            echo "genre:" . $row["genre"]. "<br>";
            echo "release year: " . $row["release_year"]. "<br>";

        }

        $delete_sql = "DELETE FROM films WHERE film_id = $film_id";
        if ($conn->query($delete_sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "could not find film id: $film_id";
    }

    $conn->close();
}
?>