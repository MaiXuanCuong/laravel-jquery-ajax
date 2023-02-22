<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <div class="header">
        <h1>Thông tin tài khoản</h1>
    </div>
    <div class="content">
        <p>Chào {{ $params['name'] }},</p>
        <p>Dưới đây là thông tin tài khoản của bạn:</p>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
           {{ $params['password'] }}
        </div>
    </div>
    <div class="footer">
        <p>©2023 Xuân Cường Shop. Đã đăng ký bản quyền</p>
    </div>
</body>
</html>