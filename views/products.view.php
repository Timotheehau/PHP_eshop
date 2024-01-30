<?php include '../partials/header.php'; 
include '../config/curl_products.php';

?>

<div class="wrapper">
    <h1>Page de produits</h1>
    <img src="../assets/image/cocktail.jpg" alt="">
</div>
    <ul class="product-list">
        <?php foreach ($products as $product) : ?>
            <li>
                <a href="product.view.php?product=<?= $product ['id'] ?>"> <img src=" <?= $product['image'] ?>" alt=""></a>
                <h2><?= $product ['title'] ?></h2>
                <h3><?= substr($product ['description'], 50) ?></h3>
                <h2><?= $product ['price'] ?></h2>
                <button><a>Ajouter au panier</a></button>
            </li>
        <?php endforeach; ?>
    </ul>


<?php include '../partials/footer.php'; ?>