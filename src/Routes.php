<?php

namespace Iugu;

use Iugu\Anonymous;

class Routes
{
    /**
     * @return \Iugu\Anonymous
     */
    public static function customers()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'customers';
        };

        $anonymous->details = static function ($id) {
            return "customers/$id";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function invoices()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'invoices';
        };

        $anonymous->details = static function ($id) {
            return "invoices/$id";
        };

        $anonymous->capture = static function ($id) {
            return "invoices/$id/capture";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function paymentToken()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'payment_token';
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function charges()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'charge';
        };

        return $anonymous;
    }
}
