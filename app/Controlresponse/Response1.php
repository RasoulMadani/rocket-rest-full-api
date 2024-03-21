<?php 

namespace App\Controlresponse;

use Illuminate\Support\Arr;

class Response1{

    private ?string $message = null;  

    private mixed $data = null;

    private int $status = 200;

    private array $appends = [];

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

    public function setAppends(array $appends) :void{
        $this->appends = $appends;
    }

    public function response2()
    {
        $body = [];
        !is_null($this->message) && $body['message'] = $this->message;
        !is_null($this->data) && $body['data'] = $this->data;
        $body = $body + $this->appends;
        return response()->json($body,$this->status);
    }
}