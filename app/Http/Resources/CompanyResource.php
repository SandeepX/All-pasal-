<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Company;
use App\Http\Resources\CEOResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'name'=>ucfirst($this->name),
            'address' => ucfirst($this->address),
            'logo'=> asset('uploads/logo/'.$this->logo),
            'email'=>$this->email,
            'ceo'=> new CEOResource($this->CEO),
        ];
    }


}
