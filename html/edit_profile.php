<?php

  session_start();
  
  $conn = new mysqli('localhost', 'root', '', 'online_academy');

  if($conn->connect_error) {
      die("Connection failed!");
  }
  else {
    $t = $_SESSION['name'];
    $sql = "select * from online_academy.teacher where teacher_id='$t'";
    $result = mysqli_query($conn,$sql);
    
    if($result) {
      $row = mysqli_fetch_row($result);

      $first_name = strval($row[0]);
      $last_name = strval($row[1]);
      $email = strval($row[2]);
      $teacher_id = strval($row[3]);  
      
      mysqli_close($conn);
    }
    else {
      echo "Failure!"; 
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JS -->

    <!-- CSS -->
    <link rel="stylesheet" href="../css/index.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <title>Edit Profile</title>
</head>
<body style="background-color: rgb(238, 238, 238);">

    <!-- Navigation Bar -->
    <nav style="font-size: large;" class="navbar navbar-inverse">
      <div class="container">
      <div class="navbar-header">
          <img class="my-logo" src="../img/logo.png" width="90px" height="60px" />
      </div>
      <div>
          <a style="font-size: xx-large;" class="navbar-brand" href="#">&nbsp;Online Academy</a>
      </div>
      </div>
      <div class="container">
      <div class="row my-logo">
      <ul class="nav navbar-nav">
          <li><a href="white_board.html">White Board</a></li>
          <li><a href="chatroom.html">Chat Room</a></li>
          <li><a href="video_streaming.html">Video Streaming</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> Quizes <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="create_quiz.html">Create quiz</a></li>
              <li><a href="answer_quiz.html">Answer quiz</a></li>
              <li><a href="all_quizes.html">List of quizes</a></li>
          </ul>
          </li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> Class Management <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href="create_class.html">Create class</a></li>
              <li><a href="all_classes.php">List of classes</a></li>
              </ul>
          </li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> User Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="create_student.html">Create student</a></li>
              <li><a href="all_students.php">List of students</a></li>
          </ul>
          </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li style="display: inline-block;"><a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
          <li style="display: inline-block;"><a href="../php/logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
      </ul>
      </div>
      </div>
    </nav>

    <!-- Edit Profile -->
    <div class="container" style="font-size: large;">
      <form action="../php/edit_profile_info.php" method="post">
      <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
          <h1 style="margin-left: 160px;" class="margin-bottom">Edit your profile</h1>

          <div class="form-group">
          <label class="control-label" for="formFirstName">First Name: </label>
          <input type="text" name="first_name" class="form-control" id="formFirstName" value="<?php echo $first_name ?>" required/>
          </div>

          <div class="form-group">
            <label class="control-label" for="formLastName">Last Name: </label>
            <input type="text" name="last_name" class="form-control" id="formLastName" value="<?php echo $last_name ?>" required/>
          </div>

          <div class="form-group">
            <label class="control-label" for="formEmail">Email: </label>
            <input type="email" name="email" class="form-control" id="formEmail" value="<?php echo $email ?>" required/>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <input type="submit" value="Save" class="btn btn-success btn-lg btn-block" />
            </div>

            <div class="col-sm-6">
              <a href="profile.php" class="btn btn-primary btn-lg btn-block" role="button">Cancel</a>
            </div>
          </div>

      </div>
      <div class="col-sm-3"></div>
      </div>
      
      </form>
    </div>

    <!-- Footer -->
    <nav style="color: aliceblue; font-size: large;" class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="container">
        <div class="row my-logo">
          <h2>Contacts</h2>
        </div>
        <div class="row my-logo">
            <div class="col-sm-4">
                <b>Designed by: </b>Sara Limooee
                <br/>
                <b>Email: </b>salidotir@gmail.com
            </div>

            <div class="col-sm-4">
                <b>Telegram: &nbsp; </b> <a href="https://t.me/salidotir" title="@salidotir"><img className="icon-class" width="30px" height="30px" src="../icon/telegram.png" alt=""/></a>
                <br/>
                <b>Github: &nbsp; </b> <a href="https://github.com/salidotir" title="salidotir"><img className="icon-class" width="30px" height="30px" src="../icon/github.png" alt=""/></a>
            </div>
        </div>
      </div>
    </nav>
    
</body>
</html>