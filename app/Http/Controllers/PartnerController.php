<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(){
        return "Partner routes";
    }

    public function register() {
        return "new Partner";
    }

    public function login() {
        return "login";
    }
}
