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
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE t_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['t_title'];
        $desc = $row['t_desc'];
        $thread_user_id = $row['t_user_id'];
        // To find the name of the poster
        $sql2 = "select user_email from `users` where sno=$thread_user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>
    <?php 
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        //Insert comment into db
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt;",$comment);
        $comment = str_replace(">","&gt;",$comment);
        $sno = $_POST['sno'];  
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`)
         VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong> Success!</strong> Your comment has been posted. Thank you for your contribution.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }
    ?>
    <div class="p-5 bg-light rounded-3">
        <div class="container py-5">
            <h1 class="display-5 fw-bold"><?php echo $title;?></h1>
            <p class="col-md-8 fs-4">
                <?php echo $desc;?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not PM users asking for help.
                Remain respectful of other members at all times.</p>
            <p>Posted by: <em><?php echo $posted_by;?></em></p>
        </div>
    </div>
    <?php 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
        <h1 class="py-2">
            Post a Comment
        </h1>
        <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
            <div class="mb-3">
                <label for="comment" class="form-label">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
             </div>
            <button type="submit" class="btn btn-success">Post comment</button>
        </form>
    </div>';
    }
    else {
        echo '<div class="container">
        <h1 class="py-2">
            Post a Comment.
        </h1>
        <p class="lead"><mark>You are not logged in. You need to log in to post a comment.</mark></p>
    </div>';
    }

    ?>
    <div class="container mb-5">
        <h1 class="py-2">
            Discussions
        </h1>
        <?php 
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id =$id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $time = $row['comment_time'];
        $thread_user_id = $row['comment_by'];
        $sql2 = "select user_email from `users` where sno=$thread_user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        echo '<div class="d-flex mb-3 mb-2">
            <div class="flex-shrink-0">
                <img src="/forum/img/user.jpg" width="54px" alt="...">
            </div>

            &nbsp; 
            <div class="flex-grow-1 ms-3">
            <p class="fw-bold my-0">'.$row2['user_email'].' at '.$time.'</p>
                '. $content .' 
            </div>
        </div>';
    }
    if($noResult){
        echo '<div class="p-5 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5"> No Comments Found</h1>
        <p class="col-md-8 fs-4">
             Be the first person to answer this question
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