<?php 
  include '../db/db.php';
  include '../config/config.php';

  if(isset($_GET['del_id'])){
    $id = $_GET['del_id'];

    $select = "SELECT img FROM posts WHERE id='$id'";
    $result = mysqli_query($con, $select);

    if($result && mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      $imgPath = 'images/' . $row['img'];

      // Step 2: Delete the image if it exists
      if(!empty($row['img']) && file_exists($imgPath)){
        unlink($imgPath);
      }
    }

    $query = "DELETE FROM posts WHERE id = '$id'";
    if(mysqli_query($con, $query)){
      header("location: ". BASE_URL. "index.php");
      exit();
    }else{
      echo "Error: ". mysqli_error($con);
    }
  }
?>