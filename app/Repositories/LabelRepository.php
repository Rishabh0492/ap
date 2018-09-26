<?php

namespace App\Repositories;

use App\Label;
use Illuminate\Http\Request;

class LabelRepository implements BaseRepository
{
	/**
	 * Delete a task.
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public function deleteLabel($id)
	{
		$labels=Label::find($id);
		 $labels->delete();
		  return true;
	}

	/**
	 * Get all labels.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function getLabelData($request)
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
            $i=1;
            foreach ($posts as $post)
            {
                $nestedData['srNo'] = $i;
                $nestedData['id'] = $post->id;
                $nestedData['labelName'] = $post->label_name;
                $nestedData['labelLanguage'] = $post->language_name;
                $nestedData['labelValue'] = $post->label_value;
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
	 * Store a label
	 *
	 * @var array $attributes
	 *
	 * @return mixed
	 */
  public function storeLabel($data)
  {
    Label::create([
            'label_name' => $data['labelName'],
            'language_name' => Config('app.locale'),
            'label_value' => $data['labelValue'],
            'status' => $data['status'],

        ]);
    return true;
  }
  /**
	 * Edit a task
	 *
	 * @var integer $id
	 * @var array 	$attributes
	 *
	 * @return mixed
	 */
	public function editLabel($id)
	{
	  return Label::find($id);
	}
  /**
	 * Update a task
	 *
	 * @var integer $id
	 * @var array 	$attributes
	 *
	 * @return mixed
	 */
	public function updateLabel($data)
	{
		$label = Label::find($data->id);
        $label->label_name= $data->labelName;
        $label->label_value = $data->labelValue;
        $label->language_name = Config('app.locale');
         $label->save();
         return true;
	}
}
