<?php
  session_start();

  require_once "../classes/User.php";

  $user_obj = new User;
  $user = $user_obj->getUser($_SESSION['id']);
  // print_r($all_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../assets/css/style.css">
  <title>Edit User</title>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px;">
    <div class="container">
      <a href="dashboard.php" class="navbar-brand">
        <h1 class="h3">The Company</h1>
      </a>
      <div class="navbar-nav">
        <span class="navbar-text"><?= $_SESSION['fullname']?></span>
        <form action="../actions/logout-action.php" method="post" class="d-flex ms-2">
          <button type="submit" class="btn btn-danger text-danger bg-transparent border-0">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <main class="row justify-content-center gx-0">
    <div class="col-4">
      <h2 class="text-center mb-4">EDIT USER</h2>

      <!-- .png, tiff, jpeg, jpg -->
      <form action="../actions/edit-user-action.php" method="post" enctype="multipart/form-data">
        <div class="row justify-content-center mb-3">
          <div class="col-6">
            <?php
              if($user['photo']){
            ?>
                <img src="../assets/images/<?= $user['photo']?>" alt="<?=$user['photo']?>" class="d-block mx-auto edit-photo">
            <?php
              }else{
            ?>
              <i class="fa-solid fa-user text-secondary d-block text-center edit-icon"></i>
            <?php
              }
            ?>

            <input type="file" name="photo" id="" class="form-control mt-2" accept="image/*">
            
          </div>
          <!-- First name -->
          <div class="mb-3">
            <label for="first-name" class="form-lable">Firstname</label>
            <input type="text" name="first_name" id="first-name" class="form-control" value="<?=$user['first_name']?>" required autofocus>
          </div>
          <!-- Last name -->
          <div class="mb-3">
            <label for="last-name" class="form-label">Lastname</label>
            <input type="text" name="last_name" id="last-name" class="form-control" value="<?=$user['last_name']?>" required>
          </div>
          <!-- Username -->
          <div class="mb-4">
            <label for="username" class="form-label fw-bold">Username</label>
            <input type="text" name="username" id="username" class="form-control fw-bold" value="<?=$user['username'] ?>" required>
          </div>
        </div>
        <!-- Cancel and Save button -->
        <div class="text-end">
          <a href="dashboard.php" class="btn btn-secndary btn-sm">Cancel</a>
          <button type="submit" class="btn btn-warning btn-sm px-5">Save</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>