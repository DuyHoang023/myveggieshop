<?php
class HomeController
{
    function index()
    {
        $page = 1;
        $item_per_page = 4;
        $productRepository = new ProductRepository;
        $conds = [];
        $pattern = $_GET['pattern'] ?? null;
        $sorts = ['featured' => 'DESC'];
        $featuredProducts = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
        // Lấy 4 sản phẩm nổi bật
        // SELECT * FROM view_product ORDER BY featured DESC LIMIT 0, 4

        $sorts = ['created_date' => 'DESC'];
        $latestProducts = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
        // Lấy 4 sản phẩm mới nhất
        // SELECT * FROM view_product ORDER BY created_date DESC LIMIT 0, 4

        $cagetoryRepository = new CategoryRepository;
        $categories = $cagetoryRepository->getAll();
        foreach ($categories as $category) {
            $conds = [
                'category_id' => [
                    'type' => '=',
                    'val' => $category->getId()
                ]
            ];
            $categoryProduct = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
            // SELECT * FROM view_product WHERE category_id=2 LIMIT 0, 4
            $categoryProducts[] = [
                'categoryName' => $category->getName(),
                'products' => $categoryProduct
            ];
        }

        require 'view/home/index.php';
    }
}
