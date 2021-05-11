<?php
$showError = "false";
$method = $_SERVER["REQUEST_METHOD"];
if($method == 'POST'){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "Select * from users where user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    session_start();
    if($numRows == 1){
    $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $email;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['wrong_pass'] = false;
        }
        else{
            $_SESSION['wrong_pass'] = true; 
        }
    }
    else if($numRows == 0){
     $_SESSION['unreg_user'] = true;   
    }
    header("location:".$_SERVER['HTTP_REFERER']);
}

?>