<?php

namespace BeeDelivery\LaraiFood;

use BeeDelivery\LaraiFood\Functions\CustomerKey;
use BeeDelivery\LaraiFood\Functions\General;

class PicPay
{

    public function general() {
        return new General();
    }

    public function customerKey($customer_id) {
        return new CustomerKey($customer_id);
    }
}
