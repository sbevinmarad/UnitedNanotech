<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enquery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnqueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.enquery.enquery-list');
    }

    public function show($id)
    {
    	$data['enquery'] = Enquery::find($id);
        return view('admin.enquery.enquery-view', $data);
    }
    

}
