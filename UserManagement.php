<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <title>Document</title>
    <style>
    body{
    font-family: Arial, sans-serif;
    font-size: 16px;
  }
  </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <?php generateHeader(); ?>
    <?php NavAdmin(); ?>
    <?php include 'aksi_usermanagement.php'; ?>
   
    <div class="container">
        <h2>Hapus Pengguna</h2>
        <p>Anda dapat menghapus data pengguna berdasarkan user_id.</p>
        <?php if (!empty($message)) : ?>
            <div class="alert alert-<?php echo (!empty($failedUserIds)) ? 'danger' : 'success'; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <h4>Data Pengguna:</h4>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php include 'aksi_usermanagement.php'; ?> -->
                <?php foreach ($users as $user_id => $username) : ?>
                    <tr>
                        <td><?php echo $user_id; ?></td>
                        <td><?php echo $username; ?></td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
       
        
        <form method="post" action="aksi_usermanagement.php">
            <label for="user_ids">User ID:</label>
            <input type="text" name="user_ids" id="user_ids" placeholder="Masukkan User ID yang ingin dihapus (pisahkan dengan koma jika lebih dari satu)">
            <input type="submit" class="btn btn-danger" value="Hapus">
        </form>
    </div>

    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>