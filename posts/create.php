<?php
include '../db/db.php';
include '../config/config.php'; //

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = mysqli_real_escape_string($con, $_POST['title']);
  $subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
  $description = mysqli_real_escape_string($con, $_POST['description']);
  $image = $_FILES['img']['name'];
  $user_id = $_SESSION['id'];
  $user_name = $_SESSION['username'];

  $dir = 'images/' . basename($image);
  if (move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {
    echo "Image uploaded successfully.<br>";
  } else {
    echo "Image upload failed.<br>";
  }

  $query = "INSERT INTO posts (title, subtitle, description, img, user_id, user_name)
          VALUES ('$title', '$subtitle', '$description', '$image', '$user_id', '$user_name')";


  if (mysqli_query($con, $query)) {
    header("location: " . BASE_URL . "index.php");
    exit();
  } else {
    echo "Error inserting: " . mysqli_error($con);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Post</title>
</head>

<body>
  <?php include '../include/header.php' ?>

  <div class="container mb-5">
    <h2 class="text-center mb-4">Create Post</h2>
    <form action="create.php" method="post" class="mx-auto" style="max-width: 600px;" enctype="multipart/form-data">
      <div class="form-outline mb-4">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control">
      </div>
      <div class="form-outline mb-4">
        <label for="subtitle" class="form-label">Subtitle</label>
        <input type="text" name="subtitle" id="subtitle" class="form-control">
      </div>
      <div class="form-outline mb-4">
        <label for="description" class="form-label">Description</label><br>
        <textarea name="description" rows="5" class="form-control"></textarea>
      </div>
      <div class="form-outline mb-4">
        <label for="img" class="form-label">Image</label>
        <input type="file" name="img" id="" class="form-control">
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary w-40 rounded">Post</button>
      </div>
    </form>
  </div>

  <?php include '../include/footer.php' ?>
</body>

</html>