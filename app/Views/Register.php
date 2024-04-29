<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>"> <!-- Link to external CSS file using base_url -->
    
</head>
<body>
    <h1>User Registration</h1>

    <?php if (session()->get('success')): ?>
        <div class="success-message"><?= session()->get('success') ?></div>
    <?php endif; ?>
    
  <?= form_open_multipart('/register/save') ?>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        
        <?php if (session()->get('errors')): ?>
    <div class="success-message">
        <ul>
            <?php foreach (session()->get('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="mobile">Mobile</label>
        <input type="text" name="mobile" id="mobile" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="profile_pic">Profile Picture</label>
        <input type="file" name="profile_pic" id="profile_pic">

        <input type="submit" value="Register">
    <?= form_close() ?>
</body>
</html>
