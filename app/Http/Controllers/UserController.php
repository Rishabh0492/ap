<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use File;
use Storage;

class UserController extends Controller
{
 public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('admin.user.index');
    }

    public function edit($id)
    {
        $user=User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $data)
    {
        $newImageName="";
        $folderPath = '/admin/user_image/';
        if($data->hasFile('image')){
            $file=$data->file('image');
            $newImageName = rand().'_'.$file->getClientOriginalName();
            $file->move($folderPath, $newImageName);
        }
         $user = User::find($data->id);
         $user->name = $data->name;
         $user->email = $data->email;
         $user->image = $data->$newImageName;
         $user->save();
        return redirect('/home');
    }

    public function show(Request $request)
    {
        $columns = array( 
                            0 =>'id', 
                            1 =>'name',
                            2=> 'email',
                        );
  
        $totalData = User::count();
            
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = User::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $posts =  User::where('name','LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = User::where('name','LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 

    }
 public function destroy($id)
 {
    $user = User::find($id)   ;
    $user->delete();
    return redirect()->back();   
 }

public function showUserProfile()
{
    return view('admin.user.profile');
}

}
