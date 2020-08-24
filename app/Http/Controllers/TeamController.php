<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Team;
use Image;
use File;
class TeamController extends Controller
{
    public function index(){
        $teams=Team::all();
          return view('admin.manage_team',compact('teams'));
    }
    public function add_member_form(){
        return view('admin.team_form');
    }
    public function submit_member(Request $request){
       $resp=array();
        $rules=[
         'image'=>'required|image|mimes:jpeg,png,jpg',
           'name'=>'required',
           'ar_name'=>'required',
           'designation'=>'required',
           'description'=>'required',
           'ar_description'=>'required',
            'ar_designation'=>'required',
            'linkedin'=>'required',
       ];
       $messages=[
           'image.required'=>'Image is Required',
           'image.image'=>'file is not Image',
           'image.mimes'=>'Image type should be extensions jpeg,png,jpg',
           'name.required'=>'Name is Rquired',
           'ar_name.required'=>'Name in Arabic is Rquired',
           'description.required'=>'Description field is required',
           'ar_description.required'=>'Description field is required',
           'designation.required'=>'Enter Designation in English',
           'ar_designation.required'=>'Enter Designation in Arabic',
           'linkedin.required'=>'Please Enter LinkedIn Link',
       ];
       $validation=Validator::make($request->all(),$rules,$messages);
       if ($validation->fails()){
           $resp['status']=false;
           $resp['errors']=$validation->errors();
       }
       else{
           $team=new Team;
           if ($request->has('image')){
               $image=$this->upload_image_thumbnails($request->file('image'));
                $team->image=$image;
           }

           $team->name=$request->input('name');
           $team->ar_name=$request->input('ar_name');
           $team->designation=$request->input('designation');
           $team->ar_designation=$request->input('ar_designation');
           $team->linkedin=$request->input('linkedin');
           $team->description=$request->input('description');
           $team->ar_description=$request->input('ar_description');
           if ($team->save()){
               $resp['status']=true;
               $resp['message']='You have added successfully';
           }
       }
       echo json_encode($resp);
    }
    public function edit_member_form($team){
       $team=Team::find($team);

        return view('admin.team_form',compact('team'));
    }
    public function update_member(Request $request){
        $resp=array();
        $rules=[
            'image'=>'image|mimes:jpeg,png,jpg',
            'name'=>'required',
            'ar_name'=>'required',
            'designation'=>'required',
            'description'=>'required',
            'ar_description'=>'required',
            'team_id'=>'required',
            'ar_designation'=>'required',
            'linkedin'=>'required',
        ];
        $messages=[
            'image.image'=>'file is not Image',
            'image.mimes'=>'Image type should be extensions jpeg,png,jpg',
            'name.required'=>'Name is Rquired',
            'ar_name.required'=>'Name in Arabic is Rquired',
            'description.required'=>'Description field is required',
            'ar_description.required'=>'Description field is required',
            'designation.required'=>'Enter Designation in English',
            'ar_designation.required'=>'Enter Designation in Arabic',
            'linkedin.required'=>'Please Enter LinkedIn Link',
        ];
        $validation=Validator::make($request->all(),$rules,$messages);
        if ($validation->fails()){
            $resp['status']=false;
            $resp['errors']=$validation->errors();
        }
        else{
            $team=Team::find($request->input('team_id'));
            if ($request->has('image')){
                $filename = public_path().'/teamImages/'.$team->image;
                \File::delete($filename);
                $image=$this->upload_image_thumbnails($request->file('image'));
                $team->image=$image;
            }

            $team->name=$request->input('name');
            $team->ar_name=$request->input('ar_name');
            $team->designation=$request->input('designation');
            $team->description=$request->input('description');
            $team->ar_description=$request->input('ar_description');
            $team->ar_designation=$request->input('ar_designation');
            $team->linkedin=$request->input('linkedin');
            if ($team->save()){
                $resp['status']=true;
                $resp['message']='You have updated successfully';
            }
        }
        echo json_encode($resp);
    }
    public function del_member($id){
        $team=Team::find($id);
        if (Team::find($id)->delete()){
            $filename = public_path().'/teamImages/'.$team->image;
            \File::delete($filename);
            return redirect()->back()->with('message','You have Deleted Successfully');
        }
    }
    public function upload_image_thumbnails($image){
        $originalImage=$image;
        $name =time().$originalImage->getClientOriginalName();
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/teamImages/';
        $thumbnailImage->resize(370,370);
        $thumbnailImage->save($thumbnailPath.$name);
        return $name;
    }
    public function team(){
        $teams=Team::all();
        return view('team',compact('teams'));
    }
}
