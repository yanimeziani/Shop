<?php

require_once 'db/db.php';
require_once 'includes/cart.class.php';
require_once 'includes/userDAO.class.php';
require_once 'includes/productDAO.class.php';

include 'includes/head.php';
include 'includes/header.php';


if (isset($_POST['quantity']) && isset($_POST['sku'])) {
    $quantity = $_POST['quantity'];
    $sku = $_POST['quantity'];
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center">Panier</h1>
        </div>
        <div class="col-md-8 mx-auto mt-3">
            <form action="cart.php" method="POST">
                <table class="table rounded-1">
                    <tbody>
                        <tr class="align-middle">
                            <div class="row">
                                <th scope="row"><img src="img/1.jpeg" alt="" class="img-thumbnail" width="100px"></th>
                                <td>
                                    Marteau de Thor
                                </td>
                                <td>
                                    Quantité: <input class="rounded ms-2" type="number" name="quantity" id="quantity" value="1" style="width: 50px;" min="1" max="5">
                                </td>
                                <td>
                                    Disponible : <span class="badge bg-primary">5</span>
                                </td>
                                <td>
                                    <a href="" class="btn btn-light float-end me-2">Voir l'item</a>
                                    <a href="" class="btn btn-danger float-end me-2">Supprimer</a>
                                </td>
                            </div>

                        </tr>
                    </tbody>
                </table>
                <input class="btn btn-dark float-end" type="submit" value="Acheter ">
            </form>
        </div>
    </div>
</div>

</div>

<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>