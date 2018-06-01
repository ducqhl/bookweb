<!DOCTYPE html>
<html lang="en">
<head>
    <title>BTCN08-1560142</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="icon" href="image/icon_home.png">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container my-container">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="image/icon_home.png" width="35" height="35"
                                                      class="d-inline-block align-top" alt=""> YOUKNOWN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if (!$currentUser) : ?>
                    <li class="nav-item <?php echo ($page == 'register') ? 'active' : '' ?>">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
                <?php if (!$currentUser) : ?>
                    <li class="nav-item <?php echo ($page == 'login') ? 'active' : '' ?>">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif; ?>

                <!--user permission-->
                <?php if ($currentUser) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'userwall') ? 'active' : '' ?>"
                           href="userwall.php?userId=<?php echo $_SESSION['userId']; ?>">
                            <?php echo strtoupper($currentUser['Fullname']); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <!--end user permission-->

                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">
                            Guest
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

