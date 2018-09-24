<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DynamicEmail;
use Session;

class DynamicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dynamicEmail=DynamicEmail::paginate('10');
        return view('admin.dynamic_email.dynamic_email',compact('dynamicEmail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dynamic_email.create_email'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
       DynamicEmail::create([
            'to' => $data['to'],
            'subject' => $data['subject'],
            'description' => $data['description'],
        ]);
       return redirect('/admin/dynamic-emails');
    }


       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $columns = array( 
                            0 =>'id', 
                            1 =>'to',
                            2=> 'subject',
                            3=> 'description',
                        );
  
        $totalData = DynamicEmail::count();
            
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = DynamicEmail::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $posts =  DynamicEmail::where('to','LIKE',"%{$search}%")
                            ->orWhere('subject', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = DynamicEmail::where('to','LIKE',"%{$search}%")
                            ->orWhere('subject', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['id'] = $post->id;
                $nestedData['to'] = $post->to;
                $nestedData['subject'] = $post->subject;
                $nestedData['description'] = $post->description;
              $nestedData['registeration'] = date("d-m-Y", strtotime($post->registeration_date));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email=DynamicEmail::find($id);
        return view('admin.dynamic_email.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {
        $email= DynamicEmail::find($data->id);
        $email->to = $data->to;
        $email->subject = $data->email;
        $email->description = $data->description;
         $email->save();
         return redirect('/admin/dynamic_email');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $template = DynamicEmail::find($id)   ;
         $template->delete();
         Session::flash('success', 'Template delete successfully!');
         return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewTemplateData()
    {
        return view('admin.dynamic_email.view');
    }

}
