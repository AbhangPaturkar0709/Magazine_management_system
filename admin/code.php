<?php 
session_start();
include("config/connection.php");
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['art_approve']))
{
    $id = $_POST['art_approve'];
    $comment = ucwords(trim($_POST['txt_comment']));
    $query = "update articles set status='Approved', comment='$comment' where id=$id";
    if(mysqli_query($connect, $query))
    {
        header("Location: view_article.php?id=$id&page=studart");
    }
}
if(isset($_POST['art_modify']))
{
    $id = $_POST['art_modify'];
    $comment = ucwords(trim($_POST['txt_comment']));
    $query = "update articles set status='Modify', comment='$comment' where id=$id";
    if(mysqli_query($connect, $query))
    {
        header("Location: view_article.php?id=$id&page=studart");
    }
}
if(isset($_POST['art_reject']))
{
    $id = $_POST['art_reject'];
    $comment = ucwords(trim($_POST['txt_comment']));
    $query = "update articles set status='Rejected', comment='$comment' where id=$id";
    if(mysqli_query($connect, $query))
    {
        header("Location: view_article.php?id=$id&page=studart");
    }

}
if($_SESSION['auth_admin']['admin_role'] == "ADMIN")
{
    if(isset($_POST['import_students']))
    {
        $filename = $_FILES['importfile']['name'];
        $targetPath = $_FILES['importfile']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach($data as $row)
        {
            $idcode = strtoupper(trim($row['0']));
            $firstname = strtoupper(trim($row['1']));
            $middlename = strtoupper(trim($row['2']));
            $lastname = strtoupper(trim($row['3']));
            $email = strtolower(trim($row['4']));
            $contact = $row['5'];

            $dept_code = substr($idcode, 2, 2);
            $YearFromId = substr($idcode, 0, 2);
            $CurrentYear = date("y");
            $query = "select id from department where code = '$dept_code'";
            $result = mysqli_query($connect, $query);
            if((mysqli_num_rows($result)>0) && (($YearFromId <= $CurrentYear) && ($YearFromId >= $CurrentYear-3)))
            {
                $row = mysqli_fetch_assoc($result);
                $dept = $row['id'];
                $x = $CurrentYear - $YearFromId;
                $year = "";
                if($x == 0 || $x == 1)
                {
                    $year = '1st';
                }
                elseif($x == 2)
                {
                    $year = '2nd';
                }
                elseif($x == 3)
                {
                    $year = '3rd';
                }

                $checkStudent = "select id from users where id = '$idcode'";
                $checkStudent_result = mysqli_query($connect, $checkStudent);

                // Check for already exist student
                if(mysqli_num_rows($checkStudent_result)>0)
                {
                    $update_query = "update users set firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', deptno = $dept, year = '$year', role = 'STUDENT', email = '$email', password = '$idcode', mob = $contact where id = '$idcode'";
                    $update_result = mysqli_query($connect, $update_query);
                    $msg = 1;
                }
                else
                {
                    // New record has to insert
                    $insert_query = "insert into users values('$idcode', '$firstname', '$middlename', '$lastname', $dept, '$year', 'STUDENT', '$email', '$idcode', $contact)";
                    $insert_result = mysqli_query($connect, $insert_query);
                    $msg = 1;
                }

                if(isset($msg))
                {
                    $_SESSION['status'] = "File Imported Successfully";
                    header("Location: student.php");
                }
                else
                {
                    $_SESSION['status'] = "File Importing Failed";
                    header("Location: student.php");
                }
            }
            else
            {
                header("Location: student.php");
            }
        }
    }

    if(isset($_POST['import_staff']))
    {
        $filename = $_FILES['importfile']['name'];
        $targetPath = $_FILES['importfile']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach($data as $row)
        {
            $id = strtoupper(trim($row['0']));
            $firstname = strtoupper(trim($row['1']));
            $middlename = strtoupper(trim($row['2']));
            $lastname = strtoupper(trim($row['3']));
            $email = strtolower(trim($row['4']));
            $contact = $row['5'];

            $dept_code = substr($id, 0, 2);
            $query = "select id from department where code = '$dept_code'";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result)>0)
            {
                $row = mysqli_fetch_assoc($result);
                $dept = $row['id'];
            
                $checkStaff = "select id from users where id = '$id'";
                $checkStaff_result = mysqli_query($connect, $checkStaff);

                // Check for already exist student
                if(mysqli_num_rows($checkStaff_result)>0)
                {
                    $update_query = "update users set firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', deptno = $dept, role = 'STAFF', email = '$email', password = '$id', mob = $contact where id = '$id'";
                    $update_result = mysqli_query($connect, $update_query);
                    $msg = 1;
                }
                else
                {
                    // New record has to insert
                    $insert_query = "insert into users(id, firstname, middlename, lastname, deptno, role, email, password, mob) values('$id', '$firstname', '$middlename', '$lastname', $dept, 'STAFF', '$email', '$id', $contact)";
                    $insert_result = mysqli_query($connect, $insert_query);
                    $msg = 1;
                }

                if(isset($msg))
                {
                    $_SESSION['status'] = "File Imported Successfully";
                    header("Location: staff.php");
                }
                else
                {
                    $_SESSION['status'] = "File Importing Failed";
                    header("Location: staff.php");
                }
            }
            else
            {
                header("Location: staff.php");
            }
        }

    }
}

