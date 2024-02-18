<?php require 'layout/header.php' ?>
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tất cả sản phẩm</span></li>
                </ol>
            </div>
            <div class="col-xs-3 hidden-lg hidden-md">
                <a class="hidden-lg pull-right btn-aside-mobile" href="javascript:void(0)">Bộ lọc <i class="fa fa-angle-double-right"></i></a>
            </div>

            <div class="clearfix"></div>
            <aside class="col-md-3">
                <div class="inner-aside">
                    <div class="category">
                        <h5>Danh mục sản phẩm</h5>
                        <ul>
                            <li class="<?= empty($category_id) ? 'active' : '' ?>">
                                <a href="?c=product" title="Tất cả sản phẩm" target="_self">Tất cả sản phẩm
                                </a>
                            </li>
                            <?php foreach ($categories as $category) : ?>
                                <li class="<?= $category_id == $category->getId() ? 'active' : '' ?>">
                                    <a href="?c=product&category_id=<?= $category->getId() ?>" title="<?= $category->getName() ?>" target="_self"><?= $category->getName() ?></a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="price-range">
                        <h5>Khoảng giá</h5>
                        <ul>
                            <li>
                                <label for="filter-less-100">
                                    <input type="radio" id="filter-less-100" name="filter-price" value="0-20000" <?= $priceRange == '0-20000' ? 'checked' : '' ?>>
                                    <i class="fa"></i>
                                    Giá dưới 20.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-100-200">
                                    <input type="radio" id="filter-100-200" name="filter-price" value="20000-30000" <?= $priceRange == '20000-30000' ? 'checked' : '' ?>>
                                    <i class="fa"></i>
                                    20.000đ - 30.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-200-300">
                                    <input type="radio" id="filter-200-300" name="filter-price" value="30000-40000" <?= $priceRange == '30000-40000' ? 'checked' : '' ?>>
                                    <i class="fa"></i>
                                    30.000đ - 40.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-300-500">
                                    <input type="radio" id="filter-300-500" name="filter-price" value="50000-60000" <?= $priceRange == '40000-50000' ? 'checked' : '' ?>>
                                    <i class="fa"></i>
                                    50.000đ - 60.000đ
                                </label>
                            </li>
                            <li>
                                <label for="filter-500-1000">
                                    <input type="radio" id="filter-500-1000" name="filter-price" value="60000-greater" <?= $priceRange == '60000-greater' ? 'checked' : '' ?>>
                                    <i class="fa"></i>
                                    Giá trên 60.000đ
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="col-md-9 products">
                <div class="row equal">
                    <div class="col-xs-6">
                        <h4 class="home-title">Tất cả sản phẩm</h4>
                    </div>
                    <div class="col-xs-6 sort-by">
                        <div class="pull-right">
                            <label class="left hidden-xs" for="sort-select">Sắp xếp: </label>
                            <select id="sort-select">
                                <option value="" <?= !isset($sort) ? 'selected' : '' ?>>Mặc định</option>
                                <option value="price-asc" <?= $sort == 'price-asc' ? 'selected' : '' ?>>Giá tăng dần</option>
                                <option value="price-desc" <?= $sort == 'price-desc' ? 'selected' : '' ?>>Giá giảm dần</option>
                                <option value="alpha-asc" <?= $sort == 'alpha-asc' ? 'selected' : '' ?>>Từ A-Z</option>
                                <option value="alpha-desc" <?= $sort == 'alpha-desc' ? 'selected' : '' ?>>Từ Z-A</option>
                                <option value="created-asc" <?= $sort == 'created-asc' ? 'selected' : '' ?>>Cũ đến mới</option>
                                <option value="created-desc" <?= $sort == 'created-desc' ? 'selected' : '' ?>>Mới đến cũ</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php if (is_array($products)) : ?>
                        <?php foreach ($products as $product) : ?>
                            <div class="col-xs-6 col-sm-3 product-card">
                                <?php require "layout/product.php" ?>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="text-center no-product b">Không có sản phẩm</div>
                    <?php endif ?>
                </div>
                <?php require 'layout/pagination.php' ?>
            </div>
        </div>
    </div>
</main>
<?php require 'layout/footer.php' ?>