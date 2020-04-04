<?php

session_start();

require_once('../Models/ProductModel.php');
require_once('../Controllers/ProductController.php');
require_once('../Controllers/DeliveryCostController.php');
require_once('../Controllers/SpecialOfferController.php');

$product = new ProductController();
if(!empty($_GET["action"])) {

    switch($_GET["action"]) {

        case "add":
            $product->addProduct();
        break;

        case "remove":
            $product->removeProduct();
        break;

        case "empty":
          unset($_SESSION["cart_item"]);
        break;
    }
}
?>

<html>
<head>
    <title>Acme Widget Company</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="shopping-cart">
    <div class="txt-heading">Shopping Cart</div>

    <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
    <?php
    if(isset($_SESSION["cart_item"])){
        $total_quantity = 0;
        $total_price = 0;
        ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Code</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Unit Price</th>
                <th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>
            <?php
            foreach ($_SESSION["cart_item"] as $item){
                if ($item["code"] == "RO1"){
                    $code = $item["code"]; $quantity = $item["quantity"]; $price = $item["price"];
                    $offer = new SpecialOfferController($code, $quantity,$price);
                    $unit_price = $offer->calculateSpecialOffer($code, $quantity,$price);
                    $item_price = 1 * $unit_price;
                }else{
                    $item_price = $item["quantity"]*$item["price"];
                }
                ?>
                <tr>
                    <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["code"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                    <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                    <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                    <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php

                $total_quantity += $item["quantity"];
                $sub_total += $item_price;
                $product = new DeliveryCostController($sub_total);
                $delivery_cost = $product->calculateDeliveryCost($sub_total);
                $total_price = ($delivery_cost + $sub_total);

            }
            ?>
            <tr>
                <td colspan="2" align="right">Delivery Cost:</td>
                <td align="right">1</td>
                <td align="right" colspan="2"><?php echo "$ ".number_format($delivery_cost, 2); ?></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?php echo $total_quantity + 1; ?></td>
                <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php
    }
    ?>
</div>

<div id="product-grid">
    <div class="txt-heading">Products</div>
    <?php
    $model = new ProductModel();
    $query = $model->selectProduct();
    $product_array = $model->runQuery($query);
    if (!empty($product_array)) {
        foreach($product_array as $key=>$value){
            ?>
            <div class="product-item">
                <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                    <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                        <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>
</body>
</html>
