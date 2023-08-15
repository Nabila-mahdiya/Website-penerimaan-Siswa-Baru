<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <style>
        body {
        font-family: Arial, sans-serif;
        font-size: 16px;
       
    }
    </style>
</head>
<body><?php include 'nav.php'; ?>
    <?php generateHeader();?>
    <?php generateNav(); ?>

    <div class="container mt-5">
        <h2>Login</h2>
        <form action="aksi_login.php?op=in" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="" name="password" placeholder="Enter your password" required>
            </div>
            <!-- <button type="submit" class="btn btn-primary ">Login</button> -->
           <input type="submit" class="btn btn-primary" value="Login" name="Login">
            <a href="form_register.php" class="btn btn-primary">Register</a>
        </form>
    </div>

    <?php generateFooter();?>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>