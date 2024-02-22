   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Danh sách Sản phẩm </h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="orderTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mã Đơn</th>
                                            <th>Tên Khách Hàng Nhận</th>
                                            <th>Địa Chỉ</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Dữ liệu đơn hàng sẽ được thêm vào đây từ PHP -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
<script src="script.js"></script>
<script>
    // Dữ liệu đơn hàng (được giả sử lấy từ server)
const orders = [
    { id: 1, customerName: 'Nguyễn Văn A', address: '123 Đường ABC, Quận XYZ', status: 'Chờ Duyệt' },
    { id: 2, customerName: 'Nguyễn Văn D', address: '123 Đường ABC, Quận XYZ', status: 'Chờ Duyệt' },
    { id: 3, customerName: 'Nguyễn Văn R', address: '123 Đường ABC, Quận XYZ', status: 'Chờ Duyệt' },
    { id: 4, customerName: 'Nguyễn Văn C', address: '123 Đường ABC, Quận XYZ', status: 'Chờ Duyệt' },
    { id: 5, customerName: 'Nguyễn Văn B', address: '123 Đường ABC, Quận XYZ', status: 'Chờ Duyệt' },
    { id: 6, customerName: 'Nguyễn Văn V', address: '123 Đường ABC, Quận XYZ', status: 'Chờ Duyệt' }
    // Thêm dữ liệu đơn hàng khác nếu cần
];

// Hàm để hiển thị dữ liệu đơn hàng trong bảng
function displayOrders() {
    const tableBody = $('#orderTable tbody');
    tableBody.empty();

    orders.forEach(order => {
        const row = `
            <tr>
                <td>${order.id}</td>
                <td>${order.customerName}</td>
                <td>${order.address}</td>
                <td>${order.status}</td>
                <td>
                    <button class="btn btn-primary" onclick="viewOrder(${order.id})"><i class="fas fa-eye"></i> Xem Chi Tiết</button>
                    <button class="btn btn-success" onclick="approveOrder(${order.id})"><i class="fas fa-check"></i> Duyệt</button>
                    <button class="btn btn-danger" onclick="rejectOrder(${order.id})"><i class="fas fa-times"></i> Từ Chối</button>
                </td>
            </tr>
        `;
        tableBody.append(row);
    });
}

// Các hàm xử lý sự kiện (xem chi tiết, duyệt, từ chối)
function viewOrder(orderId) {
    // Viết mã để xử lý xem chi tiết đơn hàng
    alert('Xem chi tiết đơn hàng #' + orderId);
}

function approveOrder(orderId) {
    // Viết mã để xử lý duyệt đơn hàng
    alert('Duyệt đơn hàng #' + orderId);
}

function rejectOrder(orderId) {
    // Viết mã để xử lý từ chối đơn hàng
    alert('Từ chối đơn hàng #' + orderId);
}

// Gọi hàm để hiển thị dữ liệu khi trang được load
$(document).ready(function () {
    displayOrders();
});

</script>
   </body>