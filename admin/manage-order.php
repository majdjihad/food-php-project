<html>
<head>


    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
        <!-- Menu Section Starts -->
    <?php
        $page_title = "Order";
        include '../layouts/menu.php';
        if($_SESSION['login_status']) {
            if($server->connect_error) {
                echo "connection error";
            } else {
                if(isset($_SESSION['status_add'])) {
                    echo $_SESSION['status_add'];
                    unset($_SESSION['status_add']);
                } else if(isset($_SESSION['status_update'])) {
                    echo $_SESSION['status_update'];
                    unset($_SESSION['status_update']);
                } else if(isset($_SESSION['status_delete'])) {
                    echo $_SESSION['status_delete'];
                    unset($_SESSION['status_delete']);
                }
                $query_select = "SELECT * FROM orders";
                $result_query_select = $server->query($query_select);
                if($result_query_select->num_rows > 0) {
                    $count = 0;
                    echo '
                    <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>        
                    ';
                    while($order_row = $result_query_select->fetch_assoc()) {
                        $food_id = $order_row['id_food'];
                        $query_select_foodMName = "SELECT * FROM foods";
                        $result_query_select_foodName = $server->query($query_select_foodMName);
                        $food_row = $result_query_select_foodName->fetch_assoc();
                        $food_title = $food_row['title'];
                        $food_price = $food_row['price'];
                        $order_qty = $order_row['qutity'];
                        $order_total = $order_row['total'];
                        $order_fullName = $order_row['full_name'];
                        $order_address = $order_row['address'];
                        $order_email = $order_row['email'];
                        $order_contact = $order_row['contact'];
                        $order_date = $order_row['date'];
                        echo '
                            <tr>
                                <td>'.$count.'</td>
                                <td>'.$food_title.'</td>
                                <td>'.$food_price.'</td>
                                <td>'.$order_qty.'</td>
                                <td>'.$order_total.'</td>
                                <td>'.$order_date.'</td>
                                <td>'.$order_fullName.'</td>
                                <td>'.$order_contact.'</td>
                                <td>'.$order_email.'</td>
                                <td>'.$order_address.'</td>
                                <td>
                                    <a href="../order.php?id='.$food_id.'" class="btn-secondary">Update Order</a>
                                </td>
                            </tr>
                        ';
                        $count++;
                    }
                } else {
                    echo "No Order Found";
                }
            }
        } else {
            header("location:login.php");
        }
    ?>
    <!-- Menu Section Ends -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br/><br/><br/>

        <a href="add-food.php" class="btn-primary">Add Order</a>
        <br><br>

        </table>
    </div>

</div>
    <!-- Footer Section Starts -->
    <?php
    include '../layouts/footer.php';
    ?>
    <!-- Footer Section Ends -->
</body>
</html>