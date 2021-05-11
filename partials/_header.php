<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/forum">Coding Forum</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
          $sql = "SELECT category_name,category_id FROM `categories` LIMIT 5";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row["category_name"].'</a></li>';
          }
         echo '</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/contact.php" tabindex="-1">Contact</a>
        </li>
      </ul>';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<p class="text-light my-0 mx-2">Welcome '.$_SESSION['useremail'].' </p>
         <a href="partials/_logout.php" class="btn btn-outline-danger mx-2">Logout</a>';
      }
      else{
        echo '<div class="mx-2">
      <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#loginModal">Log In</button>
      <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</button>
      </div>';
      }
      echo ' <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>';
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true'){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You can login now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'false'){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Whoopsie!</strong> '.$_GET['error'].'.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
if(isset($_SESSION['wrong_pass']) && $_SESSION['wrong_pass'] == true){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                  <strong> Bonk!</strong> Type that password again. 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
      unset($_SESSION['wrong_pass']);
}
/*
else if(isset($_SESSION['unreg_user']) && $_SESSION['unreg_user'] == true){
echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    <strong> Hey Stranger!</strong> You gotta sign up before logging in my friend.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}*/
?>