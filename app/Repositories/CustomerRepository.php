<?php

namespace App\Repositories;

use App\Customer;
use Illuminate\Http\Request;

class CustomerRepository implements BaseRepository
{
	/**
	 * @var $model
	 */
	private $model;

	/**
	 * EloquentCustomer constructor.
	 *
	 * @param App\Customer $model
	 */
	public function __construct(Customer $model)
	{
		$this->model = $model;
	}

	
	public function getAll()
	{
		return $this->model->all();
	}

	/**
	 * Get task by id.
	 *
	 * @param integer $id
	 *
	 * @return App\Task
	 */
	public function getById($id)
	{
		return $this->model->find($id);
	}

	/**
	 * Create a new task.
	 *
	 * @param array $attributes
	 *
	 * @return App\Task
	 */
	public function create(array $attributes)
	{
		return $this->model->create($attributes);
	}

	/**
	 * Update a task.
	 *
	 * @param integer $id
	 * @param array $attributes
	 *
	 * @return App\Task
	 */
	public function update($id, array $attributes)
	{
		return $this->model->find($id)->update($attributes);
	}
	/**
	 * store a Customer.
	 *
	 * @param integer $id
	 * @param array $attributes
	 *
	 * @return App\Task
	 */
   public function storeCustomer($data)
    {
        Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'registeration_date' => $data['registerationDate'],
            'status' => $data['status'],

        ]);
         return true;
    }

	/**
	 * Get all customers.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function getCustomerData($request)
	{
	  $columns = array( 
                            0 =>'id', 
                            1 =>'name',
                            2=> 'email',
                            3=> 'mobile',
                            4=> 'registeration_date',
                        );
  
        $totalData = Customer::count();
            
        $totalFiltered = $totalData; 
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = Customer::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $posts =  Customer::where('name','LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->orWhere('mobile', 'LIKE',"%{$search}%")
                            ->orWhere('registeration_date', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Customer::where('name','LIKE',"%{$search}%")
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
	 /**
	 * Edit a task
	 *
	 * @var integer $id
	 * @var array 	$attributes
	 *
	 * @return mixed
	 */
	public function editCustomer($id)
	{
	  return Customer::find($id);
	}
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCustomer($data)
    {
        $customer = Customer::find($data->id);
        $customer->name = $data->name;
        $customer->email = $data->email;
        $customer->mobile = $data->mobile;
        $customer->registeration_date = $data->registerationDate;
         $customer->save();
           return true;
    }
	/**
	 * Delete a Customer.
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public function deleteCustomer($id)
	{
		$customer=Customer::find($id);
		 $customer->delete();
		  return true;
	}

}
