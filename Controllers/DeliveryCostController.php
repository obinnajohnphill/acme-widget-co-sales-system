<?php

/**
 * Delivery Cost Controller holds the delivery cost logic
 * @var $cost
 */

class DeliveryCostController
{
    protected $cost;

/**
 * Instantiates calculate delivery cost function
 * @param $total_price
 *
 */
    function __construct($total_price) {
        $this->calculateDeliveryCost($total_price);
    }

/**
 * Calculate delivery cost function
 *
 */
    public function calculateDeliveryCost($total_price){
        if ($total_price < 50){
            $this->cost = 4.95;
        }elseif($total_price < 90){
            $this->cost = 2.95;
        }else{
            $this->cost = 0;
        }
        return $this->cost;
    }

}