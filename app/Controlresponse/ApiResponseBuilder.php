<?php

namespace App\Controlresponse;

class ApiResponseBuilder
{
    private Response1 $response;

    public function __construct()
    {
        $this->response = new Response1;
    }

    public function withMessage(string $message)
    {
        $this->response->setMessage($message);
        return $this;
    }

    public function withData(mixed $data)
    {
        $this->response->setData($data);
        return $this;
    }

    public function withAppends(array $appends)
    {
        $this->response->setAppends($appends);
        return $this;
    }

    public function withStatus(int $status)
    {
        $this->response->setStatus($status);
        return $this;
    }

    public function build(): Response1
    {
        return $this->response;
    }
}
