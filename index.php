<?php
require_once 'db/db.php';
require_once 'includes/productDAO.class.php';

include 'includes/head.php';
include 'includes/header.php';
?>
<div class="container-fluid mb-5">
    <div class=" row">
        <div class="col-md-12 gradient-1 text-light pt-1">
            <h1 class="text-center">Produits</h1>
        </div>
        <div class="col-md-12 bg-light text-dark pt-3">
            <p class="text-center">Aucun remboursement possible !</p>
        </div>
        <?php if (isset($_GET["message"])) { ?>
            <div class='col-md-12 alert alert-success text-center'><?php echo $_GET["message"]; ?></div>
        <?php } ?>

        <div class="container mt-2 px-5"">
            <div class=" row">
            <?php
            $productDAO = new ProductDAO($conn);
            $products = $productDAO->getAllProducts();
            foreach ($products as $product) {
                $name = $product->getName();
                $price = $product->getPrice();
                $img = "img/" . $product->getSKU() . ".jpeg";
            ?>

                <div class="col-md-3 mb-5">
                    <a href="product.php?<?= "sku=" . $product->getSKU(); ?>">
                        <div class="card border-1">
                            <img src="<?= $img; ?>" class="card-img pt-5" alt="<?= $name; ?>">
                            <div class="card-img-overlay">
                                <h6 class="card-title text-dark"><?= $name; ?> <span class="badge bg-success gradient-1 float-end"><?= $price; ?> $</span></h6>
                                <hr>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

</div>
</div>


<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>