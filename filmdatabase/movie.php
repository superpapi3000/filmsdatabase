<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "filmdatabase";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$query = "";
if(isset($_GET['query'])) {
    $query = $_GET['query'];
    $result = $conn->query("SELECT * FROM films WHERE titel LIKE '%$query%'");
} else {
    $result = $conn->query("SELECT * FROM films");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="movie.css" type="text/css">
    <title>Film Website</title>
</head>
<body>
    <header>
        <h1>M-VIES</h1>
    </header>
    <nav>
        <a class="link" href="Login.html">login</a>
        <a class="link" href="home.html">Home</a>
        <a class="link" id="current"href="movie.php">Movies</a>
    </nav>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" id="search">
        <button id="back_btn" onclick="back()">go back</button>
        <input type="text" name="query" placeholder="Search movies..." value=""  id="searchbar">
    </form>

    <div id="main">
        <?php
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { 
                echo "<div class='movie'>";
                echo "<h2>{$row['titel']}</h2>";
                echo "<img src='{$row['poster']}' id='image' onclick='playVideo(this)'>";
                echo "<form action='rate_movie.php' method='post' >";
                echo "<input type='hidden' name='film_id' value='{$row['film_id']}'>";
                echo "</form>";
                echo "<p>{$row['beschrijving']}</p>";
                echo "</div>";
            }
        } else {
            echo "No movies found";
        }
        ?>
    </div>

    <footer>
        <p>&copy; M-VIES. All rights reserved.</p>
    </footer>
    <script>
    function back() {
      window.history.back();
    }
     function playVideo(element) {
        var videoPath = 'buffer.mp4';
        var player = document.createElement('div');
        player.id='player';

        var video = document.createElement('video');
        video.setAttribute('controls', '');
        video.id='video';
        video.innerHTML = "<source src='" + videoPath + "' type='video/mp4'>";

        var button = document.createElement('button');
        button.textContent = 'close';
        button.id='close';
        button.addEventListener('click', function() {
            player.remove();
        });

        player.appendChild(video);
        player.appendChild(button);

        document.body.appendChild(player);

        video.play();
    }
  </script>
</body>
</html>

<?php
$conn->close();
?>
