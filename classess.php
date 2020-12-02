<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php

        
        session_start();
        if (!isset($_SESSION['user']) || !isset($_SESSION['name'])) {
            header('Location: login.php');
            exit();
        }
        
        
        // function check_role($username,$keylop){
        //     $sql = "SELECT role FROM account_lophoc INNER JOIN lophoc on account_lophoc.idLop = lophoc.idLop WHERE account_lophoc.username ='$username' AND lophoc.codelop = '$keylop'";
            
        // }

        
    ?>
    <div class="title-first">
        <nav class="navbar navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="name-title">
            <b id="t">T</b>
            <b id="d">D</b>
            <b id="t">T</b>
            <b>&nbsp;Classroom</b>
        </div>
        
        <button class="btn-add"><i class="fa fa-plus" class="fa fa-trash action" onclick="myFunction()"></i></button>
        <div id="myDropdown" class="dropdown-content" style="display: none">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
        
        <button class="btn-user" class="fa fa-trash action" data-toggle="modal" data-target="#manager-account"></button>
    </div>

    <div class="container">
        <div class="row">
            <?php
                include 'connection.php';
                $username = $_SESSION['user'];
                $fullname_user = $_SESSION['name'];
                $conn = openMySQLConnection();
                $sql = "SELECT lophoc.tenLop, lophoc.motaLop, lophoc.codelop, account_lophoc.role FROm account_lophoc INNER JOIN lophoc ON account_lophoc.idLop = lophoc.idLop INNER JOIN account on account.username = account_lophoc.username WHERE account.username ='$username'";
                $result = $conn->query($sql);
                if(!$result){
                    trigger_error('Invalid query' . $conn->error);
                
                }
                $counter = 0;
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        
                        $counter = $counter + 1;
                        $tenlop = $row['tenLop'];
                        $mota = $row['motaLop'];
                        $codelop = $row['codelop'];
                        $role = $row['role'];
                        if($role==1){
                            echo "<div class='col-sm-6 col-md-4 col-lg-3'>
                            <div class='card'>
                                <img class='card-img-top' src='./images/background-classroom.jpg' alt='Card image cap'>
                                <div class='card-body'>
                                    <a class='card-title' href='#'>$tenlop</a>
                                    <p class='name-teacher'>$mota</p>
                                </div>
                                <div class='card-footer' >
                                    <button  id='btn-edit' value='$codelop' class='btn btn-success'>Xem</button>
                                    <button  id='btn-edit' class='btn btn-warning' data-toggle='modal' data-target='#modalSualophoc'>Sửa</button>
                                    <button id='btn-view' class = 'btn btn-danger' data-toggle='modal' data-target='#modalXoalophoc'> Xóa</button>
                                </div>
                            </div>
                        </div>";
                        }
                        if($role == 2){
                            echo "<div class='col-sm-6 col-md-4 col-lg-3'>
                            <div class='card'>
                                <img class='card-img-top' src='./images/background-classroom.jpg' alt='Card image cap'>
                                <div class='card-body'>
                                    <a class='card-title' href='#'>$tenlop</a>
                                    <p class='name-teacher'>$mota</p>
                                </div>
                                <div class='card-footer' >
                                    <button  id='btn-edit' value='$codelop'  class='btn btn-success'>Xem</button>
                                </div>
                            </div>
                        </div>";
                        }
                    }
                }
            ?>
        </div>
    </div>

    <!--Join class dialog-->
    <div class="modal fade" id="join-class">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Join class</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <label for="code"><b>Class code</b></label>
                        <br>
                        <input type="text" id="code" placeholder="Code">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" >Join</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Account dialog-->
    <div class="modal fade" id="manager-account">
        <div class="modal-dialog">
            <div class="modal-content" id="account">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="header-account"><?php echo $username; ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img id="img-account" src="./images/person.png"/>
                        <br>
                        <br>
                        <p id="name-account"><?php echo $fullname_user;?></p>
                        <p id="email-account">Email</p>
                        <a class="btn btn-default" id="manager" href="/changepassword.php">Đổi mật khẩu</a>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" href="/logout.php">Đăng xuất</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal xoa lop hoc -->
    <div id="modalXoalophoc" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <form action="" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa lớp học</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn xóa lớp học này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>

        </div>
        
    </div>
    <!-- model sửa lop hoc -->
    <div class="modal fade" id="modalSualophoc">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Cập nhật thông tin</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <label for="code"><b>Class code</b></label>
                        <br>
                        <input type="text" id="code" placeholder="Code">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" >Join</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.btn-add')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
            }
        }
        }
    </script>
</body>
</html>
