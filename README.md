# Labyrinthe - Payment : Documentation


<div>
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
        <td>https://beta-backend.flexpay.cd/api/rest/v1/paymentService</td>
        <td>YES</td>
      </tr>
    </tbody>
</table>
</div>



* ----------------------------------------------------------------------------------------------------------------------------
     *      Params      |                   Descritption                        | Example          
     * ----------------------------------------------------------------------------------------------------------------------------
     *  success         | This is the status of the request. Returns 'true' if  | true  or 1
     *                  | everything works and 'false' if it fails.             | false or 0
     * ----------------------------------------------------------------------------------------------------------------------------
     *  message         | This is the message that accompanies the response to  | "Process failed"  
     *                  | give it greater meaning                               |  
     * ----------------------------------------------------------------------------------------------------------------------------
     *  data            | This is an array containing the set of data returned  | [code] => 0
     *                  | by the query                                          | [message] => Transaction envoyée avec succès.
     *                  |                                                       | [orderNumber] => sjXMRrf98ISP243896699032 
     * ----------------------------------------------------------------------------------------------------------------------------
 

<table>
    <thead>
      <tr>
        <th colspan="2">Fonction factorielle</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Paramètre</th>
        <th>Description</th>
      </tr>
      <tr>
        <td>$n</td>
        <td>Le nombre à factoriser (doit être positif)</td>
      </tr>
      <tr>
        <th>Retour</th>
        <td>La factorielle de n</td>
      </tr>
      <tr>
        <th>Exception</th>
        <td>InvalidArgumentException si n est négatif</td>
      </tr>
    </tbody>
</table>
