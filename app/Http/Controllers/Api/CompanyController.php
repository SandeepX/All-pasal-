<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Http\Resources\CompanyResource;
use App\Http\Requests\CompanyRequest;
use File;

class CompanyController extends Controller
{
    protected $companydetail = null;
   

    public function __construct(Company $companydetail){
        $this->companydetail = $companydetail;
        
    }
    
    public function index()
    {
       
       $allcompany = $this->companydetail->orderBy('created_at','DESC')->paginate(1);
     
       return response(['data'=>CompanyResource::collection($allcompany),'message'=>'Retrived successffully'],200);
     
    }

   
    public function store(CompanyRequest $request)
    {
        
        $request->validated();
        
        $data = $request->all(); 
       

        if($request->logo){
            $upload_dir = public_path().'/uploads/logo' ;
            if(!File::exists($upload_dir)){
                File::makeDirectory($upload_dir,0777,true,true);
            }
            $file_name = "Company-".date('Ymdhis').rand(0,999).".".$request->logo->getClientOriginalExtension();
            $success = $request->logo->move($upload_dir, $file_name);
            if($success){
                
                $data['logo'] = $file_name;
            } else{
                $data['logo'] = null;
            }

        }
        $Companydetail = Company::create($data);
        if(!$Companydetail)
        
        {
           return response()->json(['data'=>null,'message'=>'Company detail not stored'],500); 
        }
        return response()->json(['data'=>new CompanyResource($Companydetail),'message'=>'company detail added'],200);
           
    }

    
    public function show($id)
    {
       
       $CompanyData = $this->companydetail->where('id',$id)->get();
       //dd($CompanyData);
       if(count($CompanyData)>0){

       return response(['data'=>CompanyResource::collection($CompanyData),'message'=>'Detail of this page'],200);
       }else{
            return response(['message'=>'Data not found for this id'],404);
       }
    }

    


    public function update(Companyrequest $request, $id)
    {

        //$request->validated();

        $companydata = Company::find($id);
        

        $validatedRequest = $request->validated();

        //dd($companyupdate);
        if(!$companydata){
            return response()->json(['messagae'=>'Company not found','data'=>null],500);
        }

        $companyupdate['logo'] = $companydata->logo;
        
        if($validatedRequest['logo']){
            $upload_dir = public_path().'/uploads/logo' ;
            if(!File::exists($upload_dir)){
                File::makeDirectory($upload_dir,0777,true,true);
            }
            $file_name = "Company-".date('Ymdhis').rand(0,999).".".$validatedRequest['logo']->getClientOriginalExtension();
            $success = $validatedRequest['logo']->move($upload_dir, $file_name);
            if($success){
                $companyupdate['logo'] = $file_name; 
                @unlink($upload_dir.'/'.$companydata->logo);
            } 

        }
        $companydata->name = $validatedRequest['name'];

        //dd($companydata->name);
        $companydata->email = $validatedRequest['email'];
        $companydata->address = $validatedRequest['address'];
        $companydata->ceo_id = $validatedRequest['ceo_id'];
        
        $companydata->logo =$companyupdate['logo']; 
        
        
        
        $data = $companydata->save();

        
        if(!$data)
        {
            return response(['message'=>'Could not update the company info'],500);
        }

        return response()->json(['message'=>'updated' ,'data'=>
            new CompanyResource($companydata)], 200);

       


    }

    
    public function destroy($id)
    {
        $companydetail = Company::find($id);
        if($companydetail){
            $companylogo = $companydetail->logo;
            
            $Companydelete = $companydetail->delete();
            if($Companydelete){
                if( $companylogo != null && file_exists(public_path().'/uploads/logo/'. $companylogo)){
                    @unlink(public_path().'/uploads/logo/'.$companylogo);
                       
                }
                return response(['data'=> $companydetail ,'message' =>'companydetail deleted succefully'],200);
            }else{
                return response()->json(['message'=>'company detail not deleted','data' =>null],500);
            }
        }

    }
}
