<?php

class Product_model extends CI_Model
{

	function product_code()
	{
		$year = date('Y');

		$prefix = "P-";

		$query = $this->db->query("SELECT max(product_code) as max_product_code FROM product where product_code LIKE '{$prefix}%'");
		$result = $query->row();


		if ($result->max_product_code) {
			$next_product_code = ++$result->max_product_code;
		} else {
			$next_product_code = $prefix . '0001';
		}
		return $next_product_code;
	}

}
