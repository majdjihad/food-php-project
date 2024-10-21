<html>
<head>


    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <?php
    $page_title = "Update-food";
    include '../layouts/menu.php';
    if(isset($_SESSION['login_status'])) {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $query_select = "SELECT * FROM foods where id = ?";
            $result_query_select = $server->prepare($query_select);
            $result_query_select->bind_param("s",$id);
            $result_query_select->execute();
    
            $selectedFood = $result_query_select->get_result();
            
            if($selectedFood->num_rows == 1) {
    
                $food = $selectedFood->fetch_assoc();
                $current_title = $food['title'];
                $current_description = $food['description'];
                $current_price = $food['price'];
                $current_id_category = $food['id_category'];
                $current_featured = $food['featured'];
                $current_active = $food['active'];
                if(isset($_POST['submit'])) {
                    $new_title = $_POST['title'];
                    $new_description = $_POST['description'];
                    $new_price = $_POST['price'];
                    $new_id_category = $_POST['category'];
                    $new_featured = $_POST['featured'];
                    $new_active = $_POST['active'];
                    if(isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                        $name = $_FILES['image']['name'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                        $ext = explode(".",$name);
                        $ext = end($ext);
                        $new_image_path = "../images/foods/".$new_title.".".$ext;
                        move_uploaded_file($tmp_name,$new_image_path);
                    } else {
                        $new_image_path = $food['image'];
                    }
                    $query_update = "UPDATE foods set title = ?, description = ?, image = ?, price = ?, id_category = ?, featured = ?, active = ? where id = ?";
                    $result_query_update = $server->prepare($query_update);
                    $result_query_update->bind_param("sssissss",$new_title,$new_description,$new_image_path,$new_price, $new_id_category ,$new_featured,$new_active,$id);
                    $result_query_update->execute();
                    if($result_query_update) {
                        $_SESSION["status_update"] = "<p class='text-success'>Success Update</p>";
                    } else {
                        $_SESSION["status_update"] = "<p class='text-error'>Failure Update</p>";
                    }    
                    header("location:manage-food.php");
                    exit();
                }
            } else {
                header("location:manage-food.php");
                exit();    
            }
        } else {
            header("location:manage-food.php");
            exit();
        }
    } else {
        header("location:login.php");
    }
?>
    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $current_title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5">
                            <?php echo $current_description ?>
                        </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $current_price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <img src="<?php echo $food['image']; ?>" style="width: 50px;"  alt="<?php echo $current_title.'.'.$ext; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                        <?php
                            $query_select = "SELECT * FROM categorys";
                            $query_result = $server->query($query_select);
                            if($query_result->num_rows > 0) {
                                while($row = $query_result->fetch_assoc()) {
                                    $id_cat = $row['id'];
                                    $title_cat = $row['title'];
                                    echo "<option value='$id_cat'>$title_cat</option>";
                                }
                            } else {
                                echo "<option value='0'>No Category Found</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($food['featured'] == 'Yes') echo 'checked'?>> Yes
                        <input type="radio" name="featured" value="No" <?php if($food['featured'] == 'No') echo 'checked'?>> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($food['active'] == 'Yes') echo 'checked'?>> Yes
                        <input type="radio" name="active" value="No" <?php if($food['active'] == 'No') echo 'checked'?>> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="current_image" value="">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>
    <!-- Footer Section Starts -->
    <?php
    include '../layouts/footer.php';
    ?>
    <!-- Footer Section Ends -->
</body>
</html>