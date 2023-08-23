<?php
require_once 'db/db.php';
require_once 'includes/productDAO.class.php';

include 'includes/head.php';
include 'includes/header.php';

if (isset($_GET["sku"])) {
    $productDAO = new ProductDAO($conn);
    $product = $productDAO->getProductBySKU($_GET["sku"]);
    $name = $product->getName();
    $price = $product->getPrice();
    $description = $product->getDescription();
    $img = "img/" . $product->getSKU() . ".jpeg";
    $stock = $product->getStock();
} else {
    header("Location: index.php");
}

?>

<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center"><?= $name; ?></h1>
        </div>
        <div class="mx-auto col-md-6">
            <div class="card bg-dark text-light">
                <div class="card-body">
                    <form action="cart.php" method="POST">
                        <div class="row p-2">

                            <div class="col-md-4">
                                <img src="<?= $img; ?>" class="card-img-top rounded" alt="<?= $name; ?>">
                            </div>
                            <div class="col-md-8 p-4">
                                <h4 class="card-title">Prix: <span class="badge bg-success gradient-1 float-end"><?= $price; ?> $</span> </h4>
                                <hr>
                                <h6 class="card-text"><?= $description; ?></h6>
                                <h5>Disponibilité : <span class=" badge bg-primary"><?= $stock; ?></span></h5>
                                <h5>Quantité : <input class="rounded" type="number" name="quantity" id="quantity" value="1" min="1" max="5"></h5>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-light btn-lg mt-3 float-end" value="Ajouter au panier">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>