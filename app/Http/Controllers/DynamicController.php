<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TemplateRepository;
use Session;

class DynamicController extends Controller
{
          protected $templateRepository;

   public function __construct(TemplateRepository $templateRepository)
    {
        $this->TemplateRepository=$templateRepository;
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dynamic_email.dynamic_email');
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
       $this->TemplateRepository->storeTemplate($data);
         return redirect()->route('email.index'); 
    }


       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

     return $this->TemplateRepository->getTemplateData($request); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email=$this->TemplateRepository->editTemplate($id);
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
        
       
        $this->TemplateRepository->updateTemplate($data);
         return redirect()->route('email.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $this->TemplateRepository->deleteTemplate($id);
         return redirect()->route('email.index');   
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
