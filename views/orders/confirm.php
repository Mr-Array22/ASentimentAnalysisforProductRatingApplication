<?php if (isset($_SESSION['order']) && $_SESSION['order'] == 'completed') : ?>

    <h1>Your order has been confirmed</h1>
    <p>Successful order</p>
    <br>

    <?php if (isset($order)) : ?>
        <h3>Order data:</h3>
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

<?php elseif ((isset($_SESSION['order']) && $_SESSION['order'] == 'completed')) : ?>
    <h1>Tu pedido no ha podido procesarse </h1>
<?php endif; ?>