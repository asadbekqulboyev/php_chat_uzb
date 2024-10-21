<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ro'yhatdan o'tish</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container pt-5">
            <?php
            if(isset($_POST['login'])){

            }
            ?>
            <form action="login.php" class="form p-3 ">
                <h2>Tizimga kirish</h2>
                <label><span>Login:</span> 
                    <input type="text" class="form-control" name="login" id="login">
                </label>
                <label><span>Parol:</span> 
                    <input type="password" class="form-control" name="parol" id="parol">
                </label>
                <button class="btn btn-primary">Tizimga kirish</button>
            </form>
            <div class="links form p-3 mt-3">
                Tizimga kirish uchun avval hisobingiz bo'lishi kerak hisob yaratish uchun .
                <a href="register.php">Ro'yhatdan o'ting ></a>
            </div>

        </div>
    </div>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tizimga kirish</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container pt-5"> 
           
            <form action="login.php" class="form p-3 " method="post">
            <?php 
            session_start();
            if (isset($_POST['submit'])) {
                $full_name = $_POST['login'];
                $password = $_POST['parol'];

                require_once './database.php';
                // Foydalanuvchini ismi va parolini tekshirish
                $sql = "SELECT * FROM users WHERE full_name = ? AND password = ?";
                $stmt = mysqli_stmt_init($coon); // $coon should be $conn
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ss", $full_name, $password);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    // Agar foydalanuvchi topilsa
                    if (mysqli_num_rows($result) > 0) {
                        $_SESSION['user'] = $full_name; // Foydalanuvchi sessiyaga saqlanadi
                        header("Location: index.php"); // Tizimga kirgandan keyin index.php sahifasiga o'tish
                        exit();
                    } else {
                        echo '<div class="alert alert-danger">Login yoki parol xato</div>';
                    }
                } else {
                    die("Xatolik yuz berdi");
                }
            }
            ?>
                <h2>Tizimga kirish</h2>
                <label><span>Login:</span> 
                    <input type="text" class="form-control" name="login" id="login" required>
                </label>
                <label><span>Parol:</span> 
                    <input type="password" class="form-control" name="parol" id="parol" required>
                </label>
                <button class="btn btn-primary login_btn" name="submit">Tizimga kirish</button>
            </form>
            <div class="links form p-3 mt-3"> Hisobingiz yo'qmi? 
                <a href="register.php">Ro'yhatdan o'ting ></a>
            </div>

        </div>
    </div>
    <script src='./assets/js/pro.js'></script>
</body>
</html>
