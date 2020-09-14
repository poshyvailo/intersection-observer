<?php
/**
 * @var array $products
 */
?>

<div class="container" style="margin-top: 20px">
    <div class="row row-cols-1 row-cols-md-3">
    <?php foreach ($products as $product) : ?>
        <div class="col mb-4">
            <div class="card h-100">
                <img src="images/no-photo.svg" data-src="<?= $product['image'] ?>" class="card-img-top lazy-load" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['title'] ?></h5>
                    <p class="card-text"><?= $product['text'] ?></p>
                </div>
                <div class="card-footer">
                    <p class="card-text"><a href="#" class="btn btn-primary">Buy now!</a></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="viewed-products" data-api-url="/api/get-viewed-products">
        <div class="row row-cols-1 row-cols-md-3"></div>
    </div>
</div>



