<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Form</title>
  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
</head>
<style>
  .form-control {
    border-radius: 8px;
  }
</style>

<body>
  <?php
  require '../include/header.php'
  ?>
  <div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Register</h2>
    <form action="register.php" method="post" class="mx-auto" style="max-width: 600px;">
      <div class="form-outline mb-4">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" required>
      </div>

      <div class="form-outline mb-4">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" required>
      </div>

      <div class="form-outline mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 rounded">Register</button>
      <div class="text-center">
        <p>Already a member? <a href="login.php" class="text-primary">Login</a></p>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <?php require '../include/footer.php'; ?>

</body>

</html>