<?php
include '../db/db.php';
$error = '';

if(isset($_SESSION['username'])){
  header("location: http://localhost/CMS%20Project%202/index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];

  if ($password !== $c_password) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
              document.querySelector('.error-message-password').classList.add('show');
            });
          </script>";
  } else {
    $exist_email = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($con, $exist_email);

    if (mysqli_num_rows($result) > 0) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.error-message-user').classList.add('show');
              });
            </script>";
    } else {
      $hash_pass = password_hash($password, PASSWORD_BCRYPT);

      $insert = "INSERT INTO users (email, username, password)
                VALUES ('$email', '$username', '$hash_pass')";

      if (mysqli_query($con, $insert)) {
        echo "<script>window.open('login.php', '_self')</script>";
      } else {
        $error = "Error" . mysqli_error($con);
      }
    }
  }
}
?>

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
  .error-message {
    color: red;
    font-size: 1em;
    text-align: center;
    margin-top: 8px;
    display: none;
    font-weight: 500;
  }

  .show {
    display: block;
  }
</style>

<body>
  <?php
  require '../include/header.php';
  ?>
  <div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Register</h2>
    <form action="register.php" method="post" class="mx-auto" style="max-width: 600px;">
      <div class="form-outline mb-4">
        <label for="email" class="form-label">Email</label>
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

      <div class="form-outline mb-4">
        <label for="c_password" class="form-label">Confirm Password</label>
        <input type="password" name="c_password" class="form-control" id="c_confirm" required>
      </div>

      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary w-40 rounded">Register</button>
      </div> 
      <div class="error-message error-message-user">Email already exists!</div>
      <div class="error-message error-message-password">Password do not match! Try again!</div>
      <div class="text-center">
        <p>Already a member? <a href="login.php" class="text-primary">Login</a></p>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <?php require '../include/footer.php'; ?>

</body>
</html>