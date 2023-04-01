<?php 
include("config/connection.php");

if(isset($_POST['art_approve']))
{
    $id = $_POST['art_approve'];
    $comment = ucwords(trim($_POST['txt_comment']));
    $query = "update articles set status='Apporved', comment='$comment' where id=$id";
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

?>