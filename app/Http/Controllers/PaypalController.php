<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    public function createPayment(Request $request)
    {
        $orderId = $request->get('orderId');
        $order = Order::find($orderId);
        if($order == null ){
            return 1;
        }
        // Xử lý tạo payment của paypal sau khi có orders
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AfPOmD4sA0AMx73t_1bqi5Zqvh84TOK8HKQzxfh7u6TfFVOABPEghh8a0epynKRfzTz4C9ZhzQCDxLCN',
                'EGVcw6zQExO66g6M4ZxEkJMVg2-Ubny5XF0eWvqg5whO9ZnB2aW8yakzuIRDjVZW-mVpjk2ATzKVJB17'
            )
        );
        $apiContext->setConfig([
            'mode' => 'sandbox'
        ]);
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $itemArray = [];
        foreach ($order->orderDetails as $orderDetail) {
            $item = new Item();
            $item->setName($orderDetail->product->name)
                ->setCurrency('USD')
                ->setQuantity($orderDetail->quantity)
                ->setSku($orderDetail->productId)
                ->setPrice($orderDetail->unitPrice);
            array_push($itemArray, $item);
        }
        $itemList = new ItemList();
        $itemList->setItems($itemArray);

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($order->totalPrice);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($order->totalPrice)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Thanh toán thành công")
            ->setInvoiceNumber($order->id);
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://127.0.0.1:8000/paypal/success")
            ->setCancelUrl("http://127.0.0.1:8000/paypal/cancel");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            exit(1);
        }
        return $payment;
    }

    public function executePayment(Request $request)
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AfPOmD4sA0AMx73t_1bqi5Zqvh84TOK8HKQzxfh7u6TfFVOABPEghh8a0epynKRfzTz4C9ZhzQCDxLCN',
                'EGVcw6zQExO66g6M4ZxEkJMVg2-Ubny5XF0eWvqg5whO9ZnB2aW8yakzuIRDjVZW-mVpjk2ATzKVJB17'
            )
        );
        $apiContext->setConfig([
            'mode' => 'sandbox'
        ]);
        $paymentID = $request->get('paymentID');
        $payerID = $request->get('payerID');
        $payment = Payment::get($paymentID, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerID);
        try {
            $result = $payment->execute($execution, $apiContext);
            try {
                $payment = Payment::get($paymentID, $apiContext);
                if (count($payment->transactions) > 0) {
                    $orderId = $payment->transactions[0]->invoice_number;
                    $order = Order::find($orderId);
                    if ($order != null) {
                        $order->isCheckout = true;
                        $order->save();
                    }
                }
            } catch (Exception $ex) {
                exit(1);
            }
        }catch (Exception $ex) {
                exit(1);
            }
            return $payment;
    }
    //
}
