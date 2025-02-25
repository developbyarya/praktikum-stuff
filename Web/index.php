<?php

$data = [
    ["Ayam Geprek", 12000]

];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Daftar </title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container p-4">
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
            <?php foreach ($data as $d): ?>

                <tr>
                    <td>1</td>
                    <td><?= $d[0] ?></td>
                    <td><?= $d[1]; ?></td>
                    <td>
                        <button class="btn btn-primary">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <form action="" id="tambahdata" class="needs-validation" novalidate>
            <label for="namaMakanan" class="form-label">Nama Makanan: </label>
            <input type="text" id="namaMakanan" class="form-control" required>
            <p class="invalid-feedback">Nama makanan tidak boleh kosong</p>
            <label for="harga" class="form-label">harga</label>
            <input type="number" name="hargaMakanan" id="harga" class="form-control border border-danger" required>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <script src="./script.js"></script>

</body>

</html>