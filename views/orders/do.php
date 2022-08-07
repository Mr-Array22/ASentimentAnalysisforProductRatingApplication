<?php if(isset($_SESSION['user_identity'])): ?>
    <h1>Orders</h1>
    <p>
        <a href="<?=base_url?>cart/index">View product and price of orders</a>
    </p>
    <br>
    <h3>Shipping address</h3>
    <form action="<?=base_url?>orders/add" method="POST">
        <label for="state">State</label>
        <input type="text" name="state">

        <label for="city">City</label>
        <input type="text" name="city">

        <label for="adress">Adress</label>
        <input type="text" name="adress">

        <input type="submit" value="Confirm order">
    </form>
<?php else: ?>
    <h1>You need to be identified</h1>
    <p>You need to log in to place an order</p>
<?php endif; ?>