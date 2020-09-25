<?php

    session_start();
    
    $conn = new mysqli('localhost', 'root', '', 'online_academy');

    if($conn->connect_error) {
        die("Connection failed!");
    }
    else {
        $t = $_SESSION['name'];
        $old_pass = $_POST['old_pass'];
        $new_pass_1 = $_POST['new_pass_1'];
        $new_pass_2 = $_POST['new_pass_2'];
        if($new_pass_1 == $new_pass_2) {

            $sql = "update online_academy.teacher set password='$new_pass_1' where teacher_id='$t' and password='$old_pass'";
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
        echo "Password and confirm passowrd do not match!"; 
    }

?>