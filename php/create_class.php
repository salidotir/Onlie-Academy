<?php

    session_start();

    $conn = new mysqli('localhost', 'root', '', 'online_academy');

    if($conn->connect_error) {
        die("Connection failed!");
    }
    else {
        // class code
        $highest_once_id = 0;
        $result = mysqli_query($conn, "select max(class_code) from class_once");
        if($row = mysqli_fetch_row($result)) {
            $highest_once_id = $row[0];
        }

        $highest_repeat_id = 0;
        $result = mysqli_query($conn, "select max(class_code) from class_repeat");
        if($row = mysqli_fetch_row($result)) {
            $highest_repeat_id = $row[0];
        }
        if ($highest_once_id > $highest_repeat_id) {
            $class_code = $highest_once_id + 1;
        } else {
            $class_code = $highest_repeat_id + 1;
        }

        $teacher_id = strval($_SESSION['name']);            // creator id--> teacher_id

        $class_name = strval($_POST['class_name']);         // class name

        $once_repeat = $_POST['optradio'];                  // once or repeat class
        // once selected
        if($once_repeat == "once") {

            $start_time_once = strtotime($_POST['start_time_once']);    // once start time
            $start_time_once = date('h:i A', $start_time_once);

            $date_once = strtotime($_POST['date_once']);                // once date
            $date_once = date('Y-m-d', $date_once);
           

            // add to database
            $sql = "insert into online_academy.class_once(class_code, teacher_id, start_time, date, class_name) values('$class_code', '$teacher_id', '$start_time_once', '$date_once', '$class_name')";
            $result=mysqli_query($conn, $sql);    
            if($result){    
                echo "Class created Successfully";    
                // header('Location: ../html/all_classes.php');
            }
            else {    
                echo "Failure writing in class_once table!";  
                exit;  
            }       
        }

        // repeat selected
        else if($once_repeat == "repeat") {
            $start_time_repeat = $_POST['start_time_repeat'];   // repeat start time

            // add to database
            $sql = "insert into online_academy.class_repeat(class_code, teacher_id, start_time, class_name) values('$class_code', '$teacher_id', '$start_time_repeat', '$class_name')";
            $result=mysqli_query($conn, $sql);    
            if($result){    
                echo "Class created Successfully";    
                // header('Location: ../html/all_classes.php');
            }
            else {    
                echo "Failure writing in class_repeat table!";  
                exit;  
            } 
            
            $id = 0;
            // add to class_repeate_days table
            if(isset($_POST['sat'])) {
                $result = mysqli_query($conn, "select max(id) from class_repeated_days");
                if($result) {
                    if($row = mysqli_fetch_row($result)) {
                        $id = $row[0] + 1;
                    }
                    $sql = "insert into online_academy.class_repeated_days(id, class_code, day) values('$id', '$class_code', 'Saturday')";
                    $result=mysqli_query($conn, $sql);    
                    if(!$result){    
                        echo "FailureSaturday!";  
                        exit; 
                    }
                }
            }
            
            if(isset($_POST['sun'])) {
                $result = mysqli_query($conn, "select max(id) from class_repeated_days");
                if($result) {
                    if($row = mysqli_fetch_row($result)) {
                        $id = $row[0] + 1;
                    }
                    $sql = "insert into online_academy.class_repeated_days(id, class_code, day) values('$id', '$class_code', 'Sunday')";
                    $result=mysqli_query($conn, $sql);    
                    if(!$result){    
                        echo "Failure Sunday!"; 
                        exit;  
                    }
                }
            }

            if(isset($_POST['mon'])) {
                $result = mysqli_query($conn, "select max(id) from class_repeated_days");
                if($result) {
                    if($row = mysqli_fetch_row($result)) {
                        $id = $row[0] + 1;
                    }
                    $sql = "insert into online_academy.class_repeated_days(id, class_code, day) values('$id', '$class_code', 'Monday')";
                    $result=mysqli_query($conn, $sql);    
                    if(!$result){    
                        echo "Failure Monday!";
                        exit;   
                    }
                }
            }

            if(isset($_POST['tue'])) {
                $result = mysqli_query($conn, "select max(id) from class_repeated_days");
                if($result) {
                    if($row = mysqli_fetch_row($result)) {
                        $id = $row[0] + 1;
                    }
                    $sql = "insert into online_academy.class_repeated_days(id, class_code, day) values('$id', '$class_code', 'Tuesday')";
                    $result=mysqli_query($conn, $sql);    
                    if(!$result){    
                        echo "Failure Tuesday!"; 
                        exit;  
                    }
                }
            }

            if(isset($_POST['wed'])) {
                $result = mysqli_query($conn, "select max(id) from class_repeated_days");
                if($result) {
                    if($row = mysqli_fetch_row($result)) {
                        $id = $row[0] + 1;
                    }
                    $sql = "insert into online_academy.class_repeated_days(id, class_code, day) values('$id', '$class_code', 'Wednesday')";
                    $result=mysqli_query($conn, $sql);    
                    if(!$result){    
                        echo "Failure Wednesday!"; 
                        exit;  
                    }
                }
            }

            if(isset($_POST['thu'])) {
                $result = mysqli_query($conn, "select max(id) from class_repeated_days");
                if($result) {
                    if($row = mysqli_fetch_row($result)) {
                        $id = $row[0] + 1;
                    }
                    $sql = "insert into online_academy.class_repeated_days(id, class_code, day) values('$id', '$class_code', 'Thursday')";
                    $result=mysqli_query($conn, $sql);    
                    if(!$result){    
                        echo "Failure Thursday!"; 
                        exit;  
                    }
                }
            }

            if(isset($_POST['fri'])) {
                $result = mysqli_query($conn, "select max(id) from class_repeated_days");
                if($result) {
                    if($row = mysqli_fetch_row($result)) {
                        $id = $row[0] + 1;
                    }
                    $sql = "insert into online_academy.class_repeated_days(id, class_code, day) values('$id', '$class_code', 'Friday')";
                    $result=mysqli_query($conn, $sql);    
                    if(!$result){    
                        echo "Failure Friday!";
                        exit;   
                    }
                }
            }

        }

        // add student owners to class_owner_table in database
        if(isset($_POST['std_no'])) {
            // get last id inserted in table class_std_owner
            $id = 0;
            if($result = mysqli_query($conn, "select max(id) from class_std_owner")){
                if( $row = mysqli_fetch_row($result)) {
                    $id = $row[0] + 1;
                }
            }

            $std_owners = strval($_POST['std_no']);

            $pieces = explode(",", $std_owners);

            for($i = 0; $i < count($pieces); $i=$i+1) {
                $t = strval($pieces[$i]);
                $sql = "insert into class_std_owner(id, class_code, std_number) values('$id', '$class_code', '$t')";
                $result=mysqli_query($conn, $sql);    
                if($result){   
                    $id = $id + 1;
                }
                else {
                    echo "Failure in writing students as owner in database!";
                    exit;
                }
            }
        }

        mysqli_close($conn);
        echo "Class created Successfully";    
        header('Location: ../html/all_classes.php');

    }
?>