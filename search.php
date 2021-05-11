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
    <!-- Search Results -->
    <div class="container my-3">
        <h1 class="py-3"> Search results for
            <em>"<?php echo $_GET['search']?>"</em>
        </h1>
        <?php 
        $search = $_GET['search']; 
        $sql = "select * from threads where match(t_title,t_desc) against ('$search')";
        $result = mysqli_query($conn, $sql);
        $noresults = true;
        while($row = mysqli_fetch_assoc($result)){
            $noresults =false;
            $title = $row['t_title'];
            $desc = $row['t_desc'];
            $thread_id = $row['t_id'];
            $url = "thread.php?threadid=".$thread_id;
            // Display the result
            echo '<div class="result">
                <h3 class="text-dark"><a href="'.$url.'" class="text-dark text-decoration-none">'. $title.'</h3>
                <p class="text-decoration-none">'.$desc.'</p>
            </div>';
        }
        if($noresults){
            echo '<div class="p-5 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5"> No Results Found</h1>
            <p class="col-md-8 fs-4">
                    Suggestions:<ul>
                    <li>Make sure that all words are spelled correctly.</li>
                    <li>Try different keywords.</li>
                    <li>Try more general keywords.</li>
                    </ul>
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
</body>

</html>