<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <?php
        include "./layouts-user/menu.php";
    ?>
    <!-- Navbar Section Ends Here -->
    <!-- fOOD MEnu Section Starts Here -->
    <?php
    include "./layouts-user/search.php";
    ?>
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            if(isset($_SESSION['status_add'])) {
                echo $_SESSION['status_add'];
                unset($_SESSION['status_add']);
            }
            $query_select = "SELECT * FROM foods where featured = 'Yes' and active = 'Yes'";
            $result_query_select = $server->query($query_select);
            if($result_query_select->num_rows > 0) {
                while($row = $result_query_select->fetch_assoc()) {
                    $id_food = $row['id'];
                    $title_food = $row['title'];
                    $dec_food = $row['description'];
                    $price_food = $row['price'];
                    $image_path_food = $row['image'];
                    echo '
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <img src="'.str_replace("../","",$image_path_food).'" alt="'.$title_food.'" class="img-responsive img-curve">
                            </div>
                            <div class="food-menu-desc">
                                <h4>'.$title_food.'</h4>
                                <p class="food-price">$'.$price_food.'</p>
                                <p class="food-detail">
                                    '.$dec_food.'
                                </p>
                                <br>

                                <a href="order.php?id='.$id_food.'" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>    
                    ';
                }
            }
            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- footer Section Starts Here -->
    <?php
        include "./layouts-user/footer.php";
    ?>
    <!-- footer Section Ends Here -->

</body>
</html>