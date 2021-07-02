# CLASSROOM CLONE VỚI PHP VÀ MYSQL


## 1 Yêu cầu 1: đăng kí, đăng nhập, quên mật khẩu


Hệ thống có 3 vài trò (roles) như sau:

• Admin, có toàn quyền quyết định trong hệ thống.

• Giáo viên, có quyền tạo lớp học và toàn quyền trong lớp học do mình tạo.

• Học viên, có quyền tham gia lớp học và tham gia vào các hoạt động của lớp học.

Người dùng muốn truy cập vào hệ thống thì phải đăng kí tài khoản và đăng nhập vào hệ thống. Sau khi đăng kí thì người dùng có vai
trò mặc định là Học viên. Admin có quyền phân lại quyền cho một người dùng bất kì.

Học viên có những thông tin sau: username, password, họ và tên, ngày tháng năm sinh, email, số điện thoại.

Khi người dùng quên mật khẩu thì có thể khôi phục lại mật khẩu qua email đã đăng ký trước đó. Hệ thống sẽ gửi một email có đường
link đặc biệt (có thời hạn xác định), khi click vào đường link này thì người dùng sẽ được chuyển hướng đến giao diện để thiết lập mật
khẩu mới.

## 2 Yêu cầu 2: quản lý lớp học

Lớp học có những thông tin sau: tên lớp học, môn học, phòng học, hình ảnh đại diện. Ngoài ra sau khi được tạo, mỗi lớp học sẽ có 1 mã
lớp học được phát sinh ngẫu nhiên. Sinh viên sẽ cần dùng mã lớp học này để tham gia vào lớp học.

Chỉ có Admin và Giáo viên là có quyền thêm/xóa/sửa lớp học. Giáo viên chỉ có quyền xóa/sửa lớp học do mình tạo ra, còn Admin có
quyền xóa/sửa bất kì lớp học nào.

Admin/Giáo viên có thể xem danh sách lớp học do mình quản lý. Có thể tìm kiếm lớp học theo tên lớp, môn học, phòng học.


## 3 Yêu cầu 3: các hoạt động trong lớp học

Sau khi tạo lớp học, Học viên có thể tham gia vào lớp học bằng mã lớp học. Giáo viên có thể xem danh sách học viên và có quyền loại
học viên ra khỏi lớp học hoặc thêm một học viên bất kì thông qua email.

Khi sinh viên tham gia vào lớp học bằng mã, giảng viên sẽ nhận được thông báo và có quyền đồng ý/không đồng ý để sinh viên tham
gia. Ngược lại, khi giảng viên thêm sinh viên vào lớp học, sinh viên cũng nhận được thông báo và cần xác nhận trước khi chính thức
tham gia vào lớp học.

Giáo viên có quyền đăng tin tức, tài liệu, hình ảnh, v.v... lên trang môn học. Học viên sẽ thấy được tin tức và download được các tài
liệu, hình ảnh này. Học viên cũng có thể comment trên mỗi tin tức.

Giáo viên có quyền xóa/sửa các tin tức, tài liệu, hình ảnh, v.v... đã đăng.

Giáo viên có quyền xóa các comments không phù hợp.

Giáo viên có thể tạo assignment bằng cách liên kết với một google form. Một assignment sẽ có các thông tin sau: tên assignment, mô
tả, ngày giờ bắt đầu và ngày giờ kết thúc. Học viên chỉ thấy được assignment trong thời gian assignment được mở. Học viên không thể
nộp bài assignment sau khi đã qua deadline.
