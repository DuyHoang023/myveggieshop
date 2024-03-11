<?php
class Product
{
	protected $id;
	protected $name;
	protected $barcode;
	protected $sku;
	protected $price;
	protected $discount_percentage;
	protected $discount_from_date;
	protected $discount_to_date;
	protected $featured_image;
	protected $inventory_qty;
	protected $category_id;
	protected $brand_id;
	protected $created_date;
	protected $description;
	protected $star;
	protected $featured;
	protected $sale_price;

	function __construct(
		$id,
		$name,
		$barcode,
		$sku,
		$price,
		$discount_percentage,
		$discount_from_date,
		$discount_to_date,
		$featured_image,
		$inventory_qty,
		$category_id,
		$brand_id,
		$created_date,
		$description,
		$star,
		$featured,
		$sale_price
	) {
		$this->id = $id;
		$this->name = $name;
		$this->barcode = $barcode;
		$this->sku = $sku;
		$this->price = $price;
		$this->discount_percentage = $discount_percentage;
		$this->discount_from_date = $discount_from_date;
		$this->discount_to_date = $discount_to_date;
		$this->featured_image = $featured_image;
		$this->inventory_qty = $inventory_qty;
		$this->category_id = $category_id;
		$this->brand_id = $brand_id;
		$this->created_date = $created_date;
		$this->description = $description;
		$this->star = $star;
		$this->featured = $featured;
		$this->sale_price = $sale_price;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getBarcode()
	{
		return $this->barcode;
	}

	public function getSku()
	{
		return $this->sku;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getDiscountPercentage()
	{
		return $this->discount_percentage;
	}

	public function getDiscountFromDate()
	{
		return $this->discount_from_date;
	}

	public function getDiscountToDate()
	{
		return $this->discount_to_date;
	}

	public function getFeaturedImage()
	{
		return $this->featured_image;
	}

	public function getInventoryQty()
	{
		return $this->inventory_qty;
	}

	public function getCategoryId()
	{
		return $this->category_id;
	}

	public function getBrandId()
	{
		return $this->brand_id;
	}

	public function getCreatedDate()
	{
		return $this->created_date;
	}

	function getDescription()
	{
		return $this->description;
	}

	function getStar()
	{
		return $this->star;
	}

	function getFeatured()
	{
		return $this->featured;
	}

	function getSalePrice()
	{
		return $this->sale_price;
	}

	function getImageItems()
	{
		$imageItemRepository = new ImageItemRepository();
		$imageItems = $imageItemRepository->getByProductId($this->id);
		return $imageItems;
	}

	function getBrand()
	{
		$brandRepository = new BrandRepository();
		$brand = $brandRepository->find($this->brand_id);
		return $brand;
	}

	function getComments()
	{
		$commentRepository = new CommentRepository();
		$comments = $commentRepository->getByProductId($this->id);
		return $comments;
	}
}
