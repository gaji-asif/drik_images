<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        $data = [];
        // view()->share('web.invoice.index',$data);
        $pdf = PDF::loadView('web.invoice.index ', $data)->save(public_path('pdf/test.pdf'));
        // $pdf->download('test_'.'122'. '_lab.pdf');
        return view('web.invoice.index');
    }
}
