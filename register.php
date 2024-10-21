<!DOCTYPE html>
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
           
            <form action="register.php" class="form p-3 " method="post">
            <?php 
             if (isset($_POST['submit'])) {
                $full_name = $_POST['login'];
                $password = $_POST['parol'];

                require_once './database.php';
                $sql = "INSERT INTO users(full_name,password)VALUES (?,?)";
                $stmt = mysqli_stmt_init($coon);
                $prepare_stm = mysqli_stmt_prepare($stmt,$sql);
                if($prepare_stm){
                    mysqli_stmt_bind_param($stmt,"ss",$full_name,$password);
                    mysqli_stmt_execute($stmt);
                    header("Location: login.php");

                }else{
                    die("Xatolik");
                }
            }
                ?>
                <h2>Ro'yhatdan o'tish</h2>
                <label><span>Login:</span> 
                    <input type="text" class="form-control" name="login" id="lgin" required>
                </label>
                <label><span>Parol:</span> 
                    <input type="password" class="form-control" name="parol" id="parol" required>
                </label>
                <label><span>Parol:</span> 
                    <input type="password" class="form-control" name="parol_test" id="parol_test" required>
                </label>
                <button class="btn btn-primary login_btn" disabled name="submit">Tizimga kirish</button>
            </form>
            <div class="links form p-3 mt-3"> Siz avval ro'yhatdan o'tgan bo'lsangiz hisobingizga kiring
                <a href="login.php">Tizimga kirish ></a>
            </div>

        </div>
    </div>
    <script src='./assets/js/pro.js'></script>
</body>
</html>