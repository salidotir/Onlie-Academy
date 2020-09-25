<?php

    session_start();
    
    $conn = new mysqli('localhost', 'root', '', 'online_academy');

    if($conn->connect_error) {
        die("Connection failed!");
    }
    else {
        $t = $_SESSION['name'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $sql = "update online_academy.teacher set first_name='$first_name', last_name='$last_name', email='$email' where teacher_id='$t'";
        $result = mysqli_query($conn,$sql);
        
        if($result) {
            echo "profile edited successfully.";
            header('Location: ../html/profile.php');
            mysqli_close($conn);
        }
        else {
            echo "Failure!"; 
        }
    }

?>