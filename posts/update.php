<?php
include '../db/db.php';
include '../config/config.php';
if (isset($_GET['update_id'])) {
  $id = $_GET['update_id'];
  $query = "SELECT * FROM posts WHERE id = '$id'";
  $result = mysqli_query($con, $query);
  $rows = mysqli_fetch_assoc($result);
}

$cate = "SELECT * FROM categories";
$category = mysqli_query($con, $cate);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $title = mysqli_real_escape_string($con, $_POST['title']);
  $subtitle = mysqli_real_escape_string($con, $_POST['subtitle']);
  $description = mysqli_real_escape_string($con, $_POST['description']);
  $category_id = $_POST['category_id'];

  $image = $_FILES['img']['name'];
  $old_image = $_POST['old_img'];

  if (!empty($image)) {
    $dir = 'images/' . basename($image);
    if (move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {
      if(!empty($old_image) && file_exists("images/$old_image")){
        unlink("images/$old_image");
      }else{
        echo "Image upload failed.<br>";
        $image = $old_image;
      }
    }
  } else {
    $image = $old_image; // fallback if no new image is uploaded
  }

  $update = "UPDATE posts SET title='$title', subtitle='$subtitle', description='$description', img='$image', category_id='$category_id' WHERE id = '$id'";
  if (mysqli_query($con, $update)) {
    header("Location: " . BASE_URL . "index.php");
    exit();
  } else {
    echo "Error: " . mysqli_error($con);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Post</title>
</head>

<body>
  <?php include '../include/header.php' ?>

  <div class="container mb-5">
    <h2 class="text-center mb-4">Update Post</h2>
    <form action="update.php" method="post" class="mx-auto" style="max-width: 600px;" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
  <input type="hidden" name="old_img" value="<?php echo $rows['img']; ?>">
      <div class="form-outline mb-4">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php echo $rows['title'] ?>">
      </div>
      <div class="form-outline mb-4">
        <label for="subtitle" class="form-label">Subtitle</label>
        <input type="text" name="subtitle" id="subtitle" class="form-control" value="<?php echo $rows['subtitle'] ?>">
      </div>
      <div class="form-outline mb-4">
        <label for="description" class="form-label">Description</label><br>
        <textarea name="description" rows="5" class="form-control"><?php echo $rows['description'] ?></textarea>
      </div>
      <div class="form-outline mb-4">
        <select name="category_id" class="form-select form-control" aria-label="Default select example" required>
          <option disabled selected>Select the category</option>
          <?php foreach($category as $categories) : ?>
          <option value="<?php echo $categories['id'] ?>"><?php echo $categories['name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-outline mb-4">
        <label for="img" class="form-label">Image</label>
        <input type="file" name="img" id="" class="form-control">
        <?php if (!empty($rows['img'])): ?>
          <img src="images/<?php echo $rows['img']; ?>" width="100" height="100" class="rounded-circle mt-2">
        <?php endif; ?>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary w-40 rounded">Update</button>
      </div>
    </form>
  </div>

  <?php include '../include/footer.php' ?>
</body>

</html>