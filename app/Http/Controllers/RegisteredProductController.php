<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\Product_categories;
use App\Models\Product_subcategories;
use Illuminate\Database\Migrations\Migration;

class RegisteredProductController extends Controller
{
    /**
     * 商品登録画面を表示する
     */
    public function productRegister(Request $request)
    {
        return view('user.register');
    }
}
