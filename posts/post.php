<?php
include '../db/db.php';
include '../config/config.php';
if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];

    $query = "SELECT * FROM posts WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_assoc($result);
}else{
    header("location: ". BASE_URL."404.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post Page</title>
</head>

<body>
    <?php
    include '../include/navbar.php';
    ?>
        <header class="masthead" style="background-image: url('images/<?php echo $rows['img'] ?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $rows['title'] ?></h1>
                            <h2 class="subheading"><?php echo $rows['subtitle'] ?></h2>
                            <span class="meta">
                                Posted by
                                <a href="#!"><?php echo $rows['user_name'] ?></a>
                                on <?php echo date('F j, Y', strtotime($rows['create_at'])) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p><?php echo $rows['description']  ?></p>
                        <p class="d-flex justify-content-between">
                            <?php if(isset($_SESSION['id']) AND $_SESSION['id'] == $rows['user_id']) : ?>
                            <a class="btn btn-warning rounded" href="<?php echo BASE_URL?>posts/update.php?update_id=<?php echo $rows['id']?>">Update</a>
                            <a class="btn btn-danger rounded" href="<?php echo BASE_URL?>posts/delete.php?del_id=<?php echo $rows['id'] ?>">Delete</a>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
            </div>
        </article>

    <?php include '../include/footer.php' ?>
</body>

</html>