<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use File;
use Image;
use App\AdminPortfolio;
class AdminPortfolioController extends Controller
{
   public function index(){
       $portfolio=AdminPortfolio::all();
       return view('admin.manage_portfolio',compact('portfolio'));
   }
   public function add_portfolio_form(){
       return view('admin.portfolio_form');
   }
   public function submit_portfolio(Request $request){
       $resp=array();
       $rules=[
           'image'=>'required|image|mimes:jpeg,png,jpg',
           'name'=>'required',
           'ar_name'=>'required',
           'skill'=>'required',
           'ar_skill'=>'required',
           'demension'=>'required',
       ];
       $messages=[
           'image.required'=>'Image is Required',
           'image.image'=>'file is not Image',
           'image.mimes'=>'Image type should be extensions jpeg,png,jpg',
           'name.required'=>'Name is Rquired',
           'ar_name.required'=>'Name in Arabic is Rquired',
           'skill.required'=>'Skill field is required',
           'ar_skill.required'=>'Please Enter skill in arabic',
           'demension.required'=>'Please Select Image Demsion',
       ];
       $validation=Validator::make($request->all(),$rules,$messages);
       if ($validation->fails()){
           $resp['status']=false;
           $resp['errors']=$validation->errors();
       }
       else{
           if(portfolioLimit($request->input('skill'),$request->input('demension'))==true){
           $portfolio=new AdminPortfolio;
           if ($request->has('image')){
               if($request->input('demension')==0){
                   $image=$this->small($request->file('image'));
               }
               else{
                   $image=$this->large($request->file('image'));
               }

               $portfolio->image=$image;
           }
           if ($request->has('profile_link')){
               $portfolio->profile_link=$request->input('profile_link');
           }

           $portfolio->name=$request->input('name');
           $portfolio->ar_name=$request->input('ar_name');
           $portfolio->skill=$request->input('skill');
           $portfolio->ar_skill=$request->input('ar_skill');
           $portfolio->demension=$request->input('demension');
           if ($portfolio->save()){
               $resp['status']=true;
               $resp['message']='You have added successfully';
           }
           }
           else{
               $resp['status']=true;
               $resp['message']='You have exceeding limit please delete one';
           }
       }
       echo  json_encode($resp);
   }
    public function small($image){
        $originalImage=$image;
        $name =time().$originalImage->getClientOriginalName();
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/portfolio/small/';
        $thumbnailImage->resize(255,170);
        $thumbnailImage->save($thumbnailPath.$name);
        return $name;
    }
    public function large($image){
        $originalImage=$image;
        $name =time().$originalImage->getClientOriginalName();
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/portfolio/small/';
        $thumbnailImage->resize(255,340);
        $thumbnailImage->save($thumbnailPath.$name);
        return $name;
    }
    public function del_portfolio($id){
        $team=AdminPortfolio::find($id);
        if (AdminPortfolio::find($id)->delete()){
            $filename = public_path().'/portfolio/small/'.$team->image;
            \File::delete($filename);
            return redirect()->back()->with('message','You have Deleted Successfully');
        }
    }
    public function edit_portfolio_form($id){
        $portfolio=AdminPortfolio::find($id);
        return view('admin.portfolio_form',compact('portfolio'));
    }
    public function update_portfolio(Request $request){
        $resp=array();
        $rules=[
            'image'=>'image|mimes:jpeg,png,jpg',
            'name'=>'required',
            'ar_name'=>'required',
            'skill'=>'required',
            'ar_skill'=>'required',
            'portfolio_id'=>'required',
            'demension'=>'required',
        ];
        $messages=[
            'image.image'=>'file is not Image',
            'image.mimes'=>'Image type should be extensions jpeg,png,jpg',
            'name.required'=>'Name is Rquired',
            'ar_name.required'=>'Name in Arabic is Rquired',
            'skill.required'=>'Skill field is required',
            'ar_skill.required'=>'Please Enter skill in arabic',
            'portfolio_id.required'=>'required',
            'demension.required'=>'Please Select Image Demsion',
        ];
        $validation=Validator::make($request->all(),$rules,$messages);
        if ($validation->fails()){
            $resp['status']=false;
            $resp['errors']=$validation->errors();
        }
        else{
            $portfolio=AdminPortfolio::find($request->input('portfolio_id'));
            if ($request->has('image')){
                $filename = public_path().'/portfolio/small/'.$portfolio->image;
                \File::delete($filename);
                if($request->input('demension')==0){
                    $image=$this->small($request->file('image'));
                }
                else{
                    $image=$this->large($request->file('image'));
                }
                $portfolio->image=$image;
            }
            if ($request->has('profile_link')){
                $portfolio->profile_link=$request->input('profile_link');
            }
            $portfolio->name=$request->input('name');
            $portfolio->ar_name=$request->input('ar_name');
            $portfolio->skill=$request->input('skill');
            $portfolio->ar_skill=$request->input('ar_skill');
            $portfolio->demension=$request->input('demension');
            if ($portfolio->save()){
                $resp['status']=true;
                $resp['message']='You have updated successfully';
            }
        }
        echo  json_encode($resp);
    }
}
