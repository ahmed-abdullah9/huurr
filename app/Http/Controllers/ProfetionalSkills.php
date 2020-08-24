<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Profetionl;


class ProfetionalSkills extends Controller
{
    
    public function index()
    {
        $all_categories = DB::table('profetionls')->get();
        return view('profetionls.index', compact('all_categories'));
    }

   
    public function create()
    {
        $all_categories = DB::table('categories')->where('parent_id', 0)->get();
        return view('profetionls.create', compact('all_categories'));
    }

    
    public function store(Request $request)
    {
        $profetionl = new Profetionl;
        $profetionl->name = $request->name;
        $profetionl->category_id = $request->category_id;
        $profetionl->description = $request->description;

        $profetionl->save();

        return redirect('/profetionls');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $selected = '';
        $all_categories = DB::table('categories')->where('parent_id', 0)->get();
        $profetionls = DB::table('profetionls')->where('profetional_id', $id)->first();
        return view("profetionls.edit", compact(['all_categories', 'profetionls', 'selected']));
    }

    
    public function update(Request $request, $id)
    {
        
        $category = array();
        $category['name'] = $request->name;
        $category['category_id'] = $request->category_id;
        $category['description'] = $request->description;

       
        DB::table('profetionls')
            ->where('profetional_id', $id)
            ->update($category);

        return redirect('/profetionls');
    }

    
    public function destroy($id)
    {
        DB::table('profetionls')->where('profetional_id', $id)->delete();
        return redirect(url("/profetionls"));
    }
}
