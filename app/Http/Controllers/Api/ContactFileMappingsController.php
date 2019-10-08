<?php

namespace App\Http\Controllers\Api;

use App\ContactFile;
use App\Http\Controllers\Controller;
use App\Jobs\StoreContacts;
use Illuminate\Http\Request;

class ContactFileMappingsController extends Controller
{
    /**
     * ContactFileMappingsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactFile  $contactFile
     * @return \App\ContactFile
     */
    public function update(Request $request, ContactFile $contactFile)
    {
        $contactFile->update(
            $request->only('field_mappings')
        );

        $this->dispatch(new StoreContacts($contactFile));

        return $contactFile;
    }
}
