<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6ec6ff, #2196f3); /* Gradasi biru cerah */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #2196f3;
            color: white;
            text-align: center;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            font-size: 20px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #2196f3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control">
            <option value="kasir">Kasir</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 400px;">
        <div class="card-header">
            Register
        </div>
        <div class="card-body">
            <form action="proses_register.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="login.html">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
