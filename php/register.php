<?php

    session_start();
    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    if ( !isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['teacher_id'], $_POST['password_1'], $_POST['password_2']) ) {
        // Could not get the data that should have been sent.
        exit('Please fill all the fields!');
    }

    if ($_POST['password_1'] != $_POST['password_2']) {
        // Password and reconfirm. password are not the same.
        exit('Password and confirm password do not match.');
    }

    $conn = new mysqli('localhost', 'root', '', 'online_academy');

    if($conn->connect_error) {
        die("Connection failed!");
    }
    else {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $teacher_id = $_POST['teacher_id'];
        $password = $_POST['password_1'];

        $sql = "select * from online_academy.teacher where teacher_id='$teacher_id'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        
        // If result matched same teacher id did not exist already   
        if($count == 0) {
            $sql = "insert into teacher(first_name, last_name, email, teacher_id, password) values('$first_name', '$last_name', '$email', '$teacher_id', '$password')";
    
            $result=mysqli_query($conn, $sql);    
            if($result){    
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $teacher_id;
                mysqli_close($conn);
                echo "Account Successfully Created";    
                header('Location: ../html/white_board.html');
            }
            else {    
                echo "Failure!";    
            }       
        }
        else {    
            echo "That teacher id already exists!";    
        }    

    }

?>