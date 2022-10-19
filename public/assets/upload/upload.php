<?php

//upload.php

//if(isset($_POST["image"]))
//{
//    $data = $_POST["image"];
//
//    $image_array_1 = explode(";", $data);
//    $image_array_2 = explode(",", $image_array_1[1]);
//    $data = base64_decode($image_array_2[1]);
//
//    $imageName = time() . '.png';
//
//    file_put_contents($imageName, $data);
//
//    echo '<img src="../assets/upload/'.$imageName.'" class="img-thumbnail" />';
//}

if (isset($_POST['liked'])) {
    $postid = $_POST['postid'];
//    echo $postid;
//    $result = mysqli_query($con, "SELECT * FROM posts WHERE id=$postid");
//    $row = mysqli_fetch_array($result);
//    $n = $row['likes'];
//
//    mysqli_query($con, "INSERT INTO likes (userid, postid) VALUES (1, $postid)");
//    mysqli_query($con, "UPDATE posts SET likes=$n+1 WHERE id=$postid");
//
//    echo $n+1;
//    exit();
}