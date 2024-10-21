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
    <!-- navbar Section Starts Here -->
    <?php
    include "./layouts-user/menu.php";
    ?>
    <!-- navbar Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <?php
    include "./layouts-user/search.php";
    ?>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categoryes</h2>
            <?php
            $query_select = "SELECT * FROM categorys where featured = 'Yes' and active = 'Yes' limit 3";
            $result_query_select = $server->query($query_select);
            if($result_query_select->num_rows >  0) {
                while($row = $result_query_select->fetch_assoc()) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_path = $row['image'];
                    echo '
                    <a href="category-foods.php?id='.$id.'">
                    <div class="box-3 float-container">
                        <img src="'.str_replace("../","",$image_path).'" alt="'.$title.'" class="img-responsive img-curve">
                        <h3 class="float-text text-white">'.$title.'</h3>
                    </div>
                    </a>
                    ';
                }
            }
            ?>
            <div class="clearfix"></div>
            <p class="text-center">
            <a href="./categories.php">See All categories</a>
        </p>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $query_select = "SELECT * FROM foods where featured = 'Yes' and active = 'Yes' limit 6";
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

        <p class="text-center">
            <a href="./foods.php">See All Foods</a>
        </p>
    </section>
    <?php
        include "./layouts-user/footer.php";
    ?>
</body>
</html>