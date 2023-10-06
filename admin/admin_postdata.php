<?php
require('connection.php');
session_start();
// echo "im in post data";
?>




<!-- ----------------------------Create Client------------------------------------------------------------- -->


<?php
if (isset($_POST['create_client'])) {




    $username = $_SESSION['username'];



    echo "<br>", $name = $_POST['name'];
    echo "<br>", $prefix = $_POST['prefix'];
    echo "<br>", $mobile = $_POST['mobile'];
    echo "<br>", $email = $_POST['email'];
    echo "<br>", $address = $_POST['address'];



    // Assuming you're using sessions to track the logged-in user




    $query = "INSERT INTO `jobcard_client`(`jobcard_client_name`, `prefix`, `client_phone`, `client_email`, `address`) 
            VALUES ('$name', '$prefix', '$mobile', '$email', '$address')";




    $result = mysqli_query($con, $query);

    if ($result) {
        echo "
                 <script>
                   alert('Client Created Sucessfully');
                   window.location.href='client-management.php';
                 </script>
               ";
    } else {
        echo "
             <script>
               alert('Somrthing went Wrong');
               window.location.href='client-management.php';
             </script>
           ";
    }
}

?>



<!-- ----------------------------Update Client------------------------------------------------------------- -->

<?php
if (isset($_POST['update_client'])) {




    $username = $_SESSION['username'];



    echo "<br>", $id = $_POST['client_id'];
    echo "<br>", $name = $_POST['name'];
    echo "<br>", $prefix = $_POST['prefix'];
    echo "<br>", $mobile = $_POST['mobile'];
    echo "<br>", $email = $_POST['email'];
    echo "<br>", $address = $_POST['address'];



    // Assuming you're using sessions to track the logged-in user




    $query = "UPDATE `jobcard_client` SET `jobcard_client_name`='$name',`prefix`='$prefix',`client_phone`='$mobile',`client_email`='$email',`address`='$address'
     WHERE client_id='$id'";




    $result = mysqli_query($con, $query);

    if ($result) {
        echo "
                 <script>
                   alert('updated Sucessfully');
                   window.location.href='client-management.php';
                 </script>
               ";
    } else {
        echo "
             <script>
               alert('Somrthing went Wrong');
               window.location.href='client-management.php';
             </script>
           ";
    }
}

?>



<!-- ----------------------------Create Blog------------------------------------------------------------- -->

<?php
if (isset($_POST['create_blog'])) {




    $username = $_SESSION['username'];



    echo "<br>", $name = $_POST['name'];
    echo "<br>", $title = $_POST['title'];
    echo "<br>", $description = $_POST['description'];
    echo "<br>", $tag = $_POST['tag'];







    if (isset($_FILES['imageA']['name']) && !empty($_FILES['imageA']['name'])) {

        $image1 = $_FILES['imageA']['name'];
        $target_file1 = basename($image1);
        $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
        $check1 = $_FILES['imageA']['tmp_name'];
        $extension1 = substr($image1, strlen($image1) - 4, strlen($image1));
        $image_ext1 = pathinfo($image1, PATHINFO_FILENAME);
        $Final_image_name1 = $image_ext1 . date("mjYHis") . "." . $imageFileType1;
        $destination1 = "blog/.$Final_image_name1";
        move_uploaded_file($check1, $destination1);
    }


    if (isset($_FILES['imageB']['name']) && !empty($_FILES['imageB']['name'])) {

        $image2 = $_FILES['imageB']['name'];
        $target_file2 = basename($image2);
        $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
        $check2 = $_FILES['imageB']['tmp_name'];
        $extension2 = substr($image2, strlen($image2) - 4, strlen($image2));
        $image_ext2 = pathinfo($image2, PATHINFO_FILENAME);
        $Final_image_name2 = $image_ext2 . date("mjYHis") . "." . $imageFileType2;
        $destination2 = "blog/.$Final_image_name2";
        move_uploaded_file($check2, $destination2);
    }


    $query = "INSERT INTO `blogs`(`blog_name`, `blog_title`, `blog_image`, `blog_description`, `blog_tags`, `other_image`)
    VALUES ('$name', '$title', '$Final_image_name1', '$description', '$tag', '$Final_image_name2')
    ";




    $result = mysqli_query($con, $query);

    if ($result) {
        echo "
                 <script>
                   alert('Blog Uploaded Sucessfully');
                   window.location.href='client-management.php';
                 </script>
               ";
    } else {
        echo "
             <script>
               alert('Somrthing went Wrong');
               window.location.href='client-management.php';
             </script>
           ";
    }
}

?>








<?php
if (isset($_POST['generate_cards'])) {

    $username = $_SESSION['username'];
    echo "<br>", $name = $_POST['client_name'];
    echo "<br>", $count = $_POST['no_cards'];

    for ($i = 1; $i <= $count; $i++) {

        $min = 1111111;
        $max = 99999999;
        $randomNumber = mt_rand($min, $max);
        $cardusername = "user" . $randomNumber;

        $sql = "INSERT INTO `jobcards`(`card_id`, `client_name`, `card_active`)  VALUES ('$cardusername', '$name',0)";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            echo "
                 <script>
                   alert('Card Generation Failed try again');
                   window.location.href='jobcards-management.php';
                 </script>
               ";
        }
    }
    echo "
        <script>
          alert('$count Jobcards Generated Sucessfully');
          window.location.href='jobcards-management.php';
        </script>
      ";
} ?>







<?php

if (isset($_POST['generate_cards2'])) {
    $query = "INSERT INTO `blogs`(`blog_name`, `blog_title`, `blog_image`, `blog_description`, `blog_tags`, `other_image`)
    VALUES ('$name', '$title', '$Final_image_name1', '$description', '$tag', '$Final_image_name2')
    ";




    $result = mysqli_query($con, $query);

    if ($result) {
        echo "
                 <script>
                   alert('Blog Uploaded Sucessfully');
                   window.location.href='client-management.php';
                 </script>
               ";
    } else {
        echo "
             <script>
               alert('Somrthing went Wrong');
               window.location.href='client-management.php';
             </script>
           ";
    }
}


?>