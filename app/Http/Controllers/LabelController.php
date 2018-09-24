<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Label;
use Session;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.labels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.labels.create_label');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
         Label::create([
            'label_name' => $data['labelName'],
            'language_name' => Config('app.locale'),
            'label_value' => $data['labelValue'],
        ]);
         return redirect('/en/admin/labels'); 
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
          $columns = array( 
                            0 =>'id', 
                            1 =>'label_name',
                            2=> 'language_name',
                            3=> 'label_value',
                            4=> 'action',
                        );
  
        $totalData = Label::count();
            
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = Label::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $posts =  Label::where('label_name','LIKE',"%{$search}%")
                            ->orWhere('language_name', 'LIKE',"%{$search}%")
                            ->orWhere('label_value', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Label::where('label_name','LIKE',"%{$search}%")
                            ->orWhere('language_name', 'LIKE',"%{$search}%")
                             ->orWhere('label_value', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $nestedData['id'] = $post->id;
                $nestedData['labelName'] = $post->label_name;
                $nestedData['labelLanguage'] = $post->language_name;
                $nestedData['labelValue'] = $post->label_value;
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
        $label=Label::find($id);
        return view('admin.labels.edit_label',compact('label'));
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
        $label = Label::find($data->id);
        $label->label_name= $data->labelName;
        $label->label_value = $data->labelValue;
        $label->language_name = Config('app.locale');
         $label->save();
         return redirect('/en/admin/labels'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email = Label::find($id)   ;
         $email->delete();
         Session::flash('success', 'Label delete successfully!');
         return redirect()->back(); 
    }
}
