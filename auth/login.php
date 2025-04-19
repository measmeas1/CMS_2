<?php
  include '../db/db.php';

  if(isset($_SESSION['username'])){
    header("location: http://localhost/CMS%20Project%202/index.php");
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
  
    // Check if the email exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
  
    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
  
      // Verify password
      if (password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
  
        echo "<script>window.location.href = '../index.php';</script>";
      } else {
        // Password incorrect
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                  document.querySelector('.error-message-password').classList.add('show');
                });
              </script>";
      }
    } else {
      // Email doesn't exist
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('.error-message-user').classList.add('show');
              });
            </script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
  <?php include '../include/header.php' ?>

  <div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Login</h2>
    <form action="login.php" method="post" class="mx-auto" style="max-width: 600px;">
      <div class="mb-4">
        <label for="Email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary w-40 rounded">Login</button>
      </div>
      <div class="error-message error-message-user">Email doesn't exists!</div>
      <div class="error-message error-message-password">Password is incorrect!</div>
    </form>
    <p class="text-center">Create an Account <a href="register.php" class="text-primary">Register</a></p>
  </div>

  <?php include '../include/footer.php' ?>
</body>

</html>