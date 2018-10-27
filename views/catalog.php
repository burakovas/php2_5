<style>
    * {
        font-size: 14px;
    }
    .container {
        width: 70%;
    }
    .product {
        float: left;
        width: 100px;
        margin: 0 6px;
        height: 175px;
        border: 1px solid black;
    }
</style>
<div class="container">
    <?php foreach ($data as $product): ?>
        <a href="/product.php?id=<?=$product['id']?>">
        <div class="product">
            <h1><?= $product['name'] ?></h1>
            <p><?= $product['description'] ?></p>
            <img src='/public/img/<?=$product['imageName']?>' alt='' width='50' />
            <a href="/public/index.php?id=<?=$product['id']?>&oper=addToCart">ДОБАВИТЬ В КОРЗИНУ</a>
        </div>
        </a>
    <?php endforeach; ?>
</div>
