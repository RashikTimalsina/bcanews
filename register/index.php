<?php
require_once '../connection.php';
$errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'gender' => ''
];
$old = [
    'name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'gender' => ''
];
if (!empty($_POST)) {
    $name = $_POST['name'];
    $namePatterns = '/^[a-zA-Z]+$/';
    if (!preg_match($namePatterns, $name)) {
        $errors['name'] = 'Name must be alphabets';
    }
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    $password = $_POST['password'];
    if (strlen($password) < 6) {
        $errors['password'] = 'Password must be 6 characters';
    }
    $confirm_password = $_POST['confirm_password'];
    if ($password != $confirm_password) {
        $errors['confirm_password'] = 'Password does not match';
    }
    if (!array_filter($errors)) {
        $gender = $_POST['gender'];
        $password = md5($password);
        $sql = "INSERT INTO users(name,email,password,gender) VALUES ('$name', '$email', '$password', '$gender')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "User registerd successfully";
            header("Location:/bcanews/login");
        } else {
            $_SESSION['error'] = "Failed to register";
            header("Location:register");
        }
        // if ($result) {
        //     $_SESSION['success'] = "User registerd successfully";
        //     header("Location./bcanews/login");
        // } else {
        //     $_SESSION['error'] = "Failed to register";
        //     header("Location.register");
        // }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <H1>Register</H1>
            </div>
            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="form-group mb-2">
                        <label for="name">Name:
                            <span class="text-danger><?= $errors['name'] ?>" </span>
                        </label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= $old['name'] ?>" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="email">Email:
                            <span class="text-danger><?= $errors['email'] ?>" </span>
                        </label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= $old['email'] ?>" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="password">Password:
                            <span class="text-danger><?= $errors['password'] ?>" </span>
                        </label>
                        <input type="password" class="form-control" id="password" name="password"
                            value="<?= $old['password'] ?>" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="confirm_password">Confirm Password;
                            <span class="text-danger><?= $errors['confirm_password'] ?>" </span>
                        </label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            value="<?= $old['confirm_password'] ?>" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="gender">Gender;
                            <span class="text-danger><?= $errors['gender'] ?>" </span>
                        </label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="" disabled selected>Select your gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                            <?= isset($old['gender']) == 'Male' ? "selected" : "" ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>