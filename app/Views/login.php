<!-- app/Views/login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/c.css') ?>"> 
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (session()->has('error')) : ?>
            <div><?= session('error') ?></div>
        <?php endif; ?>

        <form action="login/authenticate" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
            <a href="register">Register</a>
        </form>
    </div>
</body>
</html>
