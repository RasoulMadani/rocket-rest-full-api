<?php 

namespace App\Controlresponse\Facades;

use Illuminate\Support\Facades\Facade;

class ApiResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'apiResponse';
    }
}