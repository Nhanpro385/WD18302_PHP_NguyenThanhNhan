   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Quản lý khách hàng</h1>
                    </div>
                </div>
            </div>
        </div>
       <!-- Modal Update -->
       <!-- Modal Update -->
       <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="updateModalLabel">Cập nhật thông tin khách hàng</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <!-- Form cập nhật thông tin khách hàng -->
                       <form id="updateCustomerForm">
                           <input type="hidden" id="updateCustomerID" name="customer_id">
                           <div class="mb-3">
                               <label for="updateCustomerName" class="form-label">Tên khách hàng:</label>
                               <input type="text" class="form-control" id="updateCustomerName" name="customer_name">
                           </div>
                           <div class="mb-3">
                               <label for="updateEmail" class="form-label">Email:</label>
                               <input type="email" class="form-control" id="updateEmail" name="email">
                           </div>
                           <div class="mb-3">
                               <label for="updateAddress" class="form-label">Địa chỉ:</label>
                               <input type="text" class="form-control" id="updateAddress" name="address">
                           </div>
                           <div class="mb-3">
                               <label for="updatePhoneNumber" class="form-label">Số điện thoại:</label>
                               <input type="text" class="form-control" id="updatePhoneNumber" name="phone_number">
                           </div>
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                       <!-- Sử dụng sự kiện submit của form thay vì sự kiện onclick -->
                       <button type="button" id="btnUpdate" class="btn btn-primary">Cập nhật</button>
                   </div>

               </div>
           </div>
       </div>

       <!-- Modal -->
       <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="detailModalLabel">Thông tin chi tiết</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <!-- Thông tin chi tiết sẽ được điền vào đây -->
                       <div id="detailInfo"></div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
                                            <th>ID Khách hàng</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Email</th>
                                            <th>Địa Chỉ</th>
                                            <th>Số điện thoại</th>
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
   <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
   <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



   <script>
       $(document).ready(function() {
           $('#orderTable').DataTable();
           $.ajax({
               url: '?url=AjaxController/handleAjaxRequest',
               type: 'POST',
               data: {
                   action: 'getAllUsers'
               },
               success: function(data) {
                   updateTable(data); // Truyền mảng users vào hàm updateTable
                   // Gọi hàm getBtn sau khi cập nhật bảng
                   getBtn();
                   deleteBTN();
               }
           });
       });
       // Bắt sự kiện click trên nút xóa
       $(document).on('click', '.btn-delete', function() {
           // Lấy ID của hàng dữ liệu cần xóa
           var customerId = $(this).data('id');

           // Gửi yêu cầu AJAX để xóa hàng dữ liệu
           $.ajax({
               type: 'POST',
               url: '?url=AjaxController/handleDeleteUserRequest',
               data: {
                   action: 'deleteUser',
                   customerId: customerId
               },
               success: function(response) {
                   console.log("Dữ liệu trả về từ máy chủ:", response); // Log dữ liệu trả về từ máy chủ
                   if (response.success) {
                       // Nếu xóa thành công, cập nhật bảng
                       updateTable(response.data);
                       Swal.fire({
                           icon: 'success',
                           title: 'Xóa thành công!',
                           showConfirmButton: false,
                           timer: 1500
                       });
                   } else {
                       // Nếu có lỗi, hiển thị thông báo lỗi
                       Swal.fire({
                           icon: 'error',
                           title: 'Đã xảy ra lỗi!',
                           text: response.error,
                       });
                   }
               },
               error: function(xhr, status, error) {
                   // Xử lý lỗi (nếu có)
                   console.log("Lỗi trong quá trình xử lý yêu cầu AJAX:", error); // Log lỗi
                   Swal.fire({
                       icon: 'error',
                       title: 'Đã xảy ra lỗi!',
                       text: 'Có lỗi xảy ra trong quá trình xóa. Vui lòng thử lại sau.',
                   });
               }
           });
       });

       // Di chuyển sự kiện submit ra ngoài document.ready
       $('#btnUpdate').click(function(e) {
           e.preventDefault();

           // Kiểm tra xem tất cả các trường đã được nhập đúng chưa
           var customerId = $('#updateCustomerID').val();
           var customerName = $('#updateCustomerName').val();
           var customerEmail = $('#updateEmail').val();
           var customerAddress = $('#updateAddress').val();
           var customerPhoneNumber = $('#updatePhoneNumber').val();

           if (customerId && customerName && customerEmail && customerAddress && customerPhoneNumber) {
               // Nếu tất cả các trường đã được nhập, gửi Ajax request
               $.ajax({
                   type: 'POST',
                   url: '?url=AjaxController/handleUpdateUserRequest',
                   data: {
                       action: 'updateUser',
                       customerId: customerId,
                       customerName: customerName,
                       customerEmail: customerEmail,
                       customerAddress: customerAddress,
                       customerPhoneNumber: customerPhoneNumber
                   },
                   success: function(response) {
                       console.log("Dữ liệu trả về từ máy chủ:", response); // Log dữ liệu trả về từ máy chủ
                       if (response.success) {
                           // Nếu thành công, hiển thị SweetAlert thông báo thành công
                           Swal.fire({
                               icon: 'error',
                               title: 'Đã xảy ra lỗi!',
                               text: response.error,

                           });
                       } else {
                           // Nếu có lỗi, hiển thị SweetAlert thông báo lỗi
                           Swal.fire({
                               icon: 'success',
                               title: 'Cập nhật thành công!',
                               showConfirmButton: false,
                               timer: 1500
                           }).then(function() {
                               // Load lại trang sau khi hiển thị thông báo thành công trong 1.5 giây
                               window.location.reload();
                           });
                       }
                   },
                   error: function(xhr, status, error) {
                       // Xử lý lỗi (nếu có)
                       console.log("Lỗi trong quá trình xử lý yêu cầu Ajax:", error); // Log lỗi
                       Swal.fire({
                           icon: 'error',
                           title: 'Đã xảy ra lỗi!',
                           text: 'Có lỗi xảy ra trong quá trình cập nhật. Vui lòng thử lại sau.',
                       });
                   }
               });

           } else {
               // Nếu có trường chưa được nhập, thông báo lỗi cho người dùng
               Swal.fire({
                   icon: 'error',
                   title: 'Vui lòng điền đầy đủ thông tin.',
               });
           }
       });



       function updateTable(data) {
           var table = $('#orderTable').DataTable();
           var tableBody = table.rows().nodes().to$();

           // Xóa các hàng cũ
           table.clear();

           // Thêm các hàng mới từ dữ liệu nhận được
           data.users.forEach(function(customer) {
               var actionButtons = `
            <button class="btn btn-info btn-sm btn-update" data-id='${customer.customer_id}' data-name='${customer.customer_name}' data-email='${customer.email}' data-phone='${customer.phone_number}' data-address='${customer.address}'><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm btn-delete" data-id='${customer.customer_id}'><i class="fas fa-trash-alt btn-delete"></i></button>
        `;
               var row = [
                   customer.customer_id,
                   customer.customer_name,
                   customer.email,
                   customer.address,
                   customer.phone_number,
                   actionButtons
               ];
               table.row.add(row);
           });

           // Vẽ lại DataTables với dữ liệu mới
           table.draw();
       }

       function getBtn() {
           var updateButtons = document.querySelectorAll('.btn-update');
           updateButtons.forEach(function(button) {
               // Thêm sự kiện click cho mỗi button
               button.addEventListener('click', function() {
                   var customerId = button.getAttribute('data-id');
                   var customerName = button.getAttribute('data-name');
                   var customerEmail = button.getAttribute('data-email');
                   var customerPhone = button.getAttribute('data-phone');
                   var customerAddress = button.getAttribute('data-address');

                   // Hiển thị thông tin của khách hàng trong console
                   console.log("Customer ID:", customerId);
                   console.log("Customer Name:", customerName);
                   console.log("Customer Email:", customerEmail);
                   console.log("Customer Phone:", customerPhone);
                   console.log("Customer Address:", customerAddress);

                   // Đặt giá trị của các trường input trong modal
                   document.getElementById('updateCustomerID').value = customerId;
                   document.getElementById('updateCustomerName').value = customerName;
                   document.getElementById('updateEmail').value = customerEmail;
                   document.getElementById('updatePhoneNumber').value = customerPhone;
                   document.getElementById('updateAddress').value = customerAddress;

                   // Mở modal cập nhật
                   $('#updateModal').modal('show');
               });
           });
       }
       function deleteBTN() {
           var deletebtns = document.querySelectorAll('.btn-delete');
           deletebtns.forEach(function(button) {
               button.addEventListener('click', function() {
                   var customerId = button.getAttribute('data-id');
                   // Gọi hàm xóa khách hàng bằng Ajax
                   deleteCustomer(customerId);
               });
           });
       }
       function deleteCustomer(customerId) {
           // Gửi yêu cầu xóa khách hàng bằng Ajax
           $.ajax({
               type: 'POST',
               url: '?url=AjaxController/handleDeleteUserRequest',
               data: {
                   action: 'deleteUser',
                   customerId: customerId
               },
               success: function(response) {
                   console.log(response); // Log dữ liệu trả về từ máy chủ
                   if (response.success) {
                       // Nếu thành công, hiển thị SweetAlert thông báo thành công và load lại trang
                       Swal.fire({
                           icon: 'error',
                           title: 'Đã xảy ra lỗi!',
                           text: response.error
                       });
                   } else {
                       // Nếu có lỗi, hiển thị SweetAlert thông báo lỗi
                       Swal.fire({
                           icon: 'success',
                           title: 'Xóa thành công!',
                           showConfirmButton: false,
                           timer: 1500
                       }).then(function() {
                           location.reload(); // Load lại trang sau khi hiển thị thông báo thành công trong 1.5 giây
                       });
                   }
               },
               error: function(xhr, status, error) {
                   // Xử lý lỗi (nếu có)
                   console.log("Lỗi trong quá trình xử lý yêu cầu Ajax:", error); // Log lỗi
                   Swal.fire({
                       icon: 'error',
                       title: 'Đã xảy ra lỗi!',
                       text: 'Có lỗi xảy ra trong quá trình xóa khách hàng. Vui lòng thử lại sau.'
                   });
               }
           });
       }


   </script>
   </body>