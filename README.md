# Labyrinthe - Payment : Documentation
  
## Plan
- <a href="#package-description" > Package description <a/>
- <a href="#install-the-labyrinthepayment-package" > Install the Labyrinthe/Payment package <a/>
  - <a href="#using-composer" > Using Composer <a/>
  - <a href="#using-github" > Using GitHub <a/>

- <a href="#how-to-use-labyrinthepayment" > How to use Labyrinthe\Payment <a/>
  - <a href="#global" > Global <a/>
  - <a href="#labyrinthe-api" > Labyrinthe API <a/>
    - <a href="#labyrinthe-mobile-service" > Labyrinthe mobile service <a/>
      - <a href="#labyrinthe-sandbox" > Labyrinthe sandbox <a/>
    - <a href="#labyrinthe-check-transaction" > Labyrinthe check transaction <a/>
  - <a href="#flexpay" > Flexpay <a/>
    - <a href="#flexpay-mobile-service" > Flexpay mobile service <a/>
      - <a href="#flexpay-mobile-payment" > Flexpay mobile payment <a/>
      - <a href="#flexpay-mobile-payment" > Flexpay mobile payment <a/>
      - <a href="#flexpay-check-mobile-results" > Flexpay check mobile results <a/>
    - <a href="#flexpay-card-service" > Flexpay card service <a/>
      - <a href="#flexpay-check-card-results" > Flexpay check card results <a/>
    - <a href="#flexpay-check-transaction" > Flexpay check transaction <a/>
  

# Package description

In programming, a package (or module, depending on the language) is a collection of various code elements, such as classes, functions, variables and constants. It's a crucial organizational tool that enables code to be structured in a modular and coherent way, making it easier to read, maintain and reuse.

The main aim of our package is to make available classes and functions that facilitate the integration of various payment aggregators such as Labyrinthe, Flexpay, Stripe,... Instead of coding the logic from scratch, you'll save time by using this package. In some cases, a single line of code will suffice to execute complex functions.

# Install the Labyrinthe/Payment package

Our package can be installed in a number of ways, including composer and github.

## Using Composer

If you haven't composed yet, it's time to install it. After all, it's the main installer of PHP dependencies.
<a href="https://getcomposer.org/download/"> Click here to install composer</a>.

After installation, go to the root of your project and issue this command :

    composer require labyrinthe/payment

## Using GitHub

With installation via github, there are two ways out. Either by git clone or by downloading the package zip file. 

1. Git clone

        git clone https://github.com/Dr-Lab1/Labyrinthe-Payment
   
3. Get the link and download

        https://github.com/Dr-Lab1/Labyrinthe-Payment

# How to use Labyrinthe\Payment ? 

## Global

Using only static methods to simplify its use, the package is easy to understand and practical to use. For example, to make a mobile payment from an X aggregator, the code to call the methods for this operation will be fairly straightforward.

Example:

      // array of params
      $array = [];
      $mobile_payment = AggregatorServiceProvider::mobile($array);

Responses from package methods and classes all have the same format. In other words, you don't have to go into the details of the response to understand its nature.

<table>
    <thead>
      <tr>
        <th colspan="4">Response</th>
      </tr>
    </thead>
    <tbody>   
      <tr>
        <th width="20%">Params</th>
        <th width="40%">Descritption</th>
        <th width="40%">Example</th>
      </tr>
      <tr>
        <td>success</td>
        <td>This is the status of the request. Returns 'true' if everything works and 'false' if it fails.</td>
        <td>true or false</td>
      </tr>
      <tr>
        <td>message</td>
        <td>This is the message that accompanies the response to give it greater meaning</td>
        <td>"Process failed"</td>
      </tr>
      <tr>
        <td>data</td>
        <td>This is an array containing the set of data returned by the query</td>
        <td>
            [code] => 0 <br>
            [message] => Transaction envoyée avec succès. <br>
            [orderNumber] => sjXMRrf98ISP243896699032 <br>
        </td>
      </tr>
      <tr>
        <td>errors</td>
        <td>A table listing all the errors encountered in the request</td>
        <td>[errors] => Could not resolve host: beta-backend</td>
      </tr>
    </tbody>
</table>

The default response format is JSON. Why is this? Because it's easy to access. To access the JSON key 'success', for example, all you need to do is :

    $mobile_payment->success
    // we can print it
    echo $mobile_payment->success;

Some people are more comfortable with arrays than JSON in PHP, so they'll pass an array <code>$options</code> as a parameter to render the results as an array.

    $options = [
      "JSON" => false
    ];

Now you can pass your parameters to the desired method to retrieve your data in the format in which you feel most comfortable.

    $mobile_payment = AggregatorServiceProvider::mobile($array, $options);


