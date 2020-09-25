<?php
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: profile.html');
        exit;
    }
?>

<html>
    <script type="text/javascript">
        var canvas, ctx, flag = false,
            prevX = 0,
            currX = 0,
            prevY = 0,
            currY = 0,
            dot_flag = false;

        var x = "black",
            y = 2;
        
        function init() {
            canvas = document.getElementById('can');
            ctx = canvas.getContext("2d");
            w = canvas.width;
            h = canvas.height;
        
            canvas.addEventListener("mousemove", function (e) {
                findxy('move', e)
            }, false);
            canvas.addEventListener("mousedown", function (e) {
                findxy('down', e)
            }, false);
            canvas.addEventListener("mouseup", function (e) {
                findxy('up', e)
            }, false);
            canvas.addEventListener("mouseout", function (e) {
                findxy('out', e)
            }, false);
        }
        
        function color(obj) {
            switch (obj.id) {
                case "green":
                    x = "green";
                    break;
                case "blue":
                    x = "blue";
                    break;
                case "red":
                    x = "red";
                    break;
                case "yellow":
                    x = "yellow";
                    break;
                case "orange":
                    x = "orange";
                    break;
                case "black":
                    x = "black";
                    break;
                case "white":
                    x = "white";
                    break;
            }
            if (x == "white") y = 14;
            else y = 2;
        
        }
        
        function draw() {
            ctx.beginPath();
            ctx.moveTo(prevX, prevY);
            ctx.lineTo(currX, currY);
            ctx.strokeStyle = x;
            ctx.lineWidth = y;
            ctx.stroke();
            ctx.closePath();
        }
        
        function erase() {
            var m = confirm("Want to clear");
            if (m) {
                ctx.clearRect(0, 0, w, h);
                document.getElementById("canvasimg").style.display = "none";
            }
        }
        
        function findxy(res, e) {
            if (res == 'down') {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop;
        
                flag = true;
                dot_flag = true;
                if (dot_flag) {
                    ctx.beginPath();
                    ctx.fillStyle = x;
                    ctx.fillRect(currX, currY, 2, 2);
                    ctx.closePath();
                    dot_flag = false;
                }
            }
            if (res == 'up' || res == "out") {
                flag = false;
            }
            if (res == 'move') {
                if (flag) {
                    prevX = currX;
                    prevY = currY;
                    currX = e.clientX - canvas.offsetLeft;
                    currY = e.clientY - canvas.offsetTop;
                    draw();
                }
            }
        }
    </script>
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
    
        <title>White Board</title>
    </head>

    <body onload="init()">

        <!-- Navigation Bar -->
        <nav style="font-size: large;" class="navbar navbar-inverse">
            <div class="container">
            <div class="navbar-header">
                <img class="my-logo" src="../img/logo.png" width="90px" height="60px" />
            </div>
            <div>
                <a style="font-size: xx-large;" class="navbar-brand" href="#">&nbsp;Online Academy</a>
            </div>
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
                    <li><a href="all_classes.html">List of classes</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> User Management <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="create_student.html">Create student</a></li>
                    <li><a href="all_students.html">List of students</a></li>
                </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="profile.html"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            </ul>
            </div>
        </nav>

        <!-- White Board -->
        <h1 style="margin-top: 5px; margin-left: 700px;">White Board</h1>
        <div style="display:table;clear:both;margin-left: 70px;margin-top: 20px;margin-bottom: 20px;">
            <div style="width: 1410px; float: left;">
                <canvas id="can" width="1400px" height="550px" style="border:2px solid;"></canvas>
            </div>
            <div style="width: 20px;float: left;">
                <div style="top:20%;left:43%;">Color</div>
                <table>
                    <tr>
                        <td><div style="top:15%;left:45%;width:10px;height:10px;background:green;" id="green" onclick="color(this)"></div></td>
                        <td><div style="top:15%;left:46%;width:10px;height:10px;background:blue;" id="blue" onclick="color(this)"></div></td>
                        <td><div style="top:15%;left:47%;width:10px;height:10px;background:red;" id="red" onclick="color(this)"></div></td>
                    </tr>

                    <tr>
                        <td><div style="top:17%;left:45%;width:10px;height:10px;background:yellow;" id="yellow" onclick="color(this)"></div></td>
                        <td><div style="top:17%;left:46%;width:10px;height:10px;background:orange;" id="orange" onclick="color(this)"></div></td>
                        <td><div style="top:17%;left:47%;width:10px;height:10px;background:black;" id="black" onclick="color(this)"></div></td>
                    </tr>
                </table>
                
                <table>
                    <img id="canvasimg" style="position:absolute;top:10%;left:52%;" style="display:none;">
                    <tr>
                        <td><div style="top:20%;left:43%;">Eraser</div></td>
                        <td><div style="top:22%;left:45%;width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div></td>
                    </tr>
                    <tr>
                        <td><input type="button" value="clear" id="clr" size="23" onclick="erase()" style="top:55%;left:15%;"></td>
                    </tr>
                </table>
            </div>
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