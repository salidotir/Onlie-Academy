<?php

    session_start();
    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    if ( !isset($_POST['formTecherId'], $_POST['formPassword']) ) {
        // Could not get the data that should have been sent.
        exit('Please fill both the username and password fields!');
    }


    $conn = new mysqli('localhost', 'root', '', 'online_academy');

    if($conn->connect_error) {
        die("Connection failed!");
    }
    else {
        $teacher_id = $_POST['formTecherId'];
        $password = $_POST['formPassword'];

        $sql = "select * from online_academy.teacher where teacher_id='$teacher_id' and password='$password'";
        $result = mysqli_query($conn,$sql);
        
        $count = mysqli_num_rows($result);
        
        // If result matched $myusername and $mypassword, table row must be 1 row   
        if($count == 1) {
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $teacher_id;
            mysqli_close($conn);
            echo 'Welcome, Teacher Id: ' . $_SESSION['name'] . '!';
            header('Location: ../html/white_board.html');
        }

        else {
           $error = "Your Login Name or Password is invalid";
           session_destroy();
           echo "wrong input!";
        }
    }


    
/*
    $teacher_id = $_POST['formTecherId'];
    $password = $_POST['formPassword'];

    if($teacher_id=='admin' and $password=='admin'){
        // Verification success! User has loggedin!
        // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $teacher_id;
        echo 'Welcome, Teacher Id: ' . $_SESSION['name'] . '!';
        header('Location: ../html/white_board.html');
    }
    else{
        echo "wrong input!";
    }
*/

?>