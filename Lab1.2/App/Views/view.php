<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 1.2 </title>
</head>
<body>
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