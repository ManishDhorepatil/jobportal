<?php
require('connection.php');
session_start();
$username = $_SESSION['username'];
// $username='user09162023124154';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Category</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <!-- Custom css -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- page -->
    <link rel="stylesheet" href="./assets/css/candiate-myprofile.css">
    <link rel="stylesheet" href="./assets/css/candiate-sidebar.css">
    <!-- <link rel="stylesheet" href="./assets/css/candidate-dashboard.css"> -->


    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <!-- navbar  -->
    <?php include './profileNavbar.php'; ?>

    <div id="button-side-nav-bar" class="">

    </div>
    <section>

        <div class="row w-100">


            <?php
            $activePage = 'myprofile';





            $query = "SELECT  `age`, `location`, `phone`, `currentjob`, `designation`, `qualification`, `category`, `resume`, `description` FROM users_candidate WHERE username = ?";
            $stmt = $con->prepare($query);

            if ($stmt) {
                $stmt->bind_param("s", $username);
                $username = $_SESSION['username']; // Assuming you have a 'username' session variable

                $stmt->execute();
                $stmt->bind_result($age, $location, $phone, $currentjob, $designation, $qualification, $category, $resume, $description);
                $stmt->fetch();
                $stmt->close();

                if (
                    empty($age) ||
                    empty($location) || empty($phone) ||
                    empty($currentjob) || empty($designation) || empty($qualification) ||
                    empty($category) || empty($resume) || empty($description)
                ) {
                    // -----2 nd nav-----
                    include './candidate-sidenavbar2.php';
                } else {

                    include './candidate-sidenavbar.php';
                }
            }




            ?>

            <?php
            $sql1 = "SELECT * FROM users_candidate  WHERE username='$username' ";
            $query1 = mysqli_query($con, $sql1);
            $result_fetch1 = mysqli_fetch_assoc($query1);
            $row1 = mysqli_num_rows($query1);
            ?>


            <div class="col">
                <h4 class="mt-3 mb-5 fw-normal">
                    My Profile
                </h4>
                <div class="custom-border">
                    <form action="login_register.php" method="POST" enctype="multipart/form-data" class="px-5">
                        <div class="row mt-3">
                            <div class="mb-3 col">
                                <label for="candiatename" class="form-label">Name*</label>
                                <input type="text" value="<?= $result_fetch1['name'] ?>" class="form-control" id="candiatename" name="name">
                            </div>
                            <div class="mb-3 col">
                                <label for="candiateage" class="form-label">Your Age*</label>
                                <input type="tel" value="<?= $result_fetch1['age'] ?>" class="form-control" id="candiateage" name="age">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="location" class="form-label">Current Location*</label>
                                <input type="text" value="<?= $result_fetch1['location'] ?>" class="form-control" id="location" name="location">
                            </div>
                            <div class="mb-3 col">
                                <label for="c_no" class="form-label">Phone Number*</label>
                                <input type="number" value="<?= $result_fetch1['phone'] ?>" class="form-control" id="c_no" name="phone">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="email" class="form-label">Email*</label>
                                <input type="email" class="form-control" value="<?= $result_fetch1['email'] ?>" id="email" name="email" disabled>
                            </div>
                            <div class="mb-3 col">
                                <label for="cu-job-place" class="form-label">Current Job Place(Optional)</label>
                                <input type="text" value="<?= $result_fetch1['currentjob'] ?>" class="form-control" id="cu-job-place" name="currentjob">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col">
                                <label for="designation" class="form-label">Designation(Optional)</label>
                                <input type="text" value="<?= $result_fetch1['designation'] ?>" class="form-control" id="designation" name="designation">
                            </div>
                            <div class="mb-3 col">
                                <label for="linkedin" class="form-label">Qualification*</label>
                                <input type="text" value="<?= $result_fetch1['qualification'] ?>" class="form-control" id="designation" name="qualification1" hidden>
                                <select value="<?= $result_fetch1['qualification'] ?>" class="form-select" aria-label="Default select example" name="qualification">

                                    <option selected value=""><?= $result_fetch1['qualification']; ?></option>
                                    <option value="One">One</option>
                                    <option value="Two">Two</option>
                                    <option value="Three">Three</option>
                                </select>
                            </div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM `category`                        ";
                        $result4 = $con->query($sql);
                        ?>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="linkedin" class="form-label">Serching Job As a</label>
                                <input type="text" value="<?= $result_fetch1['category'] ?>" class="form-control" id="designation" name="category1" hidden>
                                <select value="<?= $result_fetch1['category'] ?>" class="form-select" name="category" aria-label="Default select example">
                                    <option selected value=""><?= $result_fetch1['category']; ?></option>
                                    <?php
                                    if ($result4->num_rows > 0) {

                                        while ($row = $result4->fetch_assoc()) {
                                            $category_id = $row["category_id"];
                                            $category_name = $row["category"];
                                    ?>
                                            <option value="<?= $row["category"] ?>"><?= $row["category"] ?></option>

                                    <?php

                                        }
                                    } else {
                                        echo "No categories found.";
                                    }
                                    ?>


                                </select>

                            </div>

                            <div class="mb-3 col">
                                <label for="formFile" class="form-label">Upload Resume</label>
                                <input class="form-control" type="file" id="formFile" accept="application/pdf" name="file">
                                <?php
                                if (!$result_fetch1['resume'] == null) { ?>
                                    Your uploaded resume : <a href="uploaddocs/.<?php echo $result_fetch1['resume']; ?>" target="_blank"><?= $result_fetch1['name'] ?></a>
                                <?php }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="shortdesc" class="form-label">Description Yourself</label>
                                <textarea class="form-control" id="shortdesc" rows="5" name="description"><?php echo $result_fetch1['description']; ?></textarea>
                            </div>



                            <button type="submit" name="update" class="btn py-2 px-3 mb-3 text-white btn-lg" style="background-color: var(--primary);" name="update">Update Change</button>
                    </form>

                </div>
                <h4 class="mt-3 mb-5 fw-normal">
                    Social Network:
                </h4>
                <div class="custom-border mb-5">
                    <form action="" class=" px-5">


                        <div class="row mt-3">
                            <div class="mb-3 col">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="text" class="form-control" id="linkedin">

                            </div>
                            <div class="mb-3 col">
                                <label for="pinterest" class="form-label">Pinterest</label>
                                <input type="text" class="form-control" id="pinterest">

                            </div>
                        </div>
                        <div class="row ">

                            <div class="mb-3 col">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="facebook">

                            </div>
                            <div class="mb-3 col">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="twitter">


                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col">
                                <label for="github" class="form-label">GitHub</label>
                                <input type="text" class="form-control" id="github">

                            </div>
                            <div class="mb-3 col">
                                <label for="behance" class="form-label">Behance</label>
                                <input type="text" class="form-control" id="behance">

                            </div>
                        </div>
                        <button type="submit" class="btn py-2 px-3 my-3 text-white btn-lg" style="background-color: var(--primary);" value="">Edit Social</button>

                    </form>
                </div>
            </div>
        </div>


    </section>
    <!-- footer -->
    <?php include './footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    <script src="./assets/js/candidate-sidenavbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="assets/js/job-details.js"></script>
</body>

</html>