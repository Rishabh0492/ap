<?php

namespace App\Repositories;

use App\DynamicEmail;
use Illuminate\Http\Request;

class TemplateRepository implements BaseRepository
{
	/**
	 * store a Customer.
	 *
	 * @param integer $id
	 * @param array $attributes
	 *
	 * @return App\Task
	 */
   public function storeTemplate($data)
    {
        DynamicEmail::create([
            'to' => $data['to'],
            'subject' => $data['subject'],
            'description' => $data['description'],
            'status' => $data['status'],
        ]);
         return true;
    }

	/**
	 * Get all customers.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function getTemplateData($request)
	{
	   $columns = array( 
                            0 =>'id', 
                            1 =>'to',
                            2=> 'subject',
                            3=> 'description',
                            4=> 'status',
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
            $i=1;
            foreach ($posts as $post)
            {
                $nestedData['srNo'] = $i;
                $nestedData['id'] = $post->id;
                $nestedData['to'] = $post->to;
                $nestedData['subject'] = $post->subject;
                $nestedData['description'] = $post->description;
                $nestedData['status'] = $post->status;
                $data[] = $nestedData;
                $i++;
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
	 * Edit a task
	 *
	 * @var integer $id
	 * @var array 	$attributes
	 *
	 * @return mixed
	 */
	public function editTemplate($id)
	{
     return DynamicEmail::find($id);
	}
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTemplate($data)
    {
        $email= DynamicEmail::find($data->id);
        $email->to = $data->to;
        $email->subject = $data->subject;
        $email->description = $data->description;
        $email->status = $data->status;
         $email->save();
           return true;
    }
	/**
	 * Delete a Customer.
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public function deleteTemplate($id)
	{
		$template=DynamicEmail::find($id);
		 $template->delete();
		  return true;
	}

}
