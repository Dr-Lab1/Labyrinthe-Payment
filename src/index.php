<?php
namespace Labyrinthe\Payment;

require_once('./PaymentServiceProvider.php');
use Labyrinthe\Payment\paymentServiceProvider;

$service = new paymentServiceProvider();


return $service->phoneNumberFilter('0896699032', 'COD');
