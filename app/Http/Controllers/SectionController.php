<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Exception\BreakException;

class SectionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','permission:Sections']);
    }


    public function index()
    {
        $sections = DB::table('sections')->latest()->paginate();
        //$sections = DB::table('sections')->lazyByIdDesc(1,'id')->all();
        return view('sections.section',compact('sections'));
    }


    public function create()
    {

    }


    public function store(SectionRequest  $request)
    {
        if (Auth::user()->hasPermission('Section_create') != 1) {
            abort(404);
        }
        $request->validated();

        section::create([
            'section_name'=> $request->section_name,
            'note'=> $request->note,
            'created_by'=> Auth::user()->name,
        ]);

        session()->flash('yes','Section is Created');
        return redirect('/section');
    }


    public function show(section $section)
    {

    }


    public function edit(section $section)
    {

    }


    public function update(Request $request)
    {
        if (Auth::user()->hasPermission('Section_edite') != 1) {
            abort(404);
        }

        if ($request->check == 'yes') {
            $request->validate([
                'section_name'=> 'required|string|min:1|unique:sections,section_name|max:50',
                'note'        => 'nullable|string|max:200'
            ]);
        } else {
            $request->validate([
                'section_name'=> 'required|string|min:1|max:50',
                'note'        => 'nullable|string|max:200'
            ]);
        }


        $ee = section::findOrFail($request->id);

        $ee->update([
         'section_name'=>$request->section_name,
         'note'=>$request->note,
         'created_at'=> Auth::user()->name
     ]);

        session()->flash('yes','section is updated');
        return redirect()->back();
    }


    public function destroy(section $section)
    {
        if (Auth::user()->hasPermission('Section_delete') != 1) {
            abort(404);
        }

        $des = DB::table('sections')->where('id','=',$section->id)->exists();
        if ($des){
            $section->delete();
            session()->flash('yes','section is deleted');
            return redirect()->back();
        }else{
            session()->flash('yes','section is not deleted');
           return redirect()->back();
        }
    }
}
