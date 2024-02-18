<?php require "layout/header.php" ?>
<div class="slideshow container-fluid">
    <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="../upload/slider1.jpg" alt="slider 1">
                </div>

                <div class="item">
                    <img src="../upload/slider2.jpg" alt="slider 2">
                </div>

                <div class="item">
                    <img src="../upload/slider3.jpg" alt="slider 3">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<!-- END SLIDESHOW -->
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row equal">
            <div class="col-xs-12">
                <h4 class="home-title">Sản phẩm nổi bật</h4>
            </div>
            <?php foreach ($featuredProducts as $product) : ?>
                <div class="col-xs-6 col-sm-3 product-card">
                    <?php require "layout/product.php" ?>
                </div>
            <?php endforeach ?>
        </div>

        <div class="row equal">
            <div class="col-xs-12">
                <h4 class="home-title">Sản phẩm mới nhất</h4>
            </div>
            <?php foreach ($latestProducts as $product) : ?>
                <div class="col-xs-6 col-sm-3 product-card">
                    <?php require "layout/product.php" ?>
                </div>
            <?php endforeach ?>
        </div>

        <?php foreach ($categoryProducts as $categoryProduct) :
            $categoryName = $categoryProduct['categoryName'];
            $products = $categoryProduct['products'];
        ?>
            <div class="row equal">
                <div class="col-xs-12">
                    <h4 class="home-title"><?= $categoryName ?></h4>
                </div>
                <?php if (is_array($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="col-xs-6 col-sm-3 product-card">
                            <?php require "layout/product.php" ?>
                        </div>
                    <?php endforeach ?>
                <?php else : ?>
                    <div class="text-center no-product b">Sản phẩm mới sẽ được cập nhật sau</div>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
</main>
<?php require "layout/footer.php" ?>