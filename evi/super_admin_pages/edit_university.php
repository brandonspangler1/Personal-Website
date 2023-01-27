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

if (isset($_GET['name'])) {

    $query = "SELECT * FROM `universities` WHERE `name`='$_GET[name]'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $fetch_result = mysqli_fetch_assoc($result);

        $uni_super_id = $fetch_result['super_admin_id'];
        $uni_name = $fetch_result['name'];
        $uni_location = $fetch_result['location'];
        $uni_num_students = $fetch_result['num_students'];
        $uni_description = $fetch_result['description'];
        $uni_pic_name = $fetch_result['picture_name'];
        $uni_pic_link = $fetch_result['picture_link'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit University Profile</title>
    <link rel="stylesheet" href="css/edit_university.css" />
</head>

<body>

    <header>
        <div class="header">
            <button onClick="location.href = '../logout.php'"><img src="../images/logout.png"></button>

            <div class="title">
                <h1>Update</h1>
                <h1>University Profile</h1>
            </div>

            <button onClick="location.href = 'SA_home.php'"><img src="../images/home.png"></button>
        </div>
    </header>

    <div class="update_university">
        <form style="text-align: center" method="POST" enctype="multipart/form-data">

            <div class="university_description">
                <div class="basic_information">
                    <label for="uni_name">University Name</label><br>
                    <input type="text" id="uni_name" placeholder="<?php echo $uni_name ?>" name="name" readonly />
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

            <button type="submit" class="create-btn" name="university_update">EDIT</button>
        </form>
    </div>

    <?php

    if (isset($_POST['university_update'])) {

        $name = $uni_name;
        $location = $_POST['location'];
        $num_students = $_POST['num_students'];
        $description = $_POST['description'];
        $picture_name = $_POST['picture_name'];

        # Edit the University Profile Information 
        $query = "SELECT * FROM `universities` WHERE `name`='$name'";
        $result = mysqli_query($con, $query);
        if ($result) {

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

                        $query = "UPDATE `universities` SET `location`='$location',`num_students`='$num_students',`description`='$description',`picture_name`='$picture_name',`picture_link`='$pic_directory' WHERE `name`='$name'";
                        $result = mysqli_query($con, $query);

                        if ($result) {

                            echo "
                                <script>
                                    alert('University has been updated~'); 
                                    window.location.href='university_profile.php?name=$uni_name'; 
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