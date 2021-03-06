<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 10/16/2019
 * Time: 9:46 PM
 */

include "company_profile.php";

include($_SERVER['DOCUMENT_ROOT'].'/web/company/company_profile_student_card.php');

if (isset($_SESSION['tax_number'])) {
    $id_request = $_GET['id'];
    $sql_student = "SELECT * FROM `organization_requests` WHERE id=".$id_request;

    $update = mysqli_query($conn, $sql_student);
    $org_request = mysqli_fetch_assoc($update);
    $_SESSION['org_request'] = $org_request;
//var_dump($_SESSION['org_request']['id']);

    $sql_pr = "SELECT * FROM `organization` where id=".$org_request['organization_id'];
    $update2 = mysqli_query($conn, $sql_pr);
    $org_pr = mysqli_fetch_assoc($update2);
    $_SESSION['org_pr'] = $org_pr;
//
//$sql_dic = "SELECT * FROM `organization_request_abilities` WHERE organization_request_id = ".$id_request;
//$update3 = mysqli_query($conn, $sql_dic);
//$org_dic = mysqli_fetch_assoc($update3);
//$_SESSION['org_dic'] = $org_pr;
//
////var_dump($sql_dic);die;

    $sql = "SELECT * 
FROM student
WHERE id IN (SELECT student_id
            FROM organization_request_assignment, organization_requests
            WHERE organization_request_assignment.organization_request_id = organization_requests.id
         
            AND organization_requests.organization_id = ".$org_pr['id'].")";
    $list_student = mysqli_query($conn, $sql);
    $query =  mysqli_fetch_assoc($list_student);

    $sql2 = "SELECT * FROM `student` WHERE student_code IN ('16001752','00002','00003')";
    $list_students = mysqli_query($conn, $sql2);
    $_SESSION['list_stu'] = $list_students;

    ?>

    <!DOCTYPE html>
    <html>
    <title>Phiếu tuyển dụng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body, h1, h2, h3, h4, h5 {
            font-family: "Times New Roman", sans-serif
        }

        body {
            font-size: 20px;
        }

        img {
            margin-bottom: -8px;
        }
    </style>

    <body id="myPage" style="background-color: #f5f5f5">
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-hover-white w3-theme-d2"
               href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a href="company_profile.php" class="w3-bar-item w3-button w3-teal"><i class="fa fa-home w3-margin-right"></i>Trang chủ</a>
            <a href="profile.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Hồ sơ doanh nghiệp</a>
            <a href="company_home.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Phiếu tuyển dụng</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Khác</a>
            <div style="float: right" class="w3-dropdown-hover w3-hide-small">
                <button class="w3-button w3-teal " title="Notifications"><?php echo $company_profile['organization_name'] ?><i class="fa fa-caret-down"></i></button>
                <div class="w3-dropdown-content w3-card-4 w3-bar-block" >
                    <a href="#" class="w3-bar-item w3-button">Hồ sơ doanh nghiệp</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    <form action="scr_1002E_change.php" method="post">
        <div class="w3-content w3-padding-top  w3-white w3-margin-bottom w3-margin-top" style="max-width:1200px;">
            <div class="w3-center w3-card w3-opacity" style="background:#353535 url(https://techtalk.vn/wp-content/uploads/2017/08/PHP-696x392.jpg); height: 150px;"></div>
            <div class="w3-card w3-padding">
                <i class="fa fa-home w3-margin-right"><a href="#" style="text-decoration: none" class="w3-hover-opacity"></i>Trang chủ</a> /
                <a style="text-decoration: none" class="w3-hover-opacity" href="#">Bảng phân công</a>
            </div>
            <div style="padding-top:1px;">
                <br>
                <h3 class="w3-container w3-center"><b>Danh sách phân công sinh viên</b></h3>
                <br>
                <?php
                // output data of each row
                while ($row = $_SESSION['list_stu']->fetch_assoc()) {

                    ?>
                    <div class="w3-padding">
                        <ul class="w3-ul w3-border w3-hover-shadow">
                            <li class="w3-theme">
                                <p class="w3-large"><h4>Mã sinh viên: </b><?php echo $row['student_code']; ?></h4>
                            </li>
                            <li class="w3-padding"><b>Tên sinh viên: </b> <?php echo $row['first_name']; echo " "; echo $row['sur_name']; echo " "; echo $row['last_name']; ?></li>
                            <li class="w3-padding"><b>Ngày sinh: </b><?php echo $row['date_of_birth'];?></li>
                            <li class="w3-padding"><b>Ngành: </b><?php echo $row['class_name'];?></li>
                        </ul>
                    </div>
                <?php } ?>

            </div>

        </div>
    </form>
    </body>
    </html>
    <?php
}
else
    header('Location: /web/login/login.php');
?>