<?php
include 'db/db.php';
include 'includes/head.php';
include 'includes/header.php';
include 'includes/productDAO.class.php';

if (isset($_GET["sku"])) {
    $productDAO = new ProductDAO($conn);
    $product = $productDAO->getProductBySKU($_GET["sku"]);
} else {
    header("Location: index.php");
}

?>

<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center"><?php echo $product->getName(); ?>.</h1>
        </div>
        <div class="mx-auto col-md-10">
            <div class="card bg-dark text-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="img/<?php echo $product->getSKU(); ?>.jpeg" class="card-img-top rounded" alt="<?php echo $product->getName(); ?>">
                        </div>
                        <div class="col-md-8 p-4">
                            <h4 class="card-title">Prix: <span class="badge bg-success gradient-1 float-end"><?php echo $product->getPrice(); ?> $</span> </h4>
                            <hr>
                            <h6 class="card-text"><?php echo $product->getDescription(); ?></h6>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias veritatis commodi similique necessitatibus maiores at qui est suscipit impedit doloremque culpa, sunt sequi. Repellendus sint exercitationem delectus suscipit, enim nobis.</p>
                            <h5>Disponibilité : <span class="badge bg-primary"><?php echo $product->getStock(); ?></span></h5>
                            <a href="#" class="btn btn-lg btn-light text-dark float-end">Ajouter au panier <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>