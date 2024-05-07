<?php

namespace Labyrinthe\Payment;

use Labyrinthe\Payment\Filter\Filter;

class paymentServiceProvider extends Kernel
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
    protected $result = [
        "success" => 0,
        "message" => "Process failed",
        "data" => [],
        "errors" => []
    ];

    protected function setResult($success, $message, $json = false, $data = [], $errors = []): void
    {
        $this->result["success"] = $success;
        $this->result["message"] = $message;
        $this->result["data"] = $data;
        $this->result["errors"] = $errors;

        if ($json) {
            $this->result = $this->parseToJSON($this->result);
        }
    }

    protected function parseToJSON(array $parse)
    {
        $parser = json_encode($parse);

        return json_decode($parser);
    }
}
