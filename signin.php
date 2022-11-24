<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ugly Lil Website</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS-->
    <link rel=stylesheet href="bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <!-- Own CSS-->
    <link rel="stylesheet" href = "main.css">
</head>


<body id="index-body" >


    <!-- Navbar Start-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="images/theLogo.jpg" alt="" width="30" height="30"  class="d-inline-block align-top" alt="Logo">
            Symphony Official Store </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">HOME</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">SIGN IN<span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0 mx-1">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
        <button class="btn btn-outline-secondary my-2 mx-2 my-sm-0" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <span class="badge bg-light text-dark ms-1 rounded-pill">0</span>
        </button>  
    </form>
    </div>
  </nav>
<!-- Navbar End-->

  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
  
          <div class="d-flex align-items-center" >
  
            <form id="logInForm" style="width: 23rem;" >

            <h3 class="fw-normal mb-3 pb-3 text-light ">Log in</h3>

            <div class="form-outline mb-4">
              <input type="email" id="formEmail" class="form-control form-control-lg" />
              <label class="form-label text-secondary " for="formEmail">Email address</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="formPassword" class="form-control form-control-lg" />
              <label class="form-label text-secondary" for="formPassword">Password</label>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-secondary btn-lg btn-block" type="button">Login</button>
            </div>

            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
            <p class="text-muted" >Don't have an account? <a href="registration.php" class="text-light">Register now</a></p>

          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="images/instrument-1.jpg"
          alt="Login image" class="w-100 h-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>
</body>


<footer>
</footer>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="bootstrap-4.6.2-dist/js/bootstrap.min.js"></script>

</body>
</html>