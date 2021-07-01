<?php

namespace App\Services\Iugu;

use App\Services\Iugu\Anonymous;

class Routes
{
    /**
     * @return \Iugu\Anonymous
     */
    public static function transactions()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'transactions';
        };

        $anonymous->details = static function ($id) {
            return "transactions/$id";
        };

        $anonymous->capture = static function ($id) {
            return "transactions/$id/capture";
        };

        $anonymous->refund = static function ($id) {
            return "transactions/$id/refund";
        };

        $anonymous->payables = static function ($id) {
            return "transactions/$id/payables";
        };

        $anonymous->payablesDetails = static function ($transactionId, $payableId) {
            return "transactions/$transactionId/payables/$payableId";
        };

        $anonymous->operations = static function ($id) {
            return "transactions/$id/operations";
        };

        $anonymous->collectPayment = static function ($id) {
            return "transactions/$id/collect_payment";
        };

        $anonymous->events = static function ($id) {
            return "transactions/$id/events";
        };

        $anonymous->calculateInstallments = static function () {
            return "transactions/calculate_installments_amount";
        };

        return $anonymous;
    }

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
    public static function cards()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'cards';
        };

        $anonymous->details = static function ($id) {
            return "cards/$id";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function recipients()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'recipients';
        };

        $anonymous->details = static function ($id) {
            return "recipients/$id";
        };

        $anonymous->balance = static function ($id) {
            return "recipients/$id/balance";
        };

        $anonymous->balanceOperations = static function ($id) {
            return "recipients/$id/balance/operations";
        };

        $anonymous->balanceOperation = static function ($recipientId, $balanceOperationId) {
            return "recipients/$recipientId/balance/operations/$balanceOperationId";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function bankAccounts()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'bank_accounts';
        };

        $anonymous->details = static function ($id) {
            return "bank_accounts/$id";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function plans()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'plans';
        };

        $anonymous->details = static function ($id) {
            return "plans/$id";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function bulkAnticipations()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function ($recipientId) {
            return "recipients/$recipientId/bulk_anticipations";
        };

        $anonymous->limits = static function ($recipientId) {
            return "recipients/$recipientId/bulk_anticipations/limits";
        };

        $anonymous->confirm = static function ($recipientId, $bulkAnticipationId) {
            return "recipients/$recipientId/bulk_anticipations/$bulkAnticipationId/confirm";
        };

        $anonymous->cancel = static function ($recipientId, $bulkAnticipationId) {
            return "recipients/$recipientId/bulk_anticipations/$bulkAnticipationId/cancel";
        };

        $anonymous->delete = static function ($recipientId, $bulkAnticipationId) {
            return "recipients/$recipientId/bulk_anticipations/$bulkAnticipationId";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function paymentLinks()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'payment_links';
        };

        $anonymous->details = static function ($paymentLinkId) {
            return "payment_links/$paymentLinkId";
        };

        $anonymous->cancel = static function ($paymentLinkId) {
            return "payment_links/$paymentLinkId/cancel";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function transfers()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'transfers';
        };

        $anonymous->details = static function ($transferId) {
            return "transfers/$transferId";
        };

        $anonymous->cancel = static function ($transferId) {
            return "transfers/$transferId/cancel";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function subscriptions()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'subscriptions';
        };

        $anonymous->details = static function ($subscriptionId) {
            return "subscriptions/$subscriptionId";
        };

        $anonymous->cancel = static function ($subscriptionId) {
            return "subscriptions/$subscriptionId/cancel";
        };

        $anonymous->transactions = static function ($subscriptionId) {
            return "subscriptions/$subscriptionId/transactions";
        };

        $anonymous->settleCharges = static function ($subscriptionId) {
            return "subscriptions/$subscriptionId/settle_charge";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function refunds()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'refunds';
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function postbacks()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function ($model, $modelId) {
            return "$model/$modelId/postbacks";
        };

        $anonymous->details = static function (
            $model,
            $modelId,
            $postbackId
        ) {
            return "$model/$modelId/postbacks/$postbackId";
        };

        $anonymous->redeliver = static function (
            $model,
            $modelId,
            $postbackId
        ) {
            return "$model/$modelId/postbacks/$postbackId/redeliver";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function balances()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'balance';
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function payables()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'payables';
        };

        $anonymous->details = static function ($id) {
            return "payables/$id";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function balanceOperations()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'balance/operations';
        };

        $anonymous->details = static function ($id) {
            return "balance/operations/$id";
        };

        return $anonymous;
    }

    /**
     * @return \Iugu\Anonymous
     */
    public static function chargebacks()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return 'chargebacks';
        };

        return $anonymous;
    }


    /**
     * @return \Iugu\Anonymous
     */
    public static function search()
    {
        $anonymous = new Anonymous();

        $anonymous->base = static function () {
            return "search";
        };

        return $anonymous;
    }
}
