<?php

namespace App\Http\Controllers;
use App\Event;
use App\Http\Requests;
use App\Timeline;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
/** All Paypal Details class **/
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
class AddMoneyController extends HomeController
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        /** setup PayPal api context **/
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal($group, $id)
    {
        if(!Auth::user()) {
            return redirect('login');
        }
        $event = Event::where('id', $id)->first();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Event FEES: event_id: '.$id) /** item name **/
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($event->price); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($event->price);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Event FEES (Paid via Fitmetix)');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('paypal/event/'.$id)) /** Specify return URL **/
        ->setCancelUrl(url('paypal/event/'.$id));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return redirect('paypal/event/'.$event->id);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return redirect('paypal/event/'.$event->id);
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        return redirect('paypal/event/'.$event->id);
    }
    public function getPaymentStatus($group, $id)
    {
        if(!Auth::user()) {
            return redirect('login');
        }
        $event = Event::where('id', $id)->first();
        if(is_null($event)) {
            Flash::error('Invalid Event URL');
            return redirect('/');
        }
        $timeLine = Timeline::where('timeline_id', $event->timeline_id)->first();
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return redirect('paypal/event/'.$id);
        }
        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {

            \Session::put('success','Payment success');
            $users = $event->users()->get();
            $event->users()->attach(Auth::user()->id);
            $pivoty = $event->users()->where('users.id', Auth::user()->id)->first();
            $pivoty->pivot->status = 1;
            $pivoty->pivot->save();
            foreach ($users as $user) {
                if ($user->id != Auth::user()->id) {
                    //Notify the user for event join
                    Notification::create(['user_id' => $user->id, 'timeline_id' => $event->timeline_id, 'notified_by' => Auth::user()->id, 'description' => Auth::user()->name.' '.trans('common.attending_your_event'), 'type' => 'join_event']);
                }
            }
            //return response()->json(['status' => '200', 'joined' => true, 'message' => 'successfully joined']);

            return redirect($timeLine->username);
        }
        \Session::put('error','Payment failed');
        return redirect('paypal/event/'.$event->id);
    }
}
