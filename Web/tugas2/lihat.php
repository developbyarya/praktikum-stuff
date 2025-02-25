<?php 
include 'koneksi.php';
if (!isset($_GET["orderId"])){
    header("Location: index.php");
}
$result_id = $_GET["orderId"];

$total_price = 0;

$select_query = $conn->prepare("SELECT M.MenuName as MenuName,M.Tax as tax, M.price as MenuPrice,D.DiaryName as DiaryName, D.price as DiaryPrice, S.SizeName as Size, S.price as SizePrice 
FROM Orders O JOIN Menus M JOIN Diary D JOIN Sizes S ON O.MenuId=M.MenuId AND O.DiaryId=D.DiaryId AND S.SizeId=O.SizeId WHERE O.OrderId=?");
$select_query->bind_param("i", $result_id);
$select_query->execute();
$select_query->store_result();
$select_query->bind_result($MenuName, $tax, $MenuPrice, $DiaryName, $DiaryPrice, $Size, $SizePrice);
$select_query->fetch();

$toppings_query = $conn->prepare("SELECT T.ToppingsName as ToppingsName, T.price as Price FROM OrderToppings OT JOIN Toppings T ON OT.ToppingId=T.ToppingId WHERE OT.OrderId=?");
$toppings_query->bind_param("i", $result_id);
$toppings_query->execute();
$toppings_query->store_result();
$toppings_query->bind_result($topping_name, $topping_price);

$toppings_total_query = $conn->prepare("SELECT SUM(T.price) as Total FROM OrderToppings OT JOIN Toppings T ON OT.ToppingId=T.ToppingId WHERE OT.OrderId=? GROUP BY OT.Orderid;");
$toppings_total_query->bind_param("i",$result_id);
$toppings_total_query->bind_result($toppings_total);
$toppings_total_query->execute();
$toppings_total_query->store_result();
$toppings_total_query->fetch();



function price_after_tax($price, $tax)
{
    return $price + $price * $tax;
}

$total_price = price_after_tax($MenuPrice, $tax/100) + $SizePrice + $DiaryPrice + $toppings_total;

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
        crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>Order Reciept - Wimaya Cafe</title>
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
    <div class="container w-75">
        <h1 class="text-center my-4 text-white">Receipt</h1>
        <table class="table table-dark table-striped">
            <tr>
                <th>Addons</th>
                <th>Description</th>
                <th>Price</th>
                <th>Tax</th>
                <th>Total</th>
            </tr>
            <tr>
                <th>Beverages</th>
                <td><?= $MenuName ?></td>
                <td>Rp. <?= $MenuPrice ?></td>
                <td><?= $tax ?>%</td>
                <td>Rp. <?= price_after_tax($MenuPrice, $tax/100) ?></td>
            </tr>

            <tr>
                <th>Hot/Ice</th>
                <td><?= $_POST["hot/ice"] ?></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>

            <tr> 
                <th>Size</th>
                <td><?= $Size ?></td>
                <td>Rp. <?= $SizePrice ?></td>
                <td>-</td>
                <td>Rp. <?= $SizePrice ?></td>
            </tr>
            <tr>
                <th>Sweetness</th>
                <td><?= $_POST["sweetness"] ?></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
                <tr>
                    <th>Diary:</th>
                    <td><?= $DiaryName ?></td>
                    <td>Rp. <?= $DiaryPrice ?></td>
                    <td>-</td>
                    <td>Rp. <?= $DiaryPrice ?></td>
                </tr>
                <th rowspan="<?=$toppings_query->num_rows()+1?>">Toppings</th>
                <?php while ($toppings_query->fetch()): ?>
                <tr>
                    <td><?= $topping_name ?></td>
                    <td>Rp. <?= $topping_price ?></td>
                    <td>-</td>
                    <td>Rp. <?= $topping_price ?></td>
                </tr>
                <?php endwhile;?>

            <tr>
                <th colspan="4" class="text-center"> Total </th>
                <th>Rp. <?= $total_price ?></th>
            </tr>
        </table>
        <a href="/index.php" class="btn btn-primary text-center">Back to Dashboard</a>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>

?>