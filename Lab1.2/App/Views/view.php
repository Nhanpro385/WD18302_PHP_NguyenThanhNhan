<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Lab 1.2 </title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Đường dẫn lab 1</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../../../Lab1.1/index.php">Lab 1.1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../Lab1.2/index.php">Lab 1.2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../Lab1.3/index.php">Lab 1.3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../Lab1.4/index.php">Lab 1.4</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <?php 
     include '../Controller/Data.php';
     echo ('PC06839 -Lab1.2 <br>');
    ?>
    <?= $page_name ?>
    <form action="" method="get">
        <select name="semester" id="">

        <?php foreach($course as $key => $value):?>
        <option value="<?= $key?>"><?= $value ?></option>
        <?php endforeach; ?>
        </select>
        <button type="submit">Tìm khóa học</button>
    </form>
</body>
</html>