## Labyrinthe API

Labyrinthe-API is a service like many others covered by Labyrinthe-RDC (a digital-based company).

The APIs collection offered by Labyrinthe is scalable and comprehensive. It supports a wide range of payment methods available only from us.
From mobile payment methods to banking and soon cryptocurrencies, integrate payment solutions with ease.

### Labyrinthe mobile service

In the mobile section, we'll be looking at all the services related to mobile payment. In other words, making a payment and checking the results of different payments. We also offer a sandbox for different payment tests before going premium. Easy to integrate.

#### Labyrinthe sandbox

As mentioned in the introduction, this section deals with transactions. Perhaps the most difficult part of this section will be understanding the various parameters to be passed in the method (function). But relax, it's all explained in this section, and we'll start with. 

<table>
    <thead>
      <tr>
        <th colspan="4">SandBox</th>
      </tr>
    </thead>
    <tbody>   
      <tr>
        <th width="20%">Params</th>
        <th width="40%">Descritption</th>
        <th width="20%">Example</th>
        <th width="20%">Required</th>
      </tr>
      <tr>
        <td>token</td>
        <td>This is the token given by Labyrinthe</td>
        <td>xxxx xxxxx</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>reference</td>
        <td>This is the transaction reference. In other words, the data that will enable the transaction to be traced on your side. </td>
        <td>xxxxxxxxxx</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>phone</td>
        <td>The telephone number involved in the transaction</td>
        <td>0896699032</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>gateway</td>
        <td>This is the URL that labyrinthe gave you to carry out these mobile transactions</td>
        <td>https://payment.labyrinthe-rdc.com/ </td>
        <td>YES</td>
      </tr>
    </tbody>
</table>
 
Here is a code snippet showing how to fill its parameters :

    $array = [
      "token" => "$2y$12$ngaXsXGwkrxpTAA.ubLXietv/Pdadfbx3OziwIH88inGU4sGi6ivm",
      "reference" => "First_TX",
      "phone" => "0896699032",
      "gateway" => "https://payment.labyrinthe-rdc.com/",
    ];
    
After filling in the table with the correct information provided by Flexpay, please copy the following code portion: 

    $labyrinthe = LabyrintheServiceProvider::sandbox($array);

Now run your code from your controller and process the information as required. All the information is returned in the variable <code>$labyrinthe</code>.


### Labyrinthe check transaction

Transaction verification is an action aimed at checking the status of a transaction and/or extracting certain details from it. This exercise concerns both mobile and card transactions in the system.

There are a few parameters to enter:

<table>
    <thead>
      <tr>
        <th colspan="4">mobile & card</th>
      </tr>
    </thead>
    <tbody>   
      <tr>
        <th width="20%">Params</th>
        <th width="40%">Descritption</th>
        <th width="20%">Example</th>
        <th width="20%">Required</th>
      </tr>
      <tr>
        <td>token</td>
        <td>This is the token given by Labyrinthe</td>
        <td>xxxxxxxxxxxxxx</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>orderNumber</td>
        <td>This is the transaction orderNumber In other words, the data that will enable the transaction to be traced on your side. </td>
        <td>xxxxxxxxxx</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>gateway</td>
        <td>This is the URL that flexpay gave you to carry out these transactions</td>
        <td>https://xyz.com</td>
        <td>YES</td>
      </tr>
    </tbody>
</table>


Here is a code snippet showing how to fill its parameters :

    $array = [
      "token" => "xxxxxxxxxxxxxxxxxxxxxxxxxxx",
      "gateway" => "https://xyz.cd/check/",
      "orderNumber" => "azertyytreza",
    ];
    
After filling in the table with the correct information provided by Flexpay, please copy the following code portion: 

    $labyrinthe = LabyrintheServiceProvider::checkTransaction($array);

Now run your code from your controller and process the information as required. All the information is returned in the variable <code>$labyrinthe</code>.


## Flexpay

FlexPaie is the electronic payments application that supports all electronic payment methods, with all operators and bank cards. It's the ideal solution for all merchants and customers. You no longer need to have an electronic account for each network - a single application operational with : Visa, Mastercard, Afrimoney, Orange Money, Airtel Money, M-Pesa etc.

### Flexpay mobile service

In the mobile section, we'll be looking at all the services related to mobile payment. In other words, making a payment and checking the results of different payments. 

#### Flexpay mobile payment

As mentioned in the introduction, this section deals with transactions. Perhaps the most difficult part of this section will be understanding the various parameters to be passed in the method (function). But relax, it's all explained in this section, and we'll start with.

<table>
    <thead>
      <tr>
        <th colspan="4">mobile</th>
      </tr>
    </thead>
    <tbody>   
      <tr>
        <th width="20%">Params</th>
        <th width="40%">Descritption</th>
        <th width="20%">Example</th>
        <th width="20%">Required</th>
      </tr>
      <tr>
        <td>authorization</td>
        <td>This is the Bearer token sent by Flexpay</td>
        <td>Bearer xxxxx</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>merchant</td>
        <td>The merchant code is the one provided by flexpay</td>
        <td>"Orange"</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>type</td>
        <td>This is the type of transaction you want to carry out. In our case it's mobile. So the type will be "1".</td>
        <td>1</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>type</td>
        <td>This is the type of transaction you want to carry out. In our case it's mobile. So the type will be "1".</td>
        <td>1</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>reference</td>
        <td>This is the transaction reference. In other words, the data that will enable the transaction to be traced on your side. </td>
        <td>xxxxxxxxxx</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>phone</td>
        <td>The telephone number involved in the transaction</td>
        <td>243896699032</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>amount</td>
        <td>The amount of the transaction </td>
        <td>100</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>currency</td>
        <td>This is the currency to be used in the transaction</td>
        <td>USD</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>callbackUrl</td>
        <td>This is the route by which the response (the final information about the transaction) will be returned.</td>
        <td>abcdef.com</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>gateway</td>
        <td>This is the URL that flexpay gave you to carry out these mobile transactions</td>
        <td>flexpay.cd</td>
        <td>YES</td>
      </tr>
    </tbody>
</table>

Here is a code snippet showing how to fill its parameters :

    $array = [
      "authorization" => "Orange",
      "merchant" => "orange",
      "type" => 1,
      // Continue with other params...
    ];
    
After filling in the table with the correct information provided by Flexpay, please copy the following code portion: 

    $flexpay = FlexpayServiceProvider::mobile($array);

Now run your code from your controller and process the information as required. All the information is returned in the variable <code>$flexpay</code>.

#### Flexpay check mobile results

In each transaction, you've sent a callbackUrl, which is the url to which the result of the transaction will be sent by the aggregator. 
But this sending of data needs to be checked to ensure that the right information is being processed (stored in the database, for example). 

In your action whose endpoint is your callbackUrl, you will call this static function :

    $flexpay = FlexpayServiceProvider::phoneResults($array);

This function will automatically check the result and return the transaction code status. If all is well, it will return <code>true</code> to the <code>success</code> variable and <code>false</code> otherwise.
The processing of information coming from the aggregator will depend on the result of the function. You can either save to the database, or perform calculations,...

### Flexpay card

In this section, we focus on banking transactions. It will cover much more about checking and checking results.

#### Flexpay check card results

In each transaction, you've sent a callbackUrl, which is the url to which the result of the transaction will be sent by the aggregator. 
But this sending of data needs to be checked to ensure that the right information is being processed (stored in the database, for example). 

In your action whose endpoint is your callbackUrl, you will call this static function :

    $flexpay = FlexpayServiceProvider::cardResults($array);

This function will automatically check the result and return the transaction code status. If all is well, it will return <code>true</code> to the <code>success</code> variable and <code>false</code> otherwise.
The processing of information coming from the aggregator will depend on the result of the function. You can either save to the database, or perform calculations,...

### Flexpay check transaction

Transaction verification is an action aimed at checking the status of a transaction and/or extracting certain details from it. This exercise concerns both mobile and card transactions in the system.

There are a few parameters to enter:

<table>
    <thead>
      <tr>
        <th colspan="4">mobile & card</th>
      </tr>
    </thead>
    <tbody>   
      <tr>
        <th width="20%">Params</th>
        <th width="40%">Descritption</th>
        <th width="20%">Example</th>
        <th width="20%">Required</th>
      </tr>
      <tr>
        <td>authorization</td>
        <td>This is the Bearer token sent by Flexpay</td>
        <td>Bearer xxxxx</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>orderNumber</td>
        <td>This is the transaction orderNumber In other words, the data that will enable the transaction to be traced on your side. </td>
        <td>xxxxxxxxxx</td>
        <td>YES</td>
      </tr>
      <tr>
        <td>gateway</td>
        <td>This is the URL that flexpay gave you to carry out these transactions</td>
        <td>flexpay.cd</td>
        <td>YES</td>
      </tr>
    </tbody>
</table>


Here is a code snippet showing how to fill its parameters :

    $array = [
      "authorization" => "Orange",
      "gateway" => "https://xyz.cd/check/",
      "orderNumber" => "azertyytreza",
    ];
    
After filling in the table with the correct information provided by Flexpay, please copy the following code portion: 

    $flexpay = FlexpayServiceProvider::checkTransaction($array);

Now run your code from your controller and process the information as required. All the information is returned in the variable <code>$flexpay</code>.






