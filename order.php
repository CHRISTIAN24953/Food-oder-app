<?php include('partials-front/menu.php'); ?>

<?php 
    if(isset($_GET['food_id']))
    {
        $food_id = $_GET['food_id'];
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        header('location:'.SITEURL);
    }
?>

<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-menu-img">
                    <?php if($image_name==""){ echo "<div class='error'>Image not Available.</div>"; } else { ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food" class="img-responsive img-curve">
                    <?php } ?>
                </div>
                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">GH¢ <?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Christian Yeboah" class="input-responsive" required>
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 0595xxxxxx" class="input-responsive" required>
                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@example.com" class="input-responsive" required>
                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <div class="order-label">Payment Method</div>
                <input type="radio" name="payment_method" value="Cash On Delivery" id="cod" checked onclick="toggleMoMo()"> <label for="cod">Cash On Delivery (COD)</label><br>
                <input type="radio" name="payment_method" value="MoMo" id="momo" onclick="toggleMoMo()"> <label for="momo">Mobile Money (MoMo)</label>

                <div id="momo-fields" style="display:none; background:#f1f1f1; padding:10px; margin-top:10px;">
                    <div class="order-label">MoMo Number</div>
                    <input type="text" name="momo_number" id="momo_number" placeholder="E.g. 0595784424" class="input-responsive">
                    <div class="order-label">MoMo Transaction ID</div>
                    <input type="text" name="momo_trans_id" id="momo_trans_id" placeholder="E.g. MOMO123456" class="input-responsive">
                </div>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
</section>

<script>
function toggleMoMo(){
    var momoRadio = document.getElementById('momo');
    var momoFields = document.getElementById('momo-fields');
    if(momoRadio.checked){
        momoFields.style.display='block';
        document.getElementById('momo_number').required = true;
        document.getElementById('momo_trans_id').required = true;
    } else {
        momoFields.style.display='none';
        document.getElementById('momo_number').required = false;
        document.getElementById('momo_trans_id').required = false;
    }
}
</script>

<?php 
    if(isset($_POST['submit']))
    {
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $order_date = date("Y-m-d H:i:s");
        $status = "Ordered";
        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];
        $payment_method = $_POST['payment_method'];
        $momo_number = $_POST['momo_number'] ?? '';
        $momo_trans_id = $_POST['momo_trans_id'] ?? '';

        $sql2 = "INSERT INTO tbl_order SET
            food = '$food',
            price = $price,
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            payment_method = '$payment_method',
            momo_number = '$momo_number',
            momo_trans_id = '$momo_trans_id',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
        ";
        $res2 = mysqli_query($conn, $sql2);
        if($res2==true)
        {
            $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
            header('location:'.SITEURL);
        }
        else
        {
            $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
            header('location:'.SITEURL);
        }
    }
?>

<?php include('partials-front/footer.php'); ?>