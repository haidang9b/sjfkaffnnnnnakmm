<?php
    $root ="./uploads";
    if (!file_exists($root)){
        mkdir($root);
    }
    $error = null;
    $name = null;
    if (isset($_POST['upload-file']) && isset($_FILES['file-to-upload'])){
        if ($_FILES['file-to-upload']['error'] === 0) {
            $name = $_FILES['file-to-upload']['name'];
            $fullPath = "$root/$name";
            $size = $_FILES['file-to-upload']['size'];
            $not_allow_types = array('exe', 'msi', 'msi');
            $file_type = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array($file_type, $not_allow_types)) {
                $error = "Can't upload file with format(*.exe, *.msi, *.sh)";
            } else if (file_exists($fullPath)) {
                unlink($fullPath);
                move_uploaded_file($_FILES['file-to-upload']['tmp_name'], $fullPath);
            } else {
                move_uploaded_file($_FILES['file-to-upload']['tmp_name'], $fullPath);
            }
        }
        else{
            $name = null;
            $error = "Please choose file to upload";
        }
    }else if (isset($_POST['download'])){
        $name = $_POST['download'];
        header("Content-Length: " . filesize($name));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$name);

        readfile($name);
    }
    include 'db.php';
    $conn = openMySQLConnection();
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Thành viên</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./style-class.css">
    <link rel="stylesheet" href="./style-work.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body>
<div class="title-first">
    <nav class="navbar navbar-expand-md bg-info navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <div class="subject">
                            <b>Tên môn học - Tên giáo viên</b>
                        </div>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#"><b>Tạo lớp học</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#join-class"><b>Tham gia lớp học</b></a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <b>Lớp học</b>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Lớp 1</a>
                        <?php
                            $sql = "SELECT lophoc.tenLop, lophoc.motaLop, lophoc.codelop, account_lophoc.role, lophoc.phanHoc, lophoc.phongHoc, lophoc.chude FROm account_lophoc INNER JOIN lophoc ON account_lophoc.idLop = lophoc.idLop INNER JOIN account on account.username = account_lophoc.username WHERE account.username ='$username'";
                            
                            $result = $conn->query($sql);
                            if(!$result){
                                trigger_error('Invalid query' . $conn->error);
                            
                            }
                            $counter = 0;
                            if($result->num_rows>0){
                                while($row = $result->fetch_assoc()){
                                    $tenlop = $row['tenLop'];
                                    $codelop = $row['codelop'];
                                    echo "<a class=\"dropdown-item\" href=\"class.php?code=$codelop\">$tenlop</a>";
                                }
                            }
                        ?>
                    </div>
                </li>

                <li class="nav-item">
                    <button class="btn-user" class="fa fa-trash action" data-toggle="modal" data-target="#manager-account"></button>
                </li>
            </ul>
        </div>
    </nav>
</div>

<div class="container">
    <!-- Danh sách giáo viên -->
    <div class="row">
        <div class='col-sm-12 col-md-12 col-lg-12'>

            <div class="border rounded mb-3 mt-5 p-3">
                <form>
                    <div class="work-title">
                        <img src="./images/work.jpg">
                        <div class="name-work">
                            <h3>Tên bài tập</h3>
                            <div class="time-teacher">
                                <p>Tên giáo viên</p>
                                <p id="deadline">Thời hạn nộp bài</p>
                            </div>
                        </div>
                    </div>
                    <div class="desc">
                        Mô tả của bài tập ở đây nè
                    </div>
                    <!-- Hiển thị bình luận -->
                    <table>
                        <tr>
                            <td>
                                <img src="./images/person.png">
                                <div class="comment">
                                    <b>Tên người bình luận</b>
                                    <p>Đây là chỗ hiển thị bình luận</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <!-- Bình luận -->
                    <div class="form-group">
                        <div class="row-discuss">
                            <img src="./images/person.png">
                            <input type="text" class="form-control" placeholder="Chia sẽ với lớp mộ điều gì đó" id="discuss">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-info" id="send">Đăng</button>
                </form>
            </div>

            <div class="border rounded mb-3 mt-5 p-3">
                <h4>Bài tập của bạn</h4>
                <form enctype="multipart/form-data" id="upload-form" method="post">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file-to-upload"  id="file-to-upload">
                            <label class="custom-file-label" for="file-to-upload">Chọn file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php
                        if ($name !== null){
                            echo "File bạn đã nộp: 
                                <button class='btn btn-link' name='download' value='$name'>$name</button>";
                        }else{
                            echo "File bạn đã nộp: Không";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        if ($error !== null) {

                            echo "<div class='alert alert-warning'>
                                        $error;
                                </div>";
                            $error = null;
                        }
                        ?>
                    </div>
                    <button class="btn btn-success px-5" name="upload-file" value="Upload">Nộp bài</button>

                </form>
            </div>

        </div>
    </div>



    <!-- Quản lý tài khoản -->
    <div class="modal fade" id="manager-account">
        <div class="modal-dialog">
            <div class="modal-content" id="account">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="header-account"><?php echo $username;?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img id="img-account" src="./images/person.png"/>
                        <p id="name-account">Tên Thật</p>
                        <a class="btn btn-info" id="change" href="/changepassword.php">Đổi mật khẩu</a>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-info" href="/logout.php">Đăng xuất</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>
</html>