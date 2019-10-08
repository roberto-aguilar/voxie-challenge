<?php

namespace App\Http\Controllers;

class ContactImportController extends Controller
{
    /**
     * ContactImportController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contacts.imports.index');
    }
}
