<?php

namespace App\Http\Controllers;

use App\Models\invoces;
use App\Models\InvocesAttachments;
use App\Models\InvocesDitalis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InvocesDitalisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
            $this->middleware(['auth','permission:Invoces']);
    }
    public function index()
    {

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
     * @param  \App\Models\InvocesDitalis  $invocesDitalis
     * @return \Illuminate\Http\Response
     */
    public function show(InvocesDitalis $invocesDitalis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvocesDitalis  $invocesDitalis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoces = invoces::find($id);
        $invoces_ditalis = DB::table('invoces_ditalis')->where('invoces_id','=',$id)->get();
        $invoces_attachments = DB::table('invoces_attachments')->where('invoces_id','=',$id)->get();
        return view('invoces.invoces_ditalis',compact('invoces','invoces_ditalis','invoces_attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvocesDitalis  $invocesDitalis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvocesDitalis $invocesDitalis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvocesDitalis  $invocesDitalis
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvocesDitalis $invocesDitalis)
    {

    }

    public function dawnfile($invoces_number,$filename)
    {
        return response()->download(public_path('Attachments/'.$invoces_number."/".$filename));
    }
    public function viewfile($invoces_number,$filename)
    {
        return response()->file(public_path('Attachments/'.$invoces_number."/".$filename));
    }
    public function deletefile($invoces_number,$filename,$id)
    {
        InvocesAttachments::find($id)->delete();
        File::delete(public_path('Attachments/'.$invoces_number."/".$filename));
        session()->flash('yes','File is deleted');
        return back();
    }
    public function invoces_print($id)
    {
        $invoces = invoces::find($id);
        return view('invoces.invoces_print',compact('invoces'));
    }


}
