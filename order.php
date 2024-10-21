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
    <?php 
        include "./layouts-user/menu.php";
        if(!$server->connect_error) {
            if(isset($_GET['id'])) {
                $id_food = $_GET['id'];
                $query_select = "SELECT * FROM foods where id = ?";
                $result_query_select = $server->prepare($query_select);
                $result_query_select->bind_param("s",$id_food);
                $result_query_select->execute();
                $selectedFood = $result_query_select->get_result();
                if($selectedFood->num_rows == 1) {
                    $food = $selectedFood->fetch_assoc();
                    $food_title = $food['title'];
                    $food_price = $food['price'];
                    $food_image_path = str_replace("../","",$food['image']);
                    // create order
                    if(isset($_POST['submit'])) {
                        $qty = $_POST['qty'];
                        $total = $qty * $food_price;
                        date_default_timezone_set("America/New_York");
                        $date = date("F j, Y, g:i a");
                        $full_name = $_POST['full-name'];
                        $contact = $_POST['contact'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $query_insert = "INSERT INTO orders SET qutity = ?, total = ?, full_name = ?, address = ?, email = ?, contact = ?, date = ?, id_food  = ?";
                        $result_query_insert = $server->prepare($query_insert);
                        $result_query_insert->bind_param("iisssssi",$qty, $total, $full_name, $address, $email, $contact, $date, $id_food);
                        $result_query_insert->execute();
                        if($result_query_insert) {
                            $_SESSION['status_add'] = "<p class='text-success'>Success Add</p>";
                        } else {
                            $_SESSION['status_add'] = "<p class='text-error'>Failure Add</p>";
                        }
                        header("location:foods.php");
                        exit();
                    }
                } else {
                    header("location:foods.php");
                    exit();    
                }
            } else {
                header("location:foods.php");
                exit();
            }
        } else {
            header("location:foods.php");
            exit();
        }
    ?>
    <!-- Navbar Section Starts Here -->
        <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?php echo $food_image_path ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <h3><?php echo $food_title ?></h3>
                        <p class="food-price">$<?php echo $food_price ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. web2 alaqsa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@web2 alaqsa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- footer Section Starts Here -->
    <?php 
        include "./layouts-user/footer.php"
    ?>
    <!-- footer Section Ends Here -->

</body>
</html>