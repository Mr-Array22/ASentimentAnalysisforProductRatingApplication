<h1>Details of order</h1>

<?php if (isset($order)) : ?>
    <?php if (isset($_SESSION['admin'])) : ?>
        <h3>Change status of the order</h3>
        <form action="<?= base_url ?>orders/status" method="POST">
            
            <input type="hidden" name="order_id" value="<?=$order->id?>">
            <select name="status" id="">
                <option value="confirm" <?=$order->status == "confirm" ? 'selected' : '';?>>back order</option>
                <option value="preparation" <?=$order->status == "preparation" ? 'selected' : '';?>>Preparation</option>
                <option value="ready" <?=$order->status == "ready" ? 'selected' : '';?>>Prepare to send</option>
                <option value="sended" <?=$order->status == "sended" ? 'selected' : '';?>>Sended</option>
            </select>
            <input type="submit" value="Change status">
        </form>
        <br>
    <?php endif; ?>

    <h3>Shipping Address:</h3>
    State: <?= $order->state ?> <br>
    City: <?= $order->city ?> <br>
    Address: <?= $order->adress ?> <br>

    <br>

    <h3>Order data:</h3>
    Status: <?=Helpers::showStatus($order->status)?> <br>
    Order number: <?= $order->id ?> <br>
    Total to pay: $<?= $order->cost ?> <br>
    Products:
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Units</th>
        </tr>
        <?php while ($product = $products->fetch_object()) : ?>
            <tr>
                <td>
                    <?php if ($product->image != null) : ?>
                        <img src="<?= base_url ?>uploads/images/<?= $product->image ?>" alt="" class="img_cart">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/camiseta.png" alt="" class="img_cart">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url ?>products/show&id=<?= $product->id ?>">

                        <?= $product->name ?>

                    </a>
                </td>
                <td>
                    <?= $product->price ?>
                </td>
                <td>
                    <?= $product->units_order ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>