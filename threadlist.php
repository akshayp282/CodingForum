<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Programming Forum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/_header.php' ?>
    <?php 
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>

    <?php 
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        //Insert thread into db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<","&lt;",$th_title);
        $th_title = str_replace(">","&gt;",$th_title);
        $th_desc = str_replace("<","&lt;",$th_desc);
        $th_desc = str_replace(">","&gt;",$th_desc);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`t_title`, `t_desc`, `t_cat_id`, `t_user_id`, `timestamp`) 
        VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#check-circle-fill"/></svg>
                <strong> Success!</strong> Your query has been posted. Please wait for the community to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }
    ?>

    <div class="p-5 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Welcome to <?php echo $catname;?> forums</h1>
            <p class="col-md-8 fs-4">
                <?php echo $catdesc;?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
            <button class="btn btn-dark btn-lg" type="button"><?php echo $catname;?></button>
        </div>
    </div>
    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
            <h1 class="py-2">
                Start a Discussion
            </h1>
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Problem Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby=" emailHelp">
        <div id="emailHelp" class="form-text">Title should be concise and self explanatory.</div>
    </div>
    <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
    <div class="mb-3">
        <label for="desc" class="form-label">Elaborate your concern</label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>';
    }
    else {
        echo '<div class="container">
        <h1 class="py-2">
            Start a Discussion
        </h1>
        <p class="lead"><mark>You are not logged in. You need to log in to start a discussion.</mark></p>
    </div>';
    }

    ?>

    <div class="container mb-5">
        <h1 class="py-2">
            Browse Questions
        </h1>
        <?php 
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE t_cat_id =$id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['t_id'];
        $title = $row['t_title'];
        $desc = $row['t_desc'];
        $thread_time = $row['timestamp'];  
        $thread_user_id = $row['t_user_id'];
        $sql2 = "select user_email from `users` where sno=$thread_user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        
       echo '<div class="d-flex mb-3 mb-2">
            <div class="flex-shrink-0">
                <img src="/forum/img/user.jpg" width="54px" alt="...">
            </div>

            &nbsp;
             <div class="flex-grow-1 ms-3">
            <h5 class="mt-2"><a class="text-dark text-decoration-none" href="thread.php?threadid='.$id.'">'. $title .'</a></h5>
                '. $desc .'
            </div>
            <p class="fw-bold mb-0">Asked by: '.$row2['user_email'].' at '.$thread_time.'</p>
        </div>';
    }
    if($noResult){
        echo '<div class="p-5 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5"> No Threads Found</h1>
        <p class="col-md-8 fs-4">
             Be the first person to ask a question
        </p>

    </div>
    </div>';
    }
    ?>
    </div>
    <?php include 'partials/_footer.php' ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>