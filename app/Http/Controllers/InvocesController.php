<?php

namespace App\Http\Controllers;

use App\Exports\InvocesExport;
use App\Models\invoces;
use App\Models\InvocesAttachments;
use App\Models\InvocesDitalis;
use App\Models\Product;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvocesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'permission:Invoces']);
    }


    public function index()
    {
        $invoces = invoces::orderBy('id', 'DESC')->paginate('10');
        return view('invoces.invoces', compact('invoces'));
    }
    public function invoces_Paid()
    {
        $invoces = invoces::where('values_status', '=', 1)->orderBy('id', 'DESC')->paginate('10');
        return view('invoces.invoces_Paid', compact('invoces'));
    }
    public function invoces_part_Paid()
    {
        $invoces = invoces::where('values_status', '=', 3)->orderBy('id', 'DESC')->paginate('10');
        return view('invoces.invoces_Part-Paid', compact('invoces'));
    }
    public function invoces_un_Paid()
    {
        $invoces = invoces::where('values_status', '=', 2)->orderBy('id', 'DESC')->paginate('10');
        return view('invoces.invoces_Un-Paid', compact('invoces'));
    }
    public function trachedinvoces()
    {
        $invoces = invoces::onlyTrashed()->orderBy('id', 'DESC')->paginate('10');
        return view('invoces.trached_invoces', compact('invoces'));
    }
    public function Untrachedinvoces($id)
    {
        $invoc = invoces::onlyTrashed()->findOrFail($id);
        $invoc->update([
            'deleted_at' => null
        ]);
        return redirect()->route('invoces.index');
    }

    public function statusEdite($id)
    {
        $invoces = invoces::find($id);
        return view('invoces.status_Edite_invoces', compact('invoces'));
    }
    public function statusUpdate(InvocesDitalis $InvocesDitalis, Request $request, $id)
    {
        $invoces = invoces::find($id);

        $statusif = '';
        if ($request->status == 1) {
            $statusif = 'paid';
        } elseif ($request->status == 2) {
            $statusif = 'unpaid';
        } elseif ($request->status == 3) {
            $statusif = 'partpaid';
        }
        $invoces->update([
            'status' => $statusif,
            'values_status' => $request->status,
        ]);
        $InvocesDitalis->create([
            'invoces_numper' => $invoces['invoces_number'],
            'invoces_id' => $id,
            'Paymentdata' => $request->dataPayment,
            'state' => $statusif,
            'value_state' => $request->status,
            'Created_by' => (Auth::user()->name),
        ]);
        session()->flash('yes', 'Invoces State is Updated');
        return redirect()->route('invoces.index');
    }


    public function create()
    {
        if (Auth::user()->hasPermission('Invoces_create') != 1) {
            abort(404);
        }
        $sections = section::all();
        return view('invoces.add_invoces', compact('sections'));
    }


    public function store(Request $request)
    {

        $invocesID =  DB::table('invoces')->insertGetId([
            'invoces_number' => $request->invoces_number,
            'invoces_data' => $request->invoces_data,
            'due_data' => $request->due_data,
            'product_id' => $request->product,
            'section_id' => $request->section,
            'price_collection' => $request->price_collection,
            'Price_Commission' => $request->Price_Commission,
            'discount' => $request->discount,
            'rote_vat' => $request->rote_vat,
            'value_vat' => $request->value_vat,
            'total' => $request->total,
            'status' => 'unpaid',
            'values_status' => '2',
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        InvocesDitalis::create([
            'invoces_numper' => $request->invoces_number,
            'invoces_id' => $invocesID,
            'state' => 'unpaid',
            'value_state' => '2',
            'Created_by' => (Auth::user()->name),
        ]);

        if ($request->hasFile('inv') == true) {
            $file =  $request->file('inv');
            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $filePath = $file->move(public_path('/Attachments/' . $request->invoces_number), $fileName);
            InvocesAttachments::create([
                'invoces_numper' => $request->invoces_number,
                'invoces_id' => $invocesID,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_type' => $fileType,
            ]);
        }
        session()->flash('yes', "Invoces Is Added ");
        return redirect()->route('invoces.index');
    }


    public function show(invoces $invoces)
    {
    }


    public function edit(invoces $invoces, $id)
    {
        if (Auth::user()->hasPermission('edite_invoces') != 1) {
            abort(404);
        }

        $invoces = invoces::find($id);
        $sections = section::get();
        return view('invoces.Edite_invoces', compact('invoces', 'sections'));
    }


    public function update(Request $request, invoces $invoces, $id)
    {
        $invoces = invoces::find($id);
        $InvocesAttachments = InvocesAttachments::where('invoces_id', '=', $id)->get();
        $InvocesDitalis = InvocesDitalis::where('invoces_id', '=', $id)->get();

        if ($request->has('invoces_number')) {
            session()->flash('yes', 'Invoces No Can update');
            return redirect()->route('invoces.index');
        }

        $invoces->update([
            //            'invoces_number' => $request->invoces_number,
            'invoces_data' => $request->invoces_data,
            'due_data' => $request->due_data,
            'section_id' => $request->section,
            'product_id' => $request->product,
            'price_collection' => $request->price_collection,
            'Price_Commission' => $request->Price_Commission,
            'discount' => $request->discount,
            'rote_vat' => $request->rote_vat,
            'value_vat' => $request->value_vat,
            'total' => $request->total,
            'note' => $request->note,
        ]);
        //        foreach ($InvocesAttachments as $InvocesAttachment){
        //            $InvocesAttachment->update([
        //                'invoces_numper' => $request->invoces_number,
        //            ]);
        //        }
        //        foreach ($InvocesDitalis as $InvocesDitali){
        //            $InvocesDitali->update([
        //                'invoces_numper' => $request->invoces_number,
        //            ]);
        //        }

        session()->flash('yes', 'Invoces id updated');
        return redirect()->route('invoces.index');
    }


    public function destroy(invoces $invoces, $id)
    {

        if (Auth::user()->hasPermission('delete_invoces') != 1) {
            abort(404);
        }

        $invoces = invoces::where('id', '=', $id)->first();
        $file =  File::deleteDirectory(public_path('Attachments/' . $invoces->invoces_number));
        if ($file) {
            $invoces->forceDelete();
            return redirect()->route('invoces.index');
        }
        session()->flash('yes', 'invoces is destroyed');
        return redirect()->route('invoces.index');
    }
    public function SoftDelete($id)
    {
        $invoces = invoces::where('id', '=', $id)->first();
        $invoces->delete();
        session()->flash('yes', 'invoces is destroyed');
        return redirect()->route('invoces.index');
    }

    public function sections_get($id)
    {
        $gets =  DB::table('products')->where('section_id', '=', $id)->get();
        return $gets;
    }

    public function invocesExport()
    {

        $invoces = invoces::select([
            'id',
            'invoces_number',
            'product_id',
            'section_id',
            'invoces_data',
            'due_data',
            'price_collection',
            'Price_Commission',
            'discount',
            'rote_vat',
            'value_vat',
            'total',
            'status',
            'user',
        ])->get();

        return Excel::download(new invocesExport($invoces), 'AllInvoces.xlsx');
    }

    public function invocesPaidExport()
    {

        $invoces = invoces::select([
            'id',
            'invoces_number',
            'product_id',
            'section_id',
            'invoces_data',
            'due_data',
            'price_collection',
            'Price_Commission',
            'discount',
            'rote_vat',
            'value_vat',
            'total',
            'status',
            'user',
        ])->where('values_status','=',1)->get();
        return Excel::download(new invocesExport($invoces), 'InvocesPaid.xlsx');
    }
    public function invocesUnPaidExport()
    {

        $invoces = invoces::select([
            'id',
            'invoces_number',
            'product_id',
            'section_id',
            'invoces_data',
            'due_data',
            'price_collection',
            'Price_Commission',
            'discount',
            'rote_vat',
            'value_vat',
            'total',
            'status',
            'user',
        ])->where('values_status','=',2)->get();


        return Excel::download(new invocesExport($invoces), 'InvocesUnPaid.xlsx');
    }
    public function invocesPartExport()
    {

        $invoces = invoces::select([
            'id',
            'invoces_number',
            'product_id',
            'section_id',
            'invoces_data',
            'due_data',
            'price_collection',
            'Price_Commission',
            'discount',
            'rote_vat',
            'value_vat',
            'total',
            'status',
            'user',
        ])->where('values_status','=',3)->get();

        foreach ($invoces as $invoce) {
            $pro = Product::find($invoce->product_id);
            $sec = section::find($invoce->section_id);

            $invoce->product_id = $pro->product_name;
            $invoce->section_id = $sec->section_name;
        }

        return Excel::download(new invocesExport($invoces), 'InvocesPart.xlsx');
    }
}
