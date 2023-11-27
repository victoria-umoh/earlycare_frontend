<!-- HOMEPAGE NAVBAR -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="A personal healthcare monitoring web application" />
    <meta name="keywords" content="personal healthcare monitoring app, healthcare tracking app" />
    <meta name="author" content="victoria-umoh" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous" />
    <link href="assets/css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500&family=Montserrat:wght@500;700&family=Nunito+Sans:opsz@6..12&family=PT+Serif&family=Roboto+Slab&family=Roboto:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css" crossorigin="anonymous" />
    <title>Home Page</title>
<style type="text/css">
  .overlay{
      background-image: linear-gradient(to top,
      rgba(0,0,0,0.7),
      rgba(0,0,0,0.7)),
      url("assets/images/pic9.webp");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: absolute;
    }
</style>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top" style="background-color:#143566;">
    <div class="container-fluid p-3" style="background-color:#143566;">
    <h1 class=""><a class="navbar-brand brandname text-white" href="#">EarlyCare</a></h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse custom_navlink_div" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-light custom_nav_link">
        <li class="nav-item"><a class="nav-link active text-light" aria-current="page" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link active text-light" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link active text-light" href="contact.html">Contact</a></li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle text-light" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Plan</a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="plan.html">Basic</a></li>
            <li><a class="dropdown-item" href="plan.html">Standard</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="plan.html">Premium</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <a class="btn btn-danger rounded-pill navbar_btn" type="button" href="login.html">Log in</a>
        <a class="btn btn-light text-black mx-2 rounded-pill navbar_btn" type="button"href="signup.html">Sign Up</a>
      </form>
    </div>
  </div>
</nav>
<!-- Navbar -->



