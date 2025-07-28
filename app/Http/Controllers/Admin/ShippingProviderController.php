<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ShippingProviderController extends Controller {
    public function index() {
        return view('admin.shippings.index');
    }
}