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
  <title>Delete User</title>
</head>
<body>
  <main class="row justify-content-center gx-0">
    <div class="col-4 text-center">
      <i class="fa-solid fa-triangle-exclamation text-warning display-4 d-block mb-2"></i>
      <h2 class="text-center mb-5">DELETE ACCOUNT</h2>

      <p class="fw-bold">Are you sure you want to delete your account?</p>

      <div class="row">
        <div class="col">
          <a href="dashboard.php" class="btn btn-secondary w-100">Cancel</a>
        </div>
        <div class="col">
          <form action="../actions/delete-user-action.php" method="post">
            <button type="submit" class="btn btn-outline-danger w-100">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </main>

<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>