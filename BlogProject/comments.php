<?php

include("db.php");


if(isset($_GET["action"])){


    // ================= عرض التعليقات =================

    if($_GET["action"] == "get"){

        $sql = "SELECT * FROM comments ORDER BY id DESC";

        $result = mysqli_query($conn,$sql);


        $comments=[];


        while($row=mysqli_fetch_assoc($result)){

            $comments[]=$row;

        }


        echo json_encode($comments);

        exit();

    }




    // ================= إضافة تعليق =================

    if($_GET["action"]=="add"){


        $username=$_POST["username"];

        $comment=$_POST["comment"];



        $sql="
        INSERT INTO comments(username,comment)

        VALUES('$username','$comment')
        ";



        mysqli_query($conn,$sql);



        echo "success";

        exit();


    }





    // ================= حذف تعليق =================


    if($_GET["action"]=="delete"){


        $id=$_GET["id"];



        // حذف اللايكات أولا

        mysqli_query($conn,"
        DELETE FROM likes 
        WHERE comment_id='$id'
        ");




        mysqli_query($conn,"
        DELETE FROM comments 
        WHERE id='$id'
        ");




        echo "Deleted";

        exit();


    }






    // ================= تعديل تعليق =================


    if($_GET["action"]=="update"){


        $id=$_POST["id"];

        $comment=$_POST["comment"];



        mysqli_query($conn,"
        UPDATE comments

        SET comment='$comment'

        WHERE id='$id'
        ");



        echo "Updated";

        exit();


    }





    // ================= Like =================


    if($_GET["action"]=="like"){



        $comment_id=$_POST["comment_id"];

        $username=$_POST["username"];




        $check=mysqli_query($conn,"
        SELECT * FROM likes

        WHERE comment_id='$comment_id'

        AND username='$username'
        ");




        if(mysqli_num_rows($check)>0){


            echo "already";

            exit();


        }





        mysqli_query($conn,"
        INSERT INTO likes(comment_id,username)

        VALUES('$comment_id','$username')
        ");




        $count=mysqli_query($conn,"
        SELECT COUNT(*) AS total

        FROM likes

        WHERE comment_id='$comment_id'
        ");




        $row=mysqli_fetch_assoc($count);



        echo $row["total"];

        exit();


    }






    // ================= Get Likes =================


    if($_GET["action"]=="getLikes"){



        $comment_id=$_GET["comment_id"];




        $count=mysqli_query($conn,"
        SELECT COUNT(*) AS total

        FROM likes

        WHERE comment_id='$comment_id'
        ");




        $row=mysqli_fetch_assoc($count);



        echo $row["total"];

        exit();


    }






    // ================= PROFILE =================



    if($_GET["action"]=="profile"){



        $username=$_GET["username"];




        // عدد التعليقات

        $comments=mysqli_query($conn,"
        SELECT COUNT(*) AS total

        FROM comments

        WHERE username='$username'
        ");

        $commentCount=mysqli_fetch_assoc($comments);






        // عدد اللايكات التي حصل عليها المستخدم

        $likes=mysqli_query($conn,"
        SELECT COUNT(*) AS total

        FROM likes

        INNER JOIN comments

        ON likes.comment_id = comments.id

        WHERE comments.username='$username'
        ");

        $likeCount=mysqli_fetch_assoc($likes);







        $profile=[


            "username"=>$username,


            "comments"=>$commentCount["total"],


            "likes"=>$likeCount["total"]


        ];



        echo json_encode($profile);



        exit();



    }




}



?>