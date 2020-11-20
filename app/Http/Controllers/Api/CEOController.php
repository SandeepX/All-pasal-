<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CEO;
use App\Http\Resources\CEOResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CEOController extends Controller
{
    
    public function index()
    {
       $allCeo = CEO::orderBy('created_at','Desc')->paginate(20);
     
       return response(['ceos'=>CEOResource::collection($allCeo),'message'=>'Retrived successffully'],200);
    }

   
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
            'name'=>'bail|required|string',
            'year'=>'required',
            'headquarter'=>'required',
            'Activities'=>'nullable|string|max:1000',
        ]);

        if($validator->fails()){
            return repsonse(['error'=>$validator->error(),'Validation Error']);
        }

        $ceo = CEO::create($data);

        return response(['ceo' => new CEOResource($ceo),'message'=>'successfully created'],200);
    }

   
    public function show(CEO $ceo)
    {
        return response([ 'ceo' => new CEOResource($ceo), 'message' => 'Retrieved successfully'], 200);
    }

   
   
    public function update(Request $request, CEO $ceo)
    {
        $ceo->update($request->all());

        return response([ 'ceo' => new CEOResource($ceo), 'message' => 'updated successfully'], 200);
    }

    
    public function destroy($id)
    {
        $data = CEO::find($id);
        if($data){

            $status = $data->delete();
            if($status){

                return response(['message' => 'Deleted']);
            }
        }

    }
}
