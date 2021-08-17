<?php

namespace BeeDelivery\LaraiFood;

use BeeDelivery\LaraiFood\Functions\Auth;
use BeeDelivery\LaraiFood\Functions\Merchant;
use BeeDelivery\LaraiFood\Functions\Order;

class LaraiFood
{

    public function auth() {
        return new Auth();
    }

    public function merchant($accessToken)
    {
        return new Merchant($accessToken);
    }

    public function orders($accessToken)
    {
        return new Order($accessToken);
    }
}
