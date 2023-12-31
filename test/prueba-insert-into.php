<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trashinvaders"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO imagen (nombre, imagen, hash) VALUES (?, ?, ?)");
$stmt->bind_param("sbs", $nombre, $imagen, $hash);

if(isset($_FILES['imagenes'])){
    $imagenes = $_FILES['imagenes'];

    // Recorrer cada archivo subido
    for($i = 0; $i < count($imagenes['name']); $i++) {
        $nombre = basename($imagenes['name'][$i]);
        $imagenData = file_get_contents($imagenes['tmp_name'][$i]);
        $hash = hash('sha256', $imagenData);

        // Validar la extensión del archivo
        $extension = pathinfo($nombre, PATHINFO_EXTENSION);
        $allowedExtensions = array("jpg", "jpeg", "png");
        if (!in_array($extension, $allowedExtensions)) {
            echo "Error: El archivo $nombre tiene una extensión no permitida. <br>";
            continue; // Skip to the next file
        }

        // Check if the hash already exists in the database
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM imagen WHERE hash = ?");
        $checkStmt->bind_param("s", $hash);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo "Error: El archivo $nombre ya existe en la base de datos. <br>";
            continue; // Skip to the next file
        }

        // Insert the data into the database
        $stmt->send_long_data(1, $imagenData);
        if ($stmt->execute() === FALSE) {
            echo "Error: " . $stmt->error;
        }
    }
}

$conn->close();
?>