<?php

require_once 'database/db.php';

session_start();

if (isset($_POST['btn_login'])) {

    $username   =   $_POST['username'];
    $password   =   $_POST['password'];

    if (empty($username)) {

        echo "<script>alert('โปรด...!! ป้อนชื่อผู้ใช้งาน');window.location='javascript:history.back()';</script>";
    } else if (empty($password)) {

        echo "<script>alert('โปรด...!! ป้อนรหัสผ่าน');window.location='javascript:history.back()';</script>";
    } else if ($username and $password) {

        try {

            $select_stmt =  $conn->prepare("SELECT username, password, status FROM users WHERE username = :username AND password = :password");

            $select_stmt->bindParam(":username",  $username);
            $select_stmt->bindParam(":password",  $password);
            $select_stmt->execute();

            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

                $dbusername     =   $row['username'];
                $dbpassword     =   $row['password'];
                $dbstatus       =   $row['status'];
            }

            if ($username != null and $password != null) {

                if ($select_stmt->rowCount() > 0) {

                    if ($username == $dbusername and $password == $dbpassword and $dbstatus != null) {

                        switch ($dbstatus) {

                            case 'admin':

                                $select_admin =  $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND status = :status");
                                $select_admin->bindParam(":username",  $username);
                                $select_admin->bindParam(":password",  $password);
                                $select_admin->bindParam(":status",  $dbstatus);
                                $select_admin->execute();

                                while ($row_admin = $select_admin->fetch(PDO::FETCH_ASSOC)) {

                                    $_SESSION['id']      =   $row_admin['id'];
                                    $_SESSION['username']     =   $row_admin['username'];
                                    $_SESSION['password']     =   $row_admin['password'];
                                    $_SESSION['status']       =   $row_admin['status'];

                                    echo "<script>alert('ยินดีต้อนรับ ผู้ดูแลระบบ')</script>";
                                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=admin/index.php\">";
                                }

                                break;

                            case 'branchhead':

                                $select_admin =  $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND status = :status");
                                $select_admin->bindParam(":username",  $username);
                                $select_admin->bindParam(":password",  $password);
                                $select_admin->bindParam(":status",  $dbstatus);
                                $select_admin->execute();

                                while ($row_admin = $select_admin->fetch(PDO::FETCH_ASSOC)) {

                                    $_SESSION['id']     =   $row_admin['id'];
                                    $_SESSION['username']     =   $row_admin['username'];
                                    $_SESSION['password']     =   $row_admin['password'];
                                    $_SESSION['status']       =   $row_admin['status'];

                                    echo "<script>alert('ยินดีต้อนรับ ตัวแทนหลักสูตร')</script>";
                                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=branchhead/index.php\">";
                                }

                                break;

                            case 'teacher':

                                $select_admin =  $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND status = :status");
                                $select_admin->bindParam(":username",  $username);
                                $select_admin->bindParam(":password",  $password);
                                $select_admin->bindParam(":status",  $dbstatus);
                                $select_admin->execute();

                                while ($row_admin = $select_admin->fetch(PDO::FETCH_ASSOC)) {

                                    $_SESSION['id']     =   $row_admin['id'];
                                    $_SESSION['username']     =   $row_admin['username'];
                                    $_SESSION['password']     =   $row_admin['password'];
                                    $_SESSION['status']       =   $row_admin['status'];

                                    echo "<script>alert('ยินดีต้อนรับ อาจารย์')</script>";
                                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=teacher/index.php\">";
                                }

                                break;

                            case 'executive':

                                $select_admin =  $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND status = :status");
                                $select_admin->bindParam(":username",  $username);
                                $select_admin->bindParam(":password",  $password);
                                $select_admin->bindParam(":status",  $dbstatus);
                                $select_admin->execute();

                                while ($row_admin = $select_admin->fetch(PDO::FETCH_ASSOC)) {

                                    $_SESSION['id']     =   $row_admin['id'];
                                    $_SESSION['username']     =   $row_admin['username'];
                                    $_SESSION['password']     =   $row_admin['password'];
                                    $_SESSION['status']       =   $row_admin['status'];

                                    echo "<script>alert('ยินดีต้อนรับ ผู้บริหาร')</script>";
                                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=executive/index.php\">";
                                }

                                break;

                            default:

                                $errorMsg[] = "ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง";
                                echo "<script>alert('ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง')</script>";
                                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
                        }
                    }
                } else {
                    echo "<script>alert('ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?login\">";
                }
            }
        } catch (PDOException $e) {

            $e->getMessage();
        }
    }
}
