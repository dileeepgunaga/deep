<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/user.css') ?>">
</head>
<body>
    <div class="container">
        <h1>Welcome to Your Dashboard, <?= session('name') ?></h1>
        <?php if (session()->has('success')) : ?>
            <div class="success"><?= session('success') ?></div>
        <?php endif; ?>

        <div class="profile-pic">
            <img src="<?= base_url('uploads/' . session('profile_pic')) ?>" alt="Profile Picture">
        </div>

        <p>Email: <?= session('email') ?></p>
        <p>Mobile: <?= session('mobile') ?></p>

        <div class="buttons-container">
        <form action="<?= base_url('register/edit') ?>" method="get">
            <button type="submit">Update</button>
        </form>
        <a href="logout">Logout</a>
        <form action="<?= base_url('delete-account') ?>" method="post" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone!')">
         <button class="color" type="submit">Delete</button>
       </form>
 </div>
        </div>
</body>
</html>
