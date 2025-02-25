<?php 
    include_once 'koneksi.php';
    session_start();
    if (!isset($_SESSION['login'])){
        header("Location: login.php");
    }
    $login = $_SESSION['login'];
    $isLogin = true;

    $select_query = $conn->prepare("SELECT O.OrderId as OrderId, M.MenuName as MenuName, O.OrderDate as OrderDate FROM Orders O JOIN Menus M JOIN Diary D JOIN Sizes S ON O.MenuId=M.MenuId AND O.DiaryId=D.DiaryId AND S.SizeId=O.SizeId");
    $select_query->execute();
    $select_query->store_result();
    $select_query->bind_result($OrderId, $MenuName, $OrderDate);
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
    <title>Dashboard</title>
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
            <?php if ($isLogin):?>
                <a href="logout.php" class="btn btn-primary">Log out</a>
            <?php else:?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif;?>
          </div>
        </div>
      </div>
    </nav>

    <?php if (isset($_SESSION["deleteMsg"])): ?>
    <div class="alert alert-primary" role="alert">
        <?= $_SESSION["deleteMsg"] ?>
    </div>
    <?php 
        unset($_SESSION["deleteMsg"]);
    endif;
    ?>

    <div class="container-fluid px-4">
        <h1 class="text-center">Hello, <?= $login ?></h1>
        <a href="/order.php" class="btn btn-primary">Order</a>

        <table class="table table-striped">
            <thead>
                <th>No</th>
                <th>Menu</th>
                <th>Order date</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($select_query->fetch()):
                ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $MenuName ?></td>
                    <td><?= $OrderDate ?></td>
                    <td>
                        <a href="/lihat.php?orderId=<?= $OrderId ?>" class="btn btn-primary">Lihat</a>
                        <a href="/hapus.php?orderId=<?= $OrderId ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
</body>
</html>