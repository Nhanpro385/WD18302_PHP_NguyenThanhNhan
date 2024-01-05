<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 1.3 </title>
</head>
<body>
<?php
$firstName = isset($user['firstname']) ? $user['firstname'] : 'First name';
$lastName = isset($user['lastname']) ? $user['lastname'] : 'Lastname';
echo ('PC06839 -Lab1.3 <br>');
?>
<h2>Email lấy làm mẫu 'user1@example.com'</h2>
<?=$firstName . ' ' . $lastName;?>
  <form  method="post">
    <input type="email" name='email'>
    <button type="submit">Xác nhận email</button>
  </form>
   
</body>
</html>