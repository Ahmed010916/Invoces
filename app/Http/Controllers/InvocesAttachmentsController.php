<?php

namespace App\Http\Controllers;

use App\Models\invoces;
use App\Models\InvocesAttachments;
use Illuminate\Http\Request;

class InvocesAttachmentsController extends Controller
{
    public function __construct()
    {
            $this->middleware(['auth','permission:Invoces']);
    }
    public function index()
    {
        //
    }
    public function AddfileAttachment(Request $request,$invoces_number,$id)
    {
        $filename = $request->file('file_Attach');
        $getClientOriginalName = $filename->getClientOriginalName();
        $getClientOriginalName = time()."_".$getClientOriginalName;
        $getClientOriginalExtension = $filename->getClientOriginalExtension();
        if ($filename->getClientOriginalExtension() == '') {
            $getClientOriginalName  = $filename->getClientOriginalName() .'.txt';
            $getClientOriginalExtension  = '.txt';
        }
        $file_path =   $filename->move(public_path('Attachments/'.$invoces_number),$getClientOriginalName);

        InvocesAttachments::create([
            'invoces_numper'=>$invoces_number,
            'invoces_id'=>$id,
            'file_name'=>$getClientOriginalName,
            'file_path'=>$file_path,
            'file_type'=>$getClientOriginalExtension,
        ]);

        session()->flash('yes','File id Added');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvocesAttachments  $invocesAttachments
     * @return \Illuminate\Http\Response
     */
    public function show(InvocesAttachments $invocesAttachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvocesAttachments  $invocesAttachments
     * @return \Illuminate\Http\Response
     */
    public function edit(InvocesAttachments $invocesAttachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvocesAttachments  $invocesAttachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvocesAttachments $invocesAttachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvocesAttachments  $invocesAttachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvocesAttachments $invocesAttachments)
    {
        //
    }
}
