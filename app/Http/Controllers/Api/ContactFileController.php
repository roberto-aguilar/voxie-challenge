<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactFileRequest;

class ContactFileController extends Controller
{
    /**
     * ContactFileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactFileRequest  $request
     * @return \App\ContactFile
     */
    public function store(StoreContactFileRequest $request)
    {
        return $request->user()->files()->create([
            'name' => $request->file('file')->getClientOriginalName(),
            'path' => $request->file('file')->store('contacts', config('filesystems.cloud')),
        ]);
    }
}
