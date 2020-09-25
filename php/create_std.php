<?php

    $conn = new mysqli('localhost', 'root', '', 'online_academy');

    if($conn->connect_error) {
        die("Connection failed!");
    }
    else {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $std_no = $_POST['std_number'];

        $sql = "select * from online_academy.student where student_number='$std_no'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        
        // If result matched same teacher id did not exist already   
        if($count == 0) {
            $sql = "insert into student(first_name, last_name, student_number) values('$first_name', '$last_name', '$std_no')";

            $result=mysqli_query($conn, $sql);    
            if($result){    
                mysqli_close($conn);
                echo "Student added successfully.";    
                header('Location: ../html/all_students.php');
            }
            else {    
                echo "Failure!";    
            }       
        }
        else {    
            echo "That student id already exists!";    
        }    

    }

?>