<?php
// app/Http/Controllers/Controller.php — Fix: AuthorizesRequests requis pour Laravel 11

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests;
}
