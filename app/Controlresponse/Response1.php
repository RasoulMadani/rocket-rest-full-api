<?php 

namespace App\Controlresponse;

class Response1{

    private ?string $message = null;  

    private mixed $data = null;

    private int $status = 200;

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    } 

    public function response2()
    {
        $body = [];
        !is_null($this->message) && $body['message'] = $this->message;
        !is_null($this->data) && $body['data'] = $this->data;

        return response()->json($body,$this->status);
    }
}