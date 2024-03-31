# Labyrinthe - Payment : Documentation

# Plan
- <a href="#package-description" > Package description <a/>
- <a href="#install-the-labyrinthepayment-package" > Install the Labyrinthe/Payment package <a/>
  - <a href="#using-composer" > Using Composer <a/>
  - <a href="#using-github" > Using GitHub <a/>

# Package description

# Install the Labyrinthe/Payment package

## Using Composer
### Using GitHub
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
        <th width="20%">Example</th>
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
            [code] => 0
            [message] => Transaction envoyée avec succès.
            [orderNumber] => sjXMRrf98ISP243896699032
        </td>
      </tr>
      <tr>
        <td>errors</td>
        <td>A table listing all the errors encountered in the request</td>
        <td>[errors] => Could not resolve host: beta-backend</td>
      </tr>
    </tbody>
</table>
