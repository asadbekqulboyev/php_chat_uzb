<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style/style.css">
    <title>Suhbatlashuv</title>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="container d-flex justify-content-between">
            <a href="" class="log">
                <img width="64" height="64" src ="https://img.icons8.com/cute-clipart/64/chat.png" alt = "chat" />
            </a>

            <a href="">
            <img width="48" height="48" src="https://img.icons8.com/fluency/48/user-male-circle--v1.png" alt="user-male-circle--v1"/>
            </a>
            </div>
            
        </header>
        <main>
            <div class="container">
           
                <div class="chat_items d-flex gap-2 flex-column"> 
            <?php
            require_once './database.php';
            $sql = "SELECT * FROM messages ORDER BY created_at DESC";
            $result = $coon->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<div class='chat_item'>
                <h5>" . htmlspecialchars($row['username']) . "</h5> " ."<div class='meassage'>". htmlspecialchars($row['message']) ." <div class='date'>" . $row['created_at'] . "</div>". "</div>";
                if ($row['file_name']) {
                    echo '<a href="uploads/' . htmlspecialchars($row['file_name']) . '" clas="file flex" target="_blank"><img src="https://cdn-icons-png.flaticon.com/512/2246/2246690.png"/> <span>Ko\'rish</span></a>';
                }
                echo "</div>";
            }
            ?>
                    
                </div>
                <form action="index.php" method="POST" enctype="multipart/form-data" class="mt-3">
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="Xabar yozing" required>
                <input type="file" name="file" class="form-control">
                <button class="btn btn-primary" type="submit">Yuborish</button>
            </div>
        </form>
        <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
        $username = $_SESSION['user'];
        $message = $_POST['message'];
        $file_name = null;

        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            // Faylni yuklash
            $target_dir = "uploads/";
            $file_name = basename($_FILES['file']['name']);
            $target_file = $target_dir . $file_name;
            
            // Faylni harakatlantirish
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                // Fayl muvaffaqiyatli yuklandi
            } else {
                echo '<div class="alert alert-danger">Faylni yuklashda xato!</div>';
            }
        }

        $stmt = $coon->prepare("INSERT INTO messages (username, message, file_name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $message, $file_name);
        $stmt->execute();
        header("Location: index.php"); // Xabar yuborilgandan so'ng sahifani yangilash
        exit();
    }
    ?>
            </div>
        </main>
    </div>
</body>
</html> 



    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
        $username = $_SESSION['user'];
        $message = $_POST['message'];
        $file_name = null;
        if(!$file_name == null){

        }
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            // Faylni yuklash
            $target_dir = "uploads/";
            $file_name = basename($_FILES['file']['name']);
            $target_file = $target_dir . $file_name;
            
            // Faylni harakatlantirish
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                // Fayl muvaffaqiyatli yuklandi
            } else {
                echo '<div class="alert alert-danger">Faylni yuklashda xato!</div>';
            }
        }

        $stmt = $conn->prepare("INSERT INTO messages (username, message, file_name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $message, $file_name);
        $stmt->execute();
        header("Location: index.php"); // Xabar yuborilgandan so'ng sahifani yangilash
        exit();
    }
    ?>
    
    <script src='./assets/js/pro.js'></script>
</body>
</html>
