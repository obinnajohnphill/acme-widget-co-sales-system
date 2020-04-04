<?php

/**
 * Special Offer Controller holds the special offer logic
 *
 */

class SpecialOfferController
{

/**
 * Instantiates special offer calculation function
 * @param $code
 *@param $quantity
 * @param $price
 *
 */
    function __construct($code,$quantity,$price) {
        $this->calculateSpecialOffer($code, $quantity, $price) ;
    }


/**
 * Calculates the price of the RO1 special offer
 *
 */
    public function calculateSpecialOffer($code, $quantity, $price) {
        if ($code == "RO1" and $quantity % 2 == 0 ) {
            $real = ($quantity / 2) * $price;
            $half = ($quantity / 2) * ($price / 2);
            $total = $real + $half;
            return $total;

        } else {
            $quantity = $quantity - 1;
            $real = ($quantity / 2) * $price;
            $half = ($quantity / 2) * ($price/2);
            $total = $real + $half + $price;
            return $total;
        }
    }

}