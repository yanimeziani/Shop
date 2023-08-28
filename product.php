<?php
require_once 'db/db.php';
require_once 'class/productDAO.class.php';
require_once 'includes/session.php';

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
    $sku = $product->getSKU();
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
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <form action="cart.php" method="POST">
                        <div class="row p-2">

                            <div class="col-md-5">
                                <img src="<?= $img; ?>" class="card-img-top rounded border-1 border-dark" alt="<?= $name; ?>">
                            </div>
                            <div class="col-md-7 p-4">
                                <h4 class="card-title">Prix: <span class="badge bg-dark float-end"><?= $price; ?> $</span> </h4>
                                <hr>
                                <h6 class="card-text"><?= $description; ?></h6>

                                <h5>Quantité : <input class="rounded" type="number" name="quantity" id="quantity" value="1" min="1" max="<?= $stock; ?>"></h5>
                            </div>
                            <hr class="mt-3">
                            <div class="col-md-4">
                                <h5>Disponibilité : <span class=" badge bg-primary"><?= $stock; ?></span></h5>
                            </div>
                            <div class="col-md-8">
                                <input type="hidden" name="sku" id="sku" value="<?= $sku ?>">
                                <input type="submit" class="btn btn-primary gradient-1 btn-lg mt-3 float-end border-0" value="Ajouter au panier">
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