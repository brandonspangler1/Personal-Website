<?php

require('../db_connection.php');
session_start();

# If Super Administrator has not logged in yet, direct the user to the index/login page 
if (isset($_SESSION['sa_login_successful']) == null && $_SESSION['sa_login_successful'] == false) {

    echo "
        <script>
            alert('Please Login To Access This Page'); 
            window.location.href='../index.php'; 
        </script>
        ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create University Profile</title>
    <link rel="stylesheet" href="css/create_university.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Create</h1>
                <h1>University Profile</h1>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <!-- 
    User Will be Directed Here Either when they first login (university_status == 0)
    Or when they want to create a university profile from the home page (university_status == 1)
-->

    <div class="create_university">
        <form style="text-align: center" method="POST" enctype="multipart/form-data">

            <div class="university_description">
                <div class="basic_information">
                    <label for="uni_name">University Name</label><br>
                    <input type="text" id="uni_name" placeholder="University Name" name="name" required />
                    <br>
                    <label for="uni_location">University Location</label><br>
                    <input type="text" id="uni_location" placeholder="City, State" name="location" required />
                    <br>
                    <label for="num_students">Number of Students</label><br>
                    <input type="text" id="num_students" placeholder="12345" name="num_students" required />
                </div>
                <div class="describe">
                    <label for="uni_description">Description</label><br>
                    <textarea id="uni_description" name="description" placeholder="University Description" rows="4" cols="50" required></textarea>
                </div>
            </div>

            <div class="add_picture">
                <div class="picture_name">
                    <label for="pic_name">Picture Name</label><br>
                    <input type="text" id="pic_name" placeholder="Picture Name" name="picture_name" required />
                </div>
                <div class="picture_link">
                    <label for="pic_link">Picture Upload</label><br>
                    <input type="file" id="pic_link" name="image" required />
                </div>
            </div>

            <button type="submit" class="create-btn" name="university_create">CREATE</button>
        </form>
    </div>

    <?php

    if (isset($_POST['university_create'])) {

        $name = $_POST['name'];
        $location = $_POST['location'];
        $num_students = $_POST['num_students'];
        $description = $_POST['description'];
        $picture_name = $_POST['picture_name'];

        # For checking whether the user has created a university profile or not (Mainly for the Home Page) 
        $query = "SELECT * FROM `user_information` WHERE `username`= '$_SESSION[username]'";
        $result = mysqli_query($con, $query);

        if ($result) {

            $result_fetch = mysqli_fetch_assoc($result);

            $super_id = $result_fetch['id'];

            # If user has not created a university profile yet (User login for the first time) 
            if ($result_fetch['university_status'] == 0) {

                $update_status = "UPDATE `user_information` SET `university_status`='1' WHERE `username`='$_SESSION[username]'";

                if (mysqli_query($con, $update_status)) {

                    $query = "SELECT * FROM `universities` WHERE `name`='$_POST[name]'";
                    $result = mysqli_query($con, $query);
                    if ($result) {

                        # University Name already exists 
                        if (mysqli_num_rows($result) > 0) {

                            $result_fetch = mysqli_fetch_assoc($result);
                            if ($result_fetch['name'] == $name) {

                                echo "
                                    <script>
                                        alert('University Name: $name Already Exists'); 
                                        window.location.href='create_university.php'; 
                                    </script>
                                    ";
                            }
                        }
                        # University Name doesn't already exist in the database. Insert the University Information 
                        else {

                            # Upload the file to the 'image_uploads' folder and then insert the University 
                            $image = $_FILES['image'];

                            $pic_name = $_FILES['image']['name'];
                            $pic_tmp_name = $_FILES['image']['tmp_name'];
                            $pic_size = $_FILES['image']['size'];
                            $pic_type = $_FILES['image']['type'];
                            $pic_error = $_FILES['image']['error'];

                            $file_extension =  explode('.', $pic_name);
                            $file_lower_extension = strtolower(end($file_extension));

                            $allowed_files = array('jpg', 'jpeg', 'png');

                            if (in_array($file_lower_extension, $allowed_files)) {

                                if ($pic_error === 0) {

                                    if ($pic_size < 1000000) {

                                        $pic_new_name = uniqid('', true) . "." . $file_lower_extension;

                                        $pic_directory = 'uploads/' . $pic_new_name;

                                        move_uploaded_file($pic_tmp_name, $pic_directory);

                                        $query = "INSERT INTO `universities`(`super_admin_id`, `name`, `location`, `num_students`, `description`, `picture_name`, `picture_link`) VALUES ('$super_id','$name','$location','$num_students','$description', '$picture_name','$pic_directory')";
                                        $result = mysqli_query($con, $query);

                                        if ($result) {

                                            echo "
                                                <script>
                                                    alert('University has been created'); 
                                                    window.location.href='university_profile.php?name=$name'; 
                                                    </script>
                                                ";
                                        }
                                    } else {

                                        echo "
                                            <script>
                                                alert('Your image size is too large for our system. Please re-upload a new image'); 
                                            </script>
                                            ";
                                    }
                                } else {

                                    echo "
                                        <script>
                                            alert('Unfortunately, there was an error uploading your image. Please try again~'); 
                                        </script>
                                        ";
                                }
                            } else {

                                echo "
                                    <script>
                                        alert('You may only upload images with the type jpg, jpeg, png'); 
                                    </script>
                                    ";
                            }
                        }
                    } else {

                        echo "
                            <script>
                                alert('The Server Is Down. Please Try Again'); 
                                window.location.href='SA_home.php'; 
                            </script>
                            ";
                    }
                } else {

                    echo "<script>
                        alert('The Server Is Down. Please Try Again'); 
                        window.location.href='SA_home.php'; 
                    </script>";
                }
            }
            # User has already created a university profile. This is their 2nd/3rd/etc.  
            else {

                $query = "SELECT * FROM `universities` WHERE `name`='$_POST[name]'";
                $result = mysqli_query($con, $query);
                if ($result) {

                    # University Name already exists 
                    if (mysqli_num_rows($result) > 0) {

                        $result_fetch = mysqli_fetch_assoc($result);
                        if ($result_fetch['name'] == $name) {

                            echo "<script>
                                alert('University Name: $name Already Exists'); 
                                window.location.href='create_university.php'; 
                                </script>";
                        }
                    }
                    # University Name doesn't already exist in the database. Insert the University
                    else {

                        # Upload the file to the 'image_uploads' folder and then insert the University 
                        $image = $_FILES['image'];

                        $pic_name = $_FILES['image']['name'];
                        $pic_tmp_name = $_FILES['image']['tmp_name'];
                        $pic_size = $_FILES['image']['size'];
                        $pic_type = $_FILES['image']['type'];
                        $pic_error = $_FILES['image']['error'];

                        $file_extension =  explode('.', $pic_name);
                        $file_lower_extension = strtolower(end($file_extension));

                        $allowed_files = array('jpg', 'jpeg', 'png');

                        if (in_array($file_lower_extension, $allowed_files)) {

                            if ($pic_error === 0) {

                                if ($pic_size < 1000000) {

                                    $pic_new_name = uniqid('', true) . "." . $file_lower_extension;

                                    $pic_directory = 'uploads/' . $pic_new_name;

                                    move_uploaded_file($pic_tmp_name, $pic_directory);

                                    $query = "INSERT INTO `universities`(`super_admin_id`, `name`, `location`, `num_students`, `description`, `picture_name`, `picture_link`) VALUES ('$super_id','$name','$location','$num_students','$description', '$picture_name','$pic_directory')";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {

                                        echo "
                                            <script>
                                                alert('University has been created'); 
                                                window.location.href='university_profile.php?name=$name'; 
                                                </script>
                                            ";
                                    }
                                } else {

                                    echo "
                                        <script>
                                            alert('Your image size is too large for our system. Please re-upload a new image'); 
                                        </script>
                                        ";
                                }
                            } else {

                                echo "
                                    <script>
                                        alert('Unfortunately, there was an error uploading your image. Please try again~'); 
                                    </script>
                                    ";
                            }
                        } else {

                            echo "
                                <script>
                                    alert('You may only upload images with the type jpg, jpeg, png'); 
                                </script>
                                ";
                        }
                    }
                } else {

                    echo "
                        <script>
                            alert('The Server Is Down. Please Try Again'); 
                            window.location.href='SA_home.php'; 
                        </script>
                        ";
                }
            }
        } else {
            echo "
                <script>
                    alert('The Server Is Down. Please Try Again'); 
                    window.location.href='SA_home.php'; 
                </script>
                ";
        }
    }
    ?>

</body>

</html>