<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="main.js" ></script>
</head>
<body>
    <?php

        print_r($_POST);

        session_start();
        if (!isset($_SESSION['user']) || !isset($_SESSION['name'])) {
            header('Location: login.php');
            exit();
        }
        $username = $_SESSION['user'];
        $fullname_user = $_SESSION['name'];
        include 'connection.php';
        $conn = openMySQLConnection();
        
        if(isset($_POST['action'])){
            if($_POST['action']=='delete-class'){
                if(isset($_POST['key'])){
                    $key_delete = $_POST['key'];
                    if(check_role($username,$key_delete)){
                        if(remove_class_by_key($key_delete)){
                            echo "<script type='text/javascript'>alert('Đã xóa lớp học');</script>";
                        }
                        else{
                            echo "<script type='text/javascript'>alert('Xóa lớp học thất bại, vui lòng kiểm tra lại');</script>";
                        }
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Bạn không có quyền xóa lớp học này, hoặc lớp học cần xóa không hợp lệ');</script>";
                    }
                    
                }
                else{
                    echo "<script type='text/javascript'>alert('Vui lòng chọn lớp học cần xóa');</script>";
                }
            }
            
            if($_POST['action']=='edit-class'){
                if(isset($_POST['key'])){
                    $key_update = $_POST['key'];
                    
                    if(check_role($username,$key_update)){
                        $ten = $_POST['name'];
                        $mt = $_POST['desc'];
                        $phan = $_POST['part'];
                        $phong = $_POST['room'];
                        $cd = $_POST['topic'];
                        if(strlen($ten)==0){
                            echo "<script type='text/javascript'>alert('Vui lòng nhập tên');</script>";
                        }
                        else{
                            if(update_class($key_update,$ten,$mt,$phan,$phong,$cd)){
                                echo "<script type='text/javascript'>alert('cập nhật lớp học $ten thành công');</script>";
                            }
                            else{
                                echo "<script type='text/javascript'>alert('cập nhật lớp học thất bại');</script>";
                            }
                        }
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Bạn không có quyền sửa lớp học này, hoặc lớp học cần xóa không hợp lệ');</script>";
                    }
                }
            }
        }
        
        //remove row class in sql
        function remove_class_by_key($key_delete){
            $sql = "DELETE FROM `lophoc` WHERE `codelop`='$key_delete'";
            $conn = openMySQLConnection();
            if($conn->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }

        //check role của người dùng, nếu hợp lê thì true, else thì false
        function check_role($username,$keylop){
            $codeRole = 99;
            $sql = "SELECT role FROM account_lophoc INNER JOIN lophoc on account_lophoc.idLop = lophoc.idLop WHERE account_lophoc.username ='$username' AND lophoc.codelop = '$keylop'";
            $conn = openMySQLConnection();
            $result = $conn->query($sql);
            if(!$result){
                trigger_error('Invalid query' . $conn->error);
            }
            
            if($result->num_rows>0){
                $row = $result->fetch_assoc();
                $codeRole = $row['role'];
            }
            if($codeRole<2){
                return true;
            }
            else{
                return false;
            }
        }

        function update_class($key,$ten,$mota, $phan, $phong, $chude ){
            $sql = "UPDATE `lophoc` SET `tenLop`='$ten',`motaLop`='$mota',`phanHoc`='$phan',`phongHoc`='$phong',`chude`='$chude' WHERE `codelop`='$key'";
            $conn = openMySQLConnection();
            if($conn->query($sql)){
                return true;
            }
            else{
                return false;
            }
        }

        function create_class($ten,$mota, $phan, $phong, $chude){
            $seed = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789');
            shuffle($seed);
            $rand = '';
            foreach (array_rand($seed, 15) as $k) $rand .= $seed[$k];
            //genaration code;
            echo($rand);
        }

        
    ?>
    <div class="title-first">
        <nav class="navbar navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tạo lớp học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"  data-toggle="modal" data-target="#join-class" >Tham gia lớp học</a>
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
        <!-- <div id="myDropdown" class="dropdown-content" style="display: none">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div> -->
        
        <button class="btn-user" class="fa fa-trash action" data-toggle="modal" data-target="#manager-account"></button>
    </div>

    <div class="container">
        <div class="row">
            <?php
                $sql = "SELECT lophoc.tenLop, lophoc.motaLop, lophoc.codelop, account_lophoc.role, lophoc.phanHoc, lophoc.phongHoc, lophoc.chude FROm account_lophoc INNER JOIN lophoc ON account_lophoc.idLop = lophoc.idLop INNER JOIN account on account.username = account_lophoc.username WHERE account.username ='$username'";
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
                        $room = $row['phongHoc'];
                        $phanhoc = $row['phanHoc'];
                        $chude = $row['chude'];
                        // print_r($row);
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
                                    <button  id='btn-edit' class='btn btn-warning' data-toggle='modal' data-target='#modalSualophoc' onclick=\"showEditClass('$tenlop','$mota','$phanhoc','$room','$chude','$codelop')\">Sửa</button>
                                    <button id='btn-view' class = 'btn btn-danger' data-toggle='modal' data-target='#modalXoalophoc' onclick=\"showDeleteClass('$codelop','$tenlop')\"> Xóa</button>
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
                        <h4 class="modal-title">Tham gia lớp học</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <label for="code"><b>Mã tham gia lớp học</b></label>
                        <br>
                        <input type="text" id="code" placeholder="Code" name="key">
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="action" value="join-class" id="action-delete">
                        <!-- <input type="hidden" name="key" value="12121" id="id-join"> -->
                        <button type="submit" class="btn btn-success" >Tham gia</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
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
                        <p>Bạn có chắc chắn xóa lớp học <strong id='nameClassDel'></strong> này không?</p>
                    </div>
                    <div class="modal-footer" >
                        <input type="hidden" name="action" value="delete-class" id="action-delete">
                        <input type="hidden" name="key" value="12121" id="key-delete">
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
                        <label for="name-class"><b>Tên lớp học</b></label>
                        <br>
                        <input type="text" id="name-class" placeholder="Tên lớp học(bắt buộc)" name="name">
                        <br>
                        <label for="desc-class"><b>Mô tả lớp học</b></label>
                        <br>
                        <input type="text" id="desc-class" placeholder="Mô tả lớp học(tùy chọn)" name="desc">
                        <br>
                        <label for="part-class"><b>Phần học</b></label>
                        <br>
                        <input type="text" id="part-class" placeholder="Phần học (tùy chọn)" name="part">
                        <br>
                        <label for="room-class"><b>Phòng học</b></label>
                        <br>
                        <input type="text" id="room-class" placeholder="Phòng học (tùy chọn)" name="room">
                        <br>
                        <label for="chude-class"><b>Chủ đề</b></label>
                        <br>
                        <input type="text" id="chude-class" placeholder="Chủ đề (tùy chọn)" name="topic">
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="action" value="edit-class" id="action-edit">
                        <input type="hidden" name="key" value="121321323132" id="key-edit">
                        <button type="submit" class="btn btn-success" >Cập nhật</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>
