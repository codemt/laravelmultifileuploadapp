<?php

namespace App\Http\Controllers;
use App\Files;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    //
    public function create()
    {
        //
        return view('create');
    }

    public function store(Request $request){

        $this->validate($request, [

            'filename' => 'required',
            'filename.*' => 'mimes:jpeg,jpg,png,gif,doc,pdf,docx,zip'      

        ]);
        if($request->hasfile('filename'))
        {

           foreach($request->file('filename') as $file)
           {
               $name=$file->getClientOriginalName();
               $file->move(public_path().'/files/', $name);  
               $data[] = $name;  
           }
        }

        $file = new Files();
        $file->filename=json_encode($data);
        dd(json_encode($data));
       
       $file->save();

       return back()->with('success', 'Your files has been successfully added');





    }
}
