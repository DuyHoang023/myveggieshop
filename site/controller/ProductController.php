<?php class ProductController
{
    // hiển thị danh sách sản phẩm đang bán
    function index()
    {
        $conds = [];
        $sorts = [];
        $page = $_GET['page'] ?? 1;
        $item_per_page = 10; // 10 sản phẩm mỗi trang
        // Tìm sản phẩm theo danh mục
        $pattern = $_GET['pattern'] ?? null;
        $category_id = $_GET['category_id'] ?? null;
        if ($category_id) {
            $conds = [
                'category_id' => [
                    'type' => '=',
                    'val' => $category_id
                ]
            ];
            // SELECT * FROM view_product WHERE category_id=1
        }

        // ?price-range=300000-500000
        $priceRange = $_GET['price-range'] ?? null;
        if ($priceRange) {
            $temp = explode('-', $priceRange);
            $start_price = $temp[0];
            $end_price = $temp[1];
            $conds = [
                'sale_price' => [
                    'type' => 'BETWEEN',
                    'val' => "$start_price AND $end_price"
                ]
            ];
            // SELECT * FROM view_product WHERE sale_price BETWEEN 30000 AND 40000
            if ($end_price == 'greater') {
                $conds = [
                    'sale_price' => [
                        'type' => '>=',
                        'val' => $start_price
                    ]
                ];
            }
            // SELECT * FROM view_product WHERE sale_price >= 600000
        }

        // sort=price-desc
        $sort = $_GET['sort'] ?? null;
        if ($sort) {
            $temp = explode('-', $sort);
            $dummyCol = $temp[0]; //price
            $order = $temp[1]; //desc
            $order = strtoupper($order); //DESC
            $map = ['price' => 'sale_price', 'alpha' => 'name', 'created' => 'created_date'];
            $colName = $map[$dummyCol];

            $sorts = [$colName => $order];
            // SELECT * FROM view_product ORDER BY sale_price DESC
        }

        $productRepository = new ProductRepository;
        if ($pattern) {
            $products = $productRepository->getByPattern($pattern, $sorts, $page, $item_per_page);
        } else {
            $products = $productRepository->getBy($conds, $sorts, $page, $item_per_page);
        }
        $categoryRepository = new CategoryRepository;
        $categories = $categoryRepository->getAll();
        $totalPage = $productRepository->getTotalPage($pattern, $conds, $sorts, $page, $item_per_page);
        require 'view/product/index.php';
    }

    function detail()
    {
        $pattern = $_GET['pattern'] ?? null;

        $id = $_GET['id'];
        $productRepository = new ProductRepository;
        $product = $productRepository->find($id);
        $categoryRepository = new CategoryRepository;
        $categories = $categoryRepository->getAll();
        $category_id = $product->getCategoryId();
        // sản phẩm có liên quan là sản phẩm có cùng danh mục
        $conds = [
            'category_id' => [
                'type' => '=',
                'val' => $category_id //3
            ]
        ];

        // SELECT * FROM view_product WHERE category_id=3
        $relatedProducts = $productRepository->getBy($conds);
        require 'view/product/detail.php';
    }

    function searchBar()
    {
        $page = 1;
        $item_per_page = 4;
        $pattern = $_GET['pattern'];
        $productRepository = new ProductRepository;
        $products = '';
        if ($pattern !== '') {
            $products = $productRepository->getByPattern($pattern, $sorts = null, $page, $item_per_page);
        }
        $jsonProducts = array();
        if ($products !== '' && $products !== null) {
            foreach ($products as $product) {
                $jsonProducts[] = array(
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'featured_image' => $product->getFeaturedImage(),
                );
            }
        }
        echo json_encode($jsonProducts);
    }
}
