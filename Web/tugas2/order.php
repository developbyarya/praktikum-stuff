<?php 
include 'koneksi.php';

session_start();
if (!isset($_SESSION['login'])){
    header("Location: login.php");
}
$login = $_SESSION['login'];
$isLogin = true;

$menu_result = $conn->query("SELECT MenuId, MenuName FROM Menus;");
$result_size = $conn->query("SELECT SizeId, SizeName FROM Sizes;");
$result_diary = $conn->query("SELECT DiaryId, DiaryName FROM Diary;");
$result_toppings = $conn->query("SELECT ToppingId, ToppingsName FROM Toppings;");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />

    <title>Order your menu! - WIMAYA CAFE</title>
  </head>
  <body class="">
    <nav class="navbar navbar-expand-lg bg-white">
      <div class="container-fluid d-flex px-4">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="flex-grow-1"></div>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
            <a class="nav-link" href="#">Order</a>
            <?php if ($isLogin):?>
                <a href="logout.php" class="btn btn-primary">Log out</a>
            <?php else:?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php endif;?>
          </div>
        </div>
      </div>
    </nav>

    <div class="p-4">
      <div class="row mx-5 card-bg rounded-3">
        <div class="col g-0">
          <img
            src="./lebih-bagus.jpg"
            alt="wimaya coffee"
            class="image rounded rounded-3 w-100 h-100"
          />
        </div>
        <div class="col py-3 ml-3">
          <form action="result.php" method="post" class="">

            <h1 class="text-center">Input Your Order</h1>
            <select name="menu" id="menu" class="form-select">
              <?php 
               while($row = $menu_result->fetch_assoc()):
              ?>
              <option value="<?=$row["MenuId"]?>" selected><?= $row["MenuName"] ?></option>
              <?php endwhile;?>
            </select>
            <div class="row">
              <div class="input-section col d-flex flex-column">
                <h2>Hot/Ice</h2>
                <div class="d-flex gap-3">
                  <div class="radio-group">
                    <input
                      type="radio"
                      id="radio-hot"
                      value="hot"
                      name="hot/ice"
                    />
                    <label for="radio-hot">Hot</label>
                  </div>
                  <div class="radio-group">
                    <input
                      type="radio"
                      id="radio-ice"
                      value="ice"
                      name="hot/ice"
                      id="flex"
                      checked
                    />
                    <label for="radio-ice">Ice</label>
                  </div>
                </div>
              </div>
              <div class="d-flex input-section col flex-column">
                <h2>Size</h2>
                <div class="d-flex gap-3">
                  <?php 
                  while($row = $result_size->fetch_assoc()):
                  ?>
                  <div class="radio-group">
                    <input
                      type="radio"
                      id="size-<?=$row["SizeName"]?>"
                      value="<?= $row["SizeId"] ?>"
                      name="Size"
                    />
                    <label for="size-<?=$row["SizeName"]?>"><?= $row["SizeName"] ?></label>
                  </div>
                  <?php endwhile;?>
                </div>
              </div>
            </div>
            <div class="d-flex input-section flex-column">
              <h2>Sweetness Level</h2>
              <div class="d-flex gap-3">
                <div class="radio-group">
                  <input type="radio" name="sweetness" id="sweet-normal" value="normal" checked/>
                  <label for="sweet-normal">Normal</label>
                </div>
                <div class="radio-group">
                  <input type="radio" name="sweetness" id="sweet-less" value="less" />
                  <label for="sweet-less">Less Sweet</label>
                </div>
              </div>
            </div>
            <div class="d-flex input-section flex-column">
              <h2>Diary <span class="text-secondary fs-6">(Optional)</span></h2>
              <div class="d-flex gap-3">
                <?php while($row = $result_diary->fetch_assoc()):?>
                <div class="radio-group">
                  <input type="radio" name="diary" value="<?= $row["DiaryId"] ?>" id="diary-<?= $row["DiaryId"]?>" />
                  <label for="diary-<?=$row["DiaryId"]?>"><?= $row["DiaryName"] ?></label>
                </div>
                <?php endwhile;?>
              </div>
            </div>
            <h2>Topping</h2>
            <div class="row w-100">
              <?php 
              while($row = $result_toppings->fetch_assoc()):
              ?>
              <div class="d-flex gap-1 col-6">
                <input type="checkbox" name="toppings[]" value="<?= $row["ToppingId"] ?>" id="topping-<?=$row["ToppingId"]?>" />
                <label for="topping-<?=$row["ToppingId"]?>"><?= $row["ToppingsName"] ?></label>
              </div>
              <?php endwhile;?>
            </div>
            <h2>Note</h2>
            <textarea
              name="additional-note"
              id=""
              style="resize: none"
              class="h-25 bg-dark text-white rounded-3"
              placeholder="add note"
            ></textarea>
            <button type="submit" class="btn-success rounded-pill py-2">
              Submit
            </button>
            <button
              class="btn-dark bg-transparent rounded-pill border-light py-2 text-white"
              type="reset"
            >
              Reset
            </button>
          </form>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
