<?php 
    include_once 'koneksi.php';
    session_start();
    
    if (isset($_POST["register"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if ($username == "" || $password == ""){
            // set session
            $_SESSION["registerError"] = "No Input";
        } else {
            $stmt = $conn->prepare("INSERT INTO Users (username, password) VALUES (?,?)");
            $password = hash('sha256', $password);
            $stmt->bind_param("ss", $username, $password);
            if ($stmt->execute()){
                $_SESSION["registerSuccess"] = true;
                header("Location: login.php");
            } else {
                $_SESSION["registerError"] = "Insert Failed - Server Error";
            }
            $stmt->close();
        }
    };
        

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <title>Register</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-white">
      <div class="container-fluid d-flex px-4">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="flex-grow-1"></div>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="/index.php">Dashboard</a>
            <a class="nav-link" href="/order.php">Order</a>
                <a href="login.php" class="btn btn-primary">Login</a>
          </div>
        </div>
      </div>
    </nav>
    <?php if (isset($_SESSION["registerError"])): ?>
    <div class="alert alert-danger" role="alert">
        Register Gagal: <?= $_SESSION["registerError"] ?>
    </div>
    <?php 
        unset($_SESSION["registerError"]);
    endif;
    ?>

    <div class="card w-50 position-absolute top-50 pt-4 start-50 translate-middle">
        <h1 class="text-center">Register</h1>
        <form action="" method="post" class="m-4 p-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="username">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="*****">
            </div>
            
            <p>Sudah punya akun? <a href="/login.php">Masuk</a></p>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" name="register" type="submit">Register</button>
            </div>

        </form>
    </div>
    
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
</body>
</html>