<!-- app/Views/update.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Information</title>
    
    <link rel="stylesheet" href="<?= base_url('css/update.css') ?>">
   
</head>
<body>
    <div class="container">
        <h1>Update Your Information</h1>
        
        <?php if (session()->has('errors')) : ?>
            <div class="success-message">
                <?php foreach (session('errors') as $error) : ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
           <?php endif; ?>

        <form action="<?= base_url('register/update') ?>" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= old('name') ?>">

            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= old('email') ?>">
            
            <?php if (session()->has('error')) : ?>
             <div class="errors">
                 <p><?= esc(session('error')) ?></p>
             </div>
             <?php endif; ?>
            <label for="mobile">Mobile:</label>
            <input type="text" id="mobile" name="mobile" value="<?= old('mobile') ?>">
            
            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password">

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password">

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">

            <label for="profile_pic">Profile Picture:</label>
            <input type="file" id="profile_pic" name="profile_pic">

            <button type="submit" >Update</button>
        </form>
    </div>
</body>
</html>
