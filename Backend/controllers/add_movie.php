<?php
require_once 'Backend/connection/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $rating = filter_var($_POST['rating'], FILTER_SANITIZE_STRING);
    $trailer_url = filter_var($_POST['trailer_url'], FILTER_SANITIZE_URL);
    $cast = filter_var($_POST['cast'], FILTER_SANITIZE_STRING);
    $showtimes = filter_var($_POST['showtimes'], FILTER_SANITIZE_STRING);

    try {
        $stmt = $pdo->prepare("INSERT INTO movies (title, rating, trailer_url, cast, showtimes) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $rating, $trailer_url, $cast, $showtimes]);
        header("Location: ../Frontend/Pages/admin.html?success=1");
    } catch (PDOException $e) {
        header("Location: /Frontend/Pages/admin.html?error=" . urlencode($e->getMessage()));
    }
    exit();
} else {
    header("Location: /Frontend/Pages/admin.html");
    exit();
}
?>