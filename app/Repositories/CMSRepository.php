<?php

namespace App\Repositories;

use App\CMS;
use Illuminate\Http\Request;

class CMSRepository implements BaseRepository
{
	public function getAllData($request)
	{
	  $columns = array( 
                            0 =>'id', 
                            1 =>'cms_page_name',
                            2=> 'status',
                            3=> 'created_by',
                            4=> 'action',
                        );
  
        $totalData = CMS::count();
            
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = CMS::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $posts =  CMS::where('name','LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->orWhere('mobile', 'LIKE',"%{$search}%")
                            ->orWhere('registeration_date', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = CMS::where('name','LIKE',"%{$search}%")
                            ->orWhere('mobile', 'LIKE',"%{$search}%")
                            ->orWhere('registeration_date', 'LIKE',"%{$search}%")
                             ->orWhere('email', 'LIKE',"%{$search}%")
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
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $nestedData['mobile'] = $post->mobile;
             $nestedData['registeration'] = date("d-m-Y", strtotime($post->registeration_date));
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
            
        return json_encode($json_data); 	
	}

	}
}
	