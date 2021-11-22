<?php

namespace BeeDelivery\LaraiFood;

use BeeDelivery\LaraiFood\Functions\Auth;
use BeeDelivery\LaraiFood\Functions\Merchant;
use BeeDelivery\LaraiFood\Functions\Order;

class LaraiFood
{
    public static function auth() {
        return new Auth();
    }

    public static function merchant($accessToken)
    {
        return new Merchant($accessToken);
    }

    public static function order($accessToken)
    {
        return new Order($accessToken);
    }
}
