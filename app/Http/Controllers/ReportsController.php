<?php

namespace App\Http\Controllers;

use App\Exports\InvocesExport;
use App\Models\invoces;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','permission:Reports']);
    }

    public function indexInvoces(){
        session()->forget('yes');;
        return view('Reports.Invoces.index');
    }

    public function searchInvoces(Request $request){
        if ($request->invocesearch == "data") {

            $request->validate([
                'invocesearch' =>'required|string|',
                'typesearch'   =>'required|string|',
                'startdata'    =>'required|date|',
                'invocesnumber'=>'nullable|string',
                'enddata'      =>'nullable|date|',
            ]);
              $startdata = date($request->startdata);
              $enddata = date($request->enddata);

            if ($enddata == null) {
                if ($request->typesearch == 'all') {
                    $invoces = invoces::with(['section','product'])->hereDate('invoces_data','>=',$request->startdata)->get();



                    return view('Reports.Invoces.index',compact('invoces'));

                }
              $invoces = invoces::with(['section','product'])->whereDate('invoces_data','>=',$request->startdata)->where('values_status','=',$request->typesearch)->get();


              return view('Reports.Invoces.index',compact('invoces'));


            }else{
                if ($request->typesearch == 'all') {
                    $invoces = invoces::with(['section','product'])->whereBetween('invoces_data',[$startdata,$enddata])->get();

                    return view('Reports.Invoces.index',compact('invoces'));

                }
                $invoces =  invoces::with(['section','product'])->WhereBetween('invoces_data',[$startdata,$enddata])->where('values_status','=',$request->typesearch)->get();

                return view('Reports.Invoces.index',compact('invoces'));

            }

        } elseif($request->invocesearch == "number") {

            $request->validate([
                'invocesearch' =>'nullable|string|',
                'typesearch'   =>'nullable|numeric|',
                'startdata'    =>'nullable|date|',
                'invocesnumber'=>'required|string|',
                'enddata'      =>'nullable|date',
            ]);



            $Invoces_Num = $request->invocesnumber;


            $invoces = invoces::with(['section','product'])->where('invoces_number','rlike',$Invoces_Num)->get();

            return view('Reports.Invoces.index')->with('invoces',$invoces);


        }else{
            abort(404);
        }
    }



    public function indexUsers(){
        return view('Reports.Users.index');
    }

    public function searchUsers(Request $request){
        return $request;
    }

    public function invocesReportsExport($invoces)
    {
        return $invoces;
        // $invoces = invoces::select([
        //     'id',
        //     'invoces_number',
        //     'product_id',
        //     'section_id',
        //     'invoces_data',
        //     'due_data',
        //     'price_collection',
        //     'Price_Commission',
        //     'discount',
        //     'rote_vat',
        //     'value_vat',
        //     'total',
        //     'status',
        //     'user',
        // ])->get();
        // return Excel::download(new invocesExport($invoces), 'InvocesPaid.xlsx');
    }

}
