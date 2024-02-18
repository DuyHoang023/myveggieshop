<?php
class ProductRepository
{
    protected function fetchAll($cond = null, $sort = null, $limit = null)
    {
        global $conn;
        $sql = "SELECT * FROM view_product";
        // SELECT * FROM view_product ORDER BY featured DESC LIMIT 0, 4

        if ($cond) {
            $sql .= " WHERE $cond";
        }

        if ($sort) {
            $sql .= " $sort";
        }

        if ($limit) {
            $sql .= " $limit";
        }

        $result = $conn->query($sql);
        if ($result === false) {
            die(mysqli_error($conn));
        }
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Product(
                    $row['id'],
                    $row['name'],
                    $row['barcode'],
                    $row['sku'],
                    $row['price'],
                    $row['discount_percentage'],
                    $row['discount_from_date'],
                    $row['discount_to_date'],
                    $row['featured_image'],
                    $row['inventory_qty'],
                    $row['category_id'],
                    $row['brand_id'],
                    $row['created_date'],
                    $row['description'],
                    $row['star'],
                    $row['featured'],
                    $row['sale_price']
                );
                $products[] = $product;
            }
        } else {
            return null;
        }
        return $products;
    }

    function getBy($array_conds, $array_sorts, $page, $itemPerPage)
    {
        if ($page) {
            $pageIndex = $page - 1;
        }

        $temp = [];
        foreach ($array_conds as $column => $cond) {
            $type = $cond['type'];
            $val = $cond['val'];
            $str = "$column $type ";
            if (in_array($type, array("BETWEEN", "LIKE"))) {
                $str .= " $val";
            } else {
                $str .= "'$val'";
            }
            $temp[] = $str;
        }

        $cond = null;
        if (count($array_conds)) {
            $cond = implode(" ", $temp);
        }
        // WHERE cagetory_id='2'

        $temp = [];
        foreach ($array_sorts as $key => $value) {
            $temp[] = "$key $value";
        }

        $sort = null;
        if (count($array_sorts)) {
            $sort = "ORDER BY " . implode(" ", $temp);
        }
        // ORDER BY featured DESC

        if ($itemPerPage) {
            $start = $pageIndex * $itemPerPage;
            $limit = "LIMIT $start, $itemPerPage";
        }
        // LIMIT 0, 4

        return $this->fetchAll($cond, $sort, $limit);
    }

    function getByPattern($pattern, $array_sorts)
    {
        $cond = "name LIKE '%$pattern%'";
        $temp = [];
        foreach ($array_sorts as $key => $value) {
            $temp[] = "$key $value";
        }

        $sort = null;
        if (count($array_sorts)) {
            $sort = "ORDER BY " . implode(" ", $temp);
        }
        // ORDER BY featured DESC
        return $this->fetchAll($cond, $sort);
    }

    function getTotalPage($pattern = null, $array_conds = null, $array_sorts = null, $page, $itemPerPage)
    {
        global $conn;
        $sql = "SELECT * FROM view_product";

        if ($page) {
            $pageIndex = $page - 1;
        }

        if ($pattern) {
            $sql .= " WHERE name LIKE '%$pattern%'";
        }

        $temp = [];
        foreach ($array_conds as $column => $cond) {
            $type = $cond['type'];
            $val = $cond['val'];
            $str = "$column $type";
            if (in_array($type, array("BETWEEN", "LIKE"))) {
                $str .= " $val";
            } else {
                $str .= "'$val'";
            }
            $temp[] = $str;
        }

        if (count($array_conds)) {
            $sql .= " WHERE " . implode(" AND ", $temp);
        }
        // WHERE cagetory_id='2'

        $temp = [];
        foreach ($array_sorts as $key => $value) {
            $temp = [$key, $value];
        }

        if (count($array_sorts)) {
            $sql .= " ORDER BY " . implode(" ", $temp);
        }
        // ORDER BY sale_price DESC

        $result = $conn->query($sql);
        $number_of_result = $result->num_rows;
        //determine the total number of pages available  
        return ceil($number_of_result / $itemPerPage);
    }
}
