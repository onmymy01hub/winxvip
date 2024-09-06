<?php
session_start();

$errorMsg = ''; // ตั้งค่าข้อความผิดพลาดเป็นค่าว่างเริ่มต้น
$correctPassword = '1122';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === $correctPassword) {
        $_SESSION['loggedin'] = true;
        header("Location: index.php");
        exit();
    } else {
        $errorMsg = 'Username or password is incorrect!';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="password"] {
            font-size: 16px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            font-size: 16px;
            font-weight: 500;
            color: #fff;
            background-color: #007bff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: #ff0000;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <?php if($errorMsg): ?>
        <p class="error"><?= htmlspecialchars($errorMsg) ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
