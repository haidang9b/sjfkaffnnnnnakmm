<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Hoạt động trong lớp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-manager.css">
    <link rel="stylesheet" href="style-class.css">
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
                        <a class="dropdown-item" href="#">Lớp 2</a>
                        <a class="dropdown-item" href="#">Lớp 3</a>
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
    <div class="row align-items-center">
        <div>
            <h3>Bài tập</h3>
        </div>
    </div>

    <div class="btn-group my-3">
        <button type="button" class="btn btn-light border" data-toggle='modal' data-target="#new-work">
            Thêm bài tập
        </button>
    </div>

    <table class="table table-hover">
        <tbody>
        <tr>
            <td>
                <img src="./images/class-work.png" class="img-people">
            </td>
            <td><b>Tên bài tập</b></td>
            <td>Thời gian</td>
        </tr>
        </tbody>
    </table>

    <div class="row align-items-center">
        <div>
            <h3>Thông báo</h3>
        </div>
    </div>

    <table class="table table-hover">
        <tbody>
        <tr>
            <td>
                <img src="./images/class-work.png" class="img-people">
            </td>
            <td><b>Tiêu đề</b></td>
            <td>Thời gian</td>
        </tr>
        </tbody>
    </table>

    <div class="row align-items-center">
        <div>
            <h3>Thảo luận</h3>
        </div>
    </div>

    <table class="table table-hover">
        <tbody>
        <tr>
            <td>
                <img src="./images/class-work.png" class="img-people">
            </td>
            <td><b>Tiêu đề</b></td>
            <td>Thời gian</td>
        </tr>
        </tbody>
    </table>



    <!-- Quản lý tài khoản -->
    <div class="modal fade" id="manager-account">
        <div class="modal-dialog">
            <div class="modal-content" id="account">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="header-account">User</h4>
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

    <!-- Thêm bài tập -->
    <div class="modal fade" id="new-work">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm bài tập</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <label for="name-class"><b>Tên bài tập</b></label>
                        <br>
                        <input type="text" id="name-work" placeholder="Tên bài tập(bắt buộc)" name="name">
                        <br>
                        <label for="desc-class"><b>Mô tả</b></label>
                        <br>
                        <input type="text" id="desc-work" placeholder="Mô tả bài tập(tùy chọn)" name="desc">
                        <br>
                        <label for="part-class"><b>Thời hạn nộp</b></label>
                        <br>
                        <input type="text" id="time-work" placeholder="Thời hạn nộp bài (tùy chọn)" name="time">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Tạo</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