if($_SESSION['auth_admin']['admin_role'] == "STAFF")
{
    if(isset($_POST['import_students']))
    {
        $dept_name = $_SESSION['auth_admin']['admin_dept'];
        $query="select id, code from department where d_name = '$dept_name'";
        $row = mysqli_fetch_assoc($result = mysqli_query($connect, $query));
        $dpt_code = $row['code'];
        $d_id = $row['id'];

        $filename = $_FILES['importfile']['name'];
        $targetPath = $_FILES['importfile']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach($data as $row)
        {
            $idcode = strtoupper(trim($row['0']));
            $firstname = strtoupper(trim($row['1']));
            $middlename = strtoupper(trim($row['2']));
            $lastname = strtoupper(trim($row['3']));
            $email = strtolower(trim($row['4']));
            $contact = $row['5'];

            $dept_code = substr($idcode, 2, 2);
            $YearFromId = substr($idcode, 0, 2);
            $CurrentYear = date("y");
            $query = "select id from department where code = '$dept_code'";
            $result = mysqli_query($connect, $query);
            if((mysqli_num_rows($result)>0) && (($YearFromId <= $CurrentYear) && ($YearFromId >= $CurrentYear-3)))
            {
                $row = mysqli_fetch_assoc($result);
                $dept = $row['id'];
                $x = $CurrentYear - $YearFromId;
                $year = "";
                if($x == 0 || $x == 1)
                {
                    $year = '1st';
                }
                elseif($x == 2)
                {
                    $year = '2nd';
                }
                elseif($x == 3)
                {
                    $year = '3rd';
                }

                $checkStudent = "select id from users where id = '$idcode'";
                $checkStudent_result = mysqli_query($connect, $checkStudent);

                if($dpt_code == $dept_code)
                {
                    // Check for already exist student
                    if(mysqli_num_rows($checkStudent_result)>0)
                    {
                        $update_query = "update users set firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', deptno = $dept, year = '$year', role = 'STUDENT', email = '$email', password = '$idcode', mob = $contact where id = '$idcode'";
                        $update_result = mysqli_query($connect, $update_query);
                        $msg = 1;
                    }
                    else
                    {
                        // New record has to insert
                        $insert_query = "insert into users values('$idcode', '$firstname', '$middlename', '$lastname', $dept, '$year', 'STUDENT', '$email', '$idcode', $contact)";
                        $insert_result = mysqli_query($connect, $insert_query);
                        $msg = 1;
                    }

                    if(isset($msg))
                    {
                        $_SESSION['status'] = "File Imported Successfully";
                        header("Location: student.php");
                    }
                    else
                    {
                        $_SESSION['status'] = "File Importing Failed";
                        header("Location: student.php");
                    }
                }
                else
                {
                    $_SESSION['status'] = "Importing Failed...! Problem in ID-CODE.";
                }
            }
            else
            {
                header("Location: student.php");
            }
        }
    }
}

mysqli_close($connect);

?>