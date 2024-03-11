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
                        <input type="radio" id="filter-less-100" name="filter-price" value="0-20000" <?= isset($priceRange) && $priceRange == '0-20000' ? 'checked' : '' ?>>
                        <i class="fa"></i>
                        Giá dưới 20.000đ
                    </label>
                </li>
                <li>
                    <label for="filter-100-200">
                        <input type="radio" id="filter-100-200" name="filter-price" value="20000-30000" <?= isset($priceRange) && $priceRange == '20000-30000' ? 'checked' : '' ?>>
                        <i class="fa"></i>
                        20.000đ - 30.000đ
                    </label>
                </li>
                <li>
                    <label for="filter-200-300">
                        <input type="radio" id="filter-200-300" name="filter-price" value="30000-40000" <?= isset($priceRange) && $priceRange == '30000-40000' ? 'checked' : '' ?>>
                        <i class="fa"></i>
                        30.000đ - 40.000đ
                    </label>
                </li>
                <li>
                    <label for="filter-300-500">
                        <input type="radio" id="filter-300-500" name="filter-price" value="50000-60000" <?= isset($priceRange) && $priceRange == '40000-50000' ? 'checked' : '' ?>>
                        <i class="fa"></i>
                        50.000đ - 60.000đ
                    </label>
                </li>
                <li>
                    <label for="filter-500-1000">
                        <input type="radio" id="filter-500-1000" name="filter-price" value="60000-greater" <?= isset($priceRange) && $priceRange == '60000-greater' ? 'checked' : '' ?>>
                        <i class="fa"></i>
                        Giá trên 60.000đ
                    </label>
                </li>
            </ul>
        </div>
    </div>
</aside>