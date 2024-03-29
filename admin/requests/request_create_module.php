<?php
include_once('../../helpers/database.php');
session_start();
$connection = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $thumbnailUrl = $_POST['thumbnailUrl']; // Campo oculto que contém a URL da miniatura
    $videoUrl = $_POST['videoCode']; // Nova adição para a URL do vídeo
    $course_id = $_GET['id']; 
   
    $query = "INSERT INTO modules (user_id, title, description, thumbnail_url, video_url, course_id) VALUES ('$user_id', '$title', '$description', '$thumbnailUrl', '$videoUrl','$course_id')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $_SESSION['message'] = "Módulo inserido com sucesso!";
        $_SESSION['message_type'] = "success";
        header("Location: ../courses.php");
    } else {
        $_SESSION['message'] = "Erro ao inserir módulo: " . mysqli_error($connection);
        $_SESSION['message_type'] = "danger";
        header("Location: ../courses.php");
    }
}
