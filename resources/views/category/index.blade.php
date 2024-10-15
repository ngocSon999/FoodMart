<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Chi - PC2345</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .sidebar {
            border-right: 1px solid #ddd;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                top: 0;
                left: 0;
                background-color: #f7f7f7;
                transform: translateX(-120%);
            }

            .sidebar.active {
                transform: translateX(0);
            }
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 20px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        .sidebar ul li a:hover {
            color: #ff8800;
        }

        /* Overlay for mobile sidebar */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* Main content styling */
        .main-content {
            position: relative;
            padding: 20px;
            transition: padding-left 0.3s ease;
        }

        /* Adjust main content padding on small screens */
        @media (max-width: 768px) {
            .main-content {
                padding-left: 0;
            }
        }

        /* Custom footer button styling */
        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .footer button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Header with logo and sidebar toggle button -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler d-md-none" type="button" onclick="toggleSidebar()">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="logo.png" alt="Logo" style="height: 40px;">
            <span class="ms-2">Phiếu Chi</span>
        </a>
    </div>
</nav>

<!-- Main content with sidebar inside -->
<div class="main-content container">
    <!-- Sidebar -->
    <div class="row">
        <div class="col-md-3 sidebar" id="sidebar">
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="#">Kinh doanh</a></li>
                <li>
                    <a href="#">Quản lý Tour</a>
                    <ul>
                        <li><a href="#">Danh sách phiếu chi</a></li>
                        <li><a href="#">Danh sách phiếu thu</a></li>
                    </ul>
                </li>
                <li><a href="#">Khách hàng</a></li>
                <li><a href="#">Kế toán</a></li>
                <li><a href="#">Quản trị</a></li>
            </ul>
        </div>
        <div class="col-md-9 col-12">
            <div class="content">
                <h1>Phiếu Chi - PC2345</h1>
                <table class="table table-bordered mt-4">
                    <tr>
                        <th>Mã</th>
                        <td>PC2345</td>
                    </tr>
                    <tr>
                        <th>Phương thức</th>
                        <td>Chuyển khoản</td>
                    </tr>
                    <tr>
                        <th>Số tiền</th>
                        <td>10,000,000</td>
                    </tr>
                    <tr>
                        <th>Tài khoản nhận tiền</th>
                        <td>Techcombank - Nguyễn Văn A - 666688889999</td>
                    </tr>
                    <tr>
                        <th>Lý do</th>
                        <td>Thanh toán vé máy bay Tour</td>
                    </tr>
                    <tr>
                        <th>Ngày lập</th>
                        <td>20/11/2023 - 11:35:08</td>
                    </tr>
                    <tr>
                        <th>Người lập</th>
                        <td>Mi Mai</td>
                    </tr>
                    <tr>
                        <th>Ngày cập nhật gần nhất</th>
                        <td>21/11/23 - 20:28:42</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>Đã duyệt 01/02</td>
                    </tr>
                </table>

                <div class="footer">
                    <button class="btn btn-primary">Chỉnh Sửa</button>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- Overlay for closing sidebar -->
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<!-- Bootstrap 5 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle Sidebar
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        var overlay = document.getElementById("overlay");
        sidebar.classList.toggle("active");
        overlay.classList.toggle("active");
    }

    // Close Sidebar when clicking outside
    function closeSidebar() {
        var sidebar = document.getElementById("sidebar");
        var overlay = document.getElementById("overlay");
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
    }
</script>

</body>
</html>
