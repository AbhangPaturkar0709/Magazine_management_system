<?php
    include("config/connection.php");

        if(isset($_POST['update_article']))
        {
            $id = $_GET['id'];
            echo $id;
            $sid = $_POST['sid'];
            $article_title = trim($_POST['art_title']);
            $article_category = $_POST['category'];
            $doc = preg_replace("/\s+/","_", $_FILES['file']['name']);
            $doc_type = $_FILES['file']['type'];
            $doc_size = $_FILES['file']['size'];
            $doc_tem_loc = $_FILES['file']['tmp_name'];
            $doc_ext = pathinfo($doc, PATHINFO_EXTENSION);
            $doc_name = pathinfo($doc, PATHINFO_FILENAME);
            $doc_unique_name = $doc_name."_".date("mjYHis").".".$doc_ext;
            $doc_store = "../Documents/".$doc_unique_name;

            if($article_title == "" || $article_category == "-1" || $doc == "")
            {
              $_SESSION['status'] = "Invalid Input...";
              header("Location: view_magzine.php?id=$id");
            }
            else
            {                
                move_uploaded_file($doc_tem_loc, $doc_store);

                $query = "update articles set title = '$article_title', category = '$article_category', file = '$doc_unique_name', uploaddate = now(), status = 'pending', comment = '' where id = '$id'";

                if(mysqli_query($connect, $query))
                {
                    $_SESSION['status'] = "Article uploaded successfully...";
                    header("Location: view_article.php?id=$id&page=myart");
                }
         
            }
        }
        mysqli_close($connect);
    ?>