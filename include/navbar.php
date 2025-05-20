<?php include $_SERVER['DOCUMENT_ROOT'] . '/cms_project_2/config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
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
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.html">CMS Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL;?>index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL;?>posts/create.php">Create</a></li>
                        <li class="nav-item dropdown mt-lg-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu rounded" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>users/profile.php?pf_id=<?php echo $_SESSION['id'] ?>">Profile</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>auth/logout.php">Logout</a></li>
                                <!-- <li>
                                <hr class="dropdown-divider">
                            </li> -->
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL; ?>auth/login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL; ?>auth/register.php">Register</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>