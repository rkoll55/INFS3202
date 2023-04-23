<?php
namespace App\Controllers;

use Config\Stripe;

class Donate extends BaseController
{
    protected $stripeConfig;

    public function __construct()
    {
        $this->stripeConfig = new Stripe();
    }
    public function index() {

        echo view('template/header');
        echo view('donate');
        echo view('template/footer');
    }

    public function check_donation() {
        $stripeKey = $this->stripeConfig->secret;
        require_once APPPATH . 'Libraries/stripe-php/init.php';

        \Stripe\Stripe::setApiKey($stripeKey);

        $email = $this->request->getPost('email');
        $cardNumber = $this->request->getPost('number');
        $cardholderName = $this->request->getPost('name');
        $expiryDate = $this->request->getPost('expiry');
        $cvv = $this->request->getPost('cvv');
        $amount = $this->request->getPost('amount');

        try {
            $paymentMethod = \Stripe\PaymentMethod::create([
                'type' => 'card',
                'card' => [
                'number' => $cardNumber,
                'exp_month' => substr($expiryDate, 0, 2),
                'exp_year' => substr($expiryDate, 3, 4),
                'cvc' => $cvv
                ],

                'billing_details' => [
                    'name' => $cardholderName,
                    'email' => $email
                ]     
            ]);

            $paymentProcess = \Stripe\PaymentIntent::create([
                'payment_method' => $paymentMethod->id,
                'amount' => $amount*100,
                'currency' => 'aud',
                'description' => 'Donation',
                'confirm' => true
            ]);

            $data['status'] =  $paymentProcess->status;
            echo view('template/header');
            echo view('success', $data);
            echo view('template/footer');

        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
