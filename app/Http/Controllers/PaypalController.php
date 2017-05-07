<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Config;
use Session;
use Redirect;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use Kordy\Ticketit\Models\Ticket;

class PaypalController extends Controller {

private $_api_context;

public function __construct()
 {

    // setup PayPal api context
     $paypal_conf = Config::get('paypal');
     $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
     $this->_api_context->setConfig($paypal_conf['settings']);
 }

 public function postPayment()
 {

    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $price = session()->get('price');

    $item_1 = new Item();
    $item_1->setName('Item 1') // item name
     ->setCurrency('EUR')
     ->setQuantity(1)
     ->setPrice($price); // unit price

    // add item to list
    $item_list = new ItemList();
    $item_list->setItems(array($item_1));

    $amount = new Amount();
    $amount->setCurrency('EUR')
     ->setTotal($price);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
     ->setItemList($item_list)
     ->setDescription('description');

    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl(route('payment.status')) // Specify return URL
     ->setCancelUrl(route('payment.status'));

    $payment = new Payment();
    $payment->setIntent('Sale')
     ->setPayer($payer)
     ->setRedirectUrls($redirect_urls)
     ->setTransactions(array($transaction));

    try {
        $payment->create($this->_api_context);
    } catch (\PayPal\Exception\PPConnectionException $ex) {

        if (\Config::get('app.debug')) {
            echo "Exception: " . $ex->getMessage() . PHP_EOL;
            $err_data = json_decode($ex->getData(), true);
            exit;
        } else {
            die('Some error occur, sorry for inconvenient');
        }
    }

    foreach($payment->getLinks() as $link) {
        if($link->getRel() == 'approval_url') {
            $redirect_url = $link->getHref();
            break;
        }
    }

    // add payment ID to session
    Session::put('paypal_payment_id', $payment->getId());

    if(isset($redirect_url)) {
        // redirect to paypal
        return redirect($redirect_url);
    }

    return redirect()->route('homePage')
        ->with('error', 'Unknown error occurred');
 }

 public function getPaymentStatus(Request $request)
 {
    // Get the payment ID before session clear
    $payment_id = Session::get('paypal_payment_id');

   // clear the session payment ID
    Session::forget('paypal_payment_id');

   if(empty($request->input('PayerID')) || empty($request->input('token'))){
      return redirect()->route('homePage')->with('info', 'Payment failed');
   }

   $payment = Payment::get($payment_id, $this->_api_context);

   // PaymentExecution object includes information necessary
    // to execute a PayPal account payment.
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId($request->input('PayerID'));

   //Execute the payment
    $result = $payment->execute($execution, $this->_api_context);

    if ($result->getState() == 'approved') { // payment made

        if (session()->has('ticketid')){
            $ticket = Ticket::find(session()->get('ticketid'));
            $ticket->status_id += 1;
            $ticket->price = 80.00;
            $ticket->save();
            return redirect('consultas/'.session()->get('ticketid'))
                ->with('info', 'Payment success');
        }
        else {
            return Redirect::route('home')
                ->with('info', 'Payment failed');
        }

    }
    return Redirect::route('homePage')
        ->with('info', 'Payment failed');
 }

}
