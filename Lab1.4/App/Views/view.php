<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Lab 1.4 Order Information</title>
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
PC06839 
<div class="container mt-5">
    <h2>Order Information</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Order Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= $order['customer_name'] ?></td>
                    <td><?= $order['customer_email'] ?></td>
                    <td><?= $order['order_date'] ?></td>
                    <td><?= $order['total_amount'] ?></td>
                    <td><?= $order['order_status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>