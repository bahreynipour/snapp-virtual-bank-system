<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function topCardToCardUsers(Request $request)
    {


        return User::withSum('accounts')->get();
    }

}
