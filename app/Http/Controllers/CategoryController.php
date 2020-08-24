<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;

class CategoryController extends Controller
{
    
    public function index()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/',$url);
        $language = 'en';
        if(isset($url[1]) && $url[1]=='ar'){
            $language = 'ar';
        }
        $all_categories = DB::table('categories')->where('parent_id', 0)->get();
        return view('categories.index', compact('all_categories','language'));
    }

    
    public function create()
    {
        $all_categories = DB::table('categories')->where('parent_id', 0)->get();
        return view('categories.create', compact('all_categories'));
    }

    
    public function store(Request $request)
    {
        //return $request->all();
        $category = new Category;
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;

        $category->save();
        
        return redirect('/categories');
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $selected = '';
        $all_categories = DB::table('categories')->where('parent_id', 0)->get();
        $category = DB::table('categories')->where('category_id', $id)->first();
        return view("categories.edit", compact(['all_categories', 'category', 'selected']));
    }

    
    public function update(Request $request, $id)
    {
        
        $category = array();
        $category['name'] = $request->name;
        $category['parent_id'] = $request->parent_id;
        $category['description'] = $request->description;

       
        DB::table('categories')
            ->where('category_id', $id)
            ->update($category);

        return redirect('/categories');
    }

    
    public function destroy($id)
    {
        DB::table('categories')->where('category_id', $id)->delete();
        return redirect('/categories');
    }
    public function add_skill_form($category_id){
       $category_id=decrypt($category_id);
        if(!empty(DB::table('categories')->where('category_id',$category_id)->first()))
        {
            return view('categories.fr_add_skill_form',compact('category_id'));
        }
       else{
            return redirect()->back();
       }
    }
    public function submit_skill(Request $request){
        if (empty($request->input('name'))&&empty($request->input('category_id'))){
         return   redirect()->back()->with('info','Skill field is required');
        }
        else{
           $data=[
             'parent_id'=>$request->input('category_id'),
               'name'=>$request->input('name')
           ];
           DB::table('categories')->insert($data);
           return redirect()->back()->with('message',$request->input('name').'  Skill is Submitted Successfully');
        }
    }
    public function view_skills($parent_id){
        $parent_id=decrypt($parent_id);
        $skills=DB::table('categories')->where('parent_id',$parent_id)->get()->toarray();
        return view('categories.view_fr_skills',compact('parent_id','skills'));
    }
    public function edit_skill_form($category_id){
        $category_id=decrypt($category_id);
        if (!empty($skills=DB::table('categories')->where('category_id',$category_id)->first())){

            return view('categories.fr_add_skill_form',compact('skills'));
        }
        else{
            return redirect()->back();
        }

    }
    public function update_skill(Request $request){
        if (empty($request->input('name'))&&empty($request->input('category_id'))){
            return   redirect()->back()->with('info','Skill field is required');
        }
        else{
            $data=[
                'name'=>$request->input('name')
            ];
            DB::table('categories')->where('category_id',$request->input('category_id'))->update($data);
            return redirect()->back()->with('message',$request->input('name').'  Skill is updated Successfully');
        }
    }
    public function del_skill($category_id){
        $category_id=decrypt($category_id);
        DB::table('categories')->where('category_id',$category_id)->delete();
        return redirect()->back()->with('message', 'Skill is deleted Successfully');
    }
    public function job_skills(Request $request){
        $skills=DB::table('categorie')->where('parent_id',$request->input('category_id'))->get()->toarray();
        echo json_encode($skills);
    }
}
