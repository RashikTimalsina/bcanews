<?php
require_once '../connection.php';
$errors = [
    'email' => '',
    'password' => '',
];
$old = [
    'email' => '',
    'password' => '',
];
if (!empty($_POST)) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    $password = $_POST['password'];
    if (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters';
    }
    if (!array_filter($errors)) {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            print_r($user);
        } else {
            $errors['error'] = 'Invalid email or password';
            header("Location:/bcanews/login");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Login</h1>
                <?=message();?>
            </div>
            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="form-group mb-2">
                        <label for="email">Email:
                            <span class="text-danger"><?= $errors['email'] ?></span>
                        </label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= $old['email'] ?>" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Password:
                            <span class="text-danger"><?= $errors['password'] ?></span>
                        </label>
                        <input type="password" class="form-control" id="password" name="password"
                            value="<?= $old['password'] ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>
                <?php if (!empty($errors['login'])): ?>
                    <div class="alert alert-danger mt-2"><?= $errors['login'] ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>