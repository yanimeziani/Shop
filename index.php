<?php
include 'includes/head.php';
require_once 'db/db.php';
require_once 'includes/product.class.php';
require_once 'includes/productDAO.class.php';
?>

<?php
include 'includes/header.php';
?>
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center">Produits.</h1>
        </div>

        <div class="container">
            <div class="row">
                <?php
                $productDAO = new ProductDAO($conn);
                $products = $productDAO->getAllProducts();
                foreach ($products as $product) {
                ?>
                    <div class="col-md-4 mb-2">
                        <div class="card bg-dark text-light">
                            <img src="img/<?php echo $product->getSKU(); ?>.jpeg" class="card-img-top" alt="<?php echo $product->getName(); ?>">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $product->getName(); ?> <span class="badge bg-success gradient-1 float-end"><?php echo $product->getPrice(); ?> $</span></h6>
                                <a class="btn btn-light text-dark float-end" href="product.php?<?php echo "product_name=" . $product->getName() . "&product_sku=" . $product->getSKU() . "&product_description=" . $product->getDescription() . "&product_price=" . $product->getPrice() . " &product_stock=" . $product->getStock() ?>">Voir l'item <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
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