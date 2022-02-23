<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','permission:Product']);
    }

    public function index()
    {
        $createsections = DB::table('sections')->select('section_name','id')->latest()->get();
        $products = Product::with("section")->latest()->paginate(20);
        return view('products.product',compact('createsections','products'));
    }


    public function create()
    {

    }


    public function store(ProductRequest $request)
    {
        if (Auth::user()->hasPermission('Product_create') != 1) {
            abort(404);
        }
        $request->validated();
        $pr =  Product::where('product_name','=',$request->product_name)->first() ?? null;
        if($pr != null){
            if($pr->product_name == $request->product_name && $pr->section_id == $request->section_id){
                session()->flash('yes',"Product is Not Updataed it is oready token ☺☻☺");
                return redirect()->back();
            }
        }

        Product::create([
            "product_name" => $request->product_name,
            "section_id" => $request->section_id,
            "note" => $request->note,
            "created_by" => Auth::user()->name,
        ]);

        session()->flash('yes',"Product is Created %100 ☺☻☺");
        return redirect()->back();
    }

    public function updatamy(Request $request)
    {
        if (Auth::user()->hasPermission('Product_edite') != 1) {
            abort(404);
        }
        $request->validate([
            'product_name'=> 'required|string|min:1|max:50',
            'section_id'  => 'required|numeric|min:1|',
            'note'        => 'nullable|string|max:400'
        ]);

        $pr =  Product::where('product_name','=',$request->product_name)->first() ?? null;
        if($pr != null){
            if($pr->product_name == $request->product_name && $pr->section_id == $request->section_id){
                session()->flash('yes',"Product is Not Updataed it is oready token ☺☻☺");
                return redirect()->back();
            }
        }

        $product = Product::find($request->id);
        $product->update([
            "product_name"=> $request->product_name,
            "section_id"=> $request->section_id,
            "note"=> $request->note,
            "created_by"=>Auth::user()->name,
        ]);

        session()->flash('yes',"Product is Updataed %100 ☺☻☺");
        return redirect()->back();
    }


    public function destroy(Product $product)
    {
        if (Auth::user()->hasPermission('Product_delete') != 1) {
            abort(404);
        }

        $productfind = DB::table('products')->find($product->id);
        if ($productfind){
            $product->delete();
            session()->flash('yes', 'product is deleted');
            return redirect()->back();
        }
        session()->flash('yes', 'product is not deleted');
        return redirect()->back();
    }
}
