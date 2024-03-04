<?php
class ErrorController
{
    public function index($statusCode, $data = [], $errorMessages = [])
    {
        $response = new APIJsonResponse();
        $response->setStatusCode($statusCode);

        // Add error messages if any
        if (!empty($errorMessages)) {
            foreach ($errorMessages as $errorMessage) {
                $error = new Errors();
                $error->setMessage($errorMessage);
                $response->addError($error);
            }
        }

        // Return JSON response
        $errorResponse = array();
        $errorResponse["statusCode"] = $response->getStatusCode();

        // Include error messages if there are any
        if (!empty($errorMessages)) {
            $errorResponse["message"] = $response->getErrors();
        }

        // Include data if provided and status code is 200
        if ($statusCode === 200 && !empty($data)) {
            $errorResponse["data"] = $data;
        }

        return json_encode($errorResponse);
    }
}

class APIJsonResponse
{
    private $statusCode;
    private $errors = array();

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getErrors()
    {
        $errorMessages = array(); // Initialize an array to store error messages
        foreach ($this->errors as $error) {
            $errorMessages[] = $error->getMessage(); // Get the message from each Errors object
        }
        return $errorMessages;
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }
}

class Errors
{
    private $message;

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}