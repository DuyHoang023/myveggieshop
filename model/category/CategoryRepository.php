<?php
class CategoryRepository extends BaseRepository
{
	protected function fetchAll($cond = null)
	{
		global $conn;
		$sql = "SELECT * from category";

		if ($cond) {
			$sql .= ' WHERE ' . $cond;
		}

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$category = new Category(
					$row['id'],
					$row['name'],
				);
				$categories[] = $category;
			}
			return $categories;
		}
	}

	function getAll()
	{
		return $this->fetchAll();
	}
}
