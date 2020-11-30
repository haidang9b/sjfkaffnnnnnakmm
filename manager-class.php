<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Thành viên</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body>
    <?php
        // if()
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

        <a href="#">
            <b id="name-class-manager">Tên lớp</b>
            <br>
            <b id="name-teacher-manager">Tên giáo viên</b>
        </a>

        <button class="btn-user" class="fa fa-trash action" data-toggle="modal" data-target="#manager-account"></button>
    </div>

<div class="container">
    <!-- Danh sách giáo viên -->
    <div class="row align-items-center">
        <div>
            <h3>Giáo viên</h3>
        </div>
    </div>

    <div class="btn-group my-3">
        <button type="button" class="btn btn-light border">
            Thêm giáo viên
        </button>
    </div>

    <table class="table table-hover">
        <tbody>
            <tr>
                <td>
                    <img src="images/person.png" class="img-people" style=" width: 30px; height: 30px;">
                </td>
                <td>Tên</td>
                <td>Email</td>
                <td>
                    <button><i class="fa fa-edit action"></i></button>
                    <button><i class="fa fa-remove action" data-toggle= "modal" data-target="#confirm-delete"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Danh sách sinh viên -->
    <div class="row align-items-center">
        <div>
            <h3>Sinh viên</h3>
        </div>
    </div>

    <div class="btn-group my-3">
        <button type="button" class="btn btn-light border">
            Thêm sinh viên
        </button>
    </div>

    <table class="table table-hover">
        <tbody>
        <tr>
            <td>
                <img src="images/person.png" class="img-people" style=" width: 30px; height: 30px;">
            </td>
            <td>Tên</td>
            <td>Email</td>
            <td>
                <button><i class="fa fa-edit action"></i></button>
                <button><i class="fa fa-remove action" data-toggle= "modal" data-target="#confirm-delete"></i></button>
            </td>
        </tr>
        </tbody>
    </table>

    <!-- Quản lý tài khoản -->
    <div class="modal fade" id="manager-account">
        <div class="modal-dialog">
            <div class="modal-content" id="account">
                <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="header-account">Account</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img id="img-account" src="./images/person.png"/>
                        <br>
                        <br>
                        <p id="name-account">Tên</p>
                        <p id="email-account">Email</p>
                        <button type="submit" class="btn btn-default" id="manager">Quản lý tài khoản</button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" >Đăng xuất</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Xóa một dòng -->
    <div class="modal fade" id="confirm-delete">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Xóa thành viên lớp</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    Bạn có chắc rằng muốn xóa <strong>Tên người muốn xóa</strong> ra khỏi lớp
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
