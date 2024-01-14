<?php
require_once('vendor/autoload.php');
// use App\Controller\BaseController;
// use App\Model\BaseModel;
// use App\Core\Route;
// use App\Model\Product;
// use App\Model\Address;
// use App\Model\Order;
// use App\Model\User;
// use App\Core\Base;
use App\Core\Form;
use App\Core\Field;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nhanntpc06839 lab03</title>
</head>
<body>
    

<div class="container">
<h1>Create an account</h1>
<?php $form= Form::begin('','post');?>
<div class="row">
<div class="col">

<?php echo $form->field('firstName')->toString();?>



</div>
<div class="col">
<?php echo $form->field('lastName')->toString();?>

</div>


</div>

<?php echo $form->field('email')->toString();?>
<?php echo $form->field('password')->passwordField()->toString();?>
<?php echo $form->field('confirmPassword')->passwordField()->toString();?>

<button type="submit" class="btn btn-primary">Submit</button>

<?php  echo Form::end();?>
</div>








</body>
</html>