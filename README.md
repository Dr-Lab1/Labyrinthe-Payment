# Labyrinthe - Payment : Documentation

# Plan
- <a href="#description-du-package" > Description du package <a/>
- <a href="#installer-composer" > Installer Composer <a/>

# Description du package

# Installer composer

If you already have a stable version of Composer, you can skip this step.

**Introduction**

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

**Dependency management**

Composer is not a package manager in the same sense as Yum or Apt are. Yes, it deals with "packages" or libraries, but it manages them on a per-project basis, installing them in a directory (e.g. vendor) inside your project. By default, it does not install anything globally. Thus, it is a dependency manager. It does however support a "global" project for convenience via the global command.

This idea is not new and Composer is strongly inspired by node's <a href="https://www.npmjs.com/" target="_blank">npm<a/> and ruby's <a href="https://bundler.io/" target="_blank">bundler<a/> de ruby.

<a href="https://getcomposer.org/doc/00-intro.md">Official Composer documentation<a/>
 
<a href="https://getcomposer.org/download/">Composer download link<a/> 

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
