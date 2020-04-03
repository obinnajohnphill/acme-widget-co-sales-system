<?php


/**
 * Product Model holds the product business (database) logic
 *
 */

require_once('DatabaseConnection.php');

class ProductModel extends DatabaseConnection
{

/**
 * Query products from database
 */
    function runQuery($query) {
        $result = mysqli_query($this->connectDB(),$query);
        while($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if(!empty($resultset))
            return $resultset;
    }

/**
 * Query number of products from database
 */
    function numRows($query) {
        $result  = mysqli_query($this->connectDB(),$query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

/**
 * SQL statement to select all products from database
 */
    function selectProduct(){
        return "SELECT * FROM product_table ORDER BY id ASC";
    }

/**
 * SQL statement to select all products by code from database
 */
    public function selectProductWithCode(){
       return  "SELECT * FROM product_table WHERE code='" . $_GET["code"] . "'";
    }
}