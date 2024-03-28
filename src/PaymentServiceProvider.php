<?php

namespace Labyrinthe\Payment;

use Labyrinthe\Payment\Filter\Filter;

class paymentServiceProvider
{

    use Filter;


    /**
     * From now on, this format will be used for package responses. 
     * This array will contain the following keys: success, errors, message and data 
     * 
     * sucess: of boolean type, which will return true if everything is OK and false if not
     * 
     * errors: of array type, will be empty if everything is fine and will return error details if something crashes
     * 
     * message: of type string, will return a message depending on the processing
     * 
     * data: of type array, will return data if there is data to return, otherwise it will be empty.
     * 
     * @var array
     * 
     */
    protected array $result = [
        "success" => 0,
        "errors" => [],
        "message" => "Process failed",
        "data" => []
    ];

    protected function setResult($success, $errors, $message, $data)
    {
        $this->result["success"] = $success;
        $this->result["errors"] = $errors;
        $this->result["message"] = $message;
        $this->result["data"] = $data;
    }
}
