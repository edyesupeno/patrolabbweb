<?php

namespace App\Http\Controllers;

use App\Models\ApiDocs;
use Illuminate\Http\Request;

class ApiDocsController extends Controller
{
    
    public function index()
    {
        $data['api'] = ApiDocs::all();
        return view('api-documentation',$data);
    }

    
}
