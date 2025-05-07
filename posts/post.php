<?php
include '../db/db.php';
if (isset($_GET['post_id'])) {
    $id = $_GET['post_id'];

    $query = "SELECT * FROM posts WHERE id = '$id'";
    $result = mysqli_query($con, $query);
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
    while ($rows = mysqli_fetch_assoc($result)) :
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
                        <!-- <p>
                            Placeholder text by
                            <a href="http://spaceipsum.com/">Space Ipsum</a>
                            &middot; Images by
                            <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
                        </p> -->
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile ?>

    <?php include '../include/footer.php' ?>
</body>

</html>