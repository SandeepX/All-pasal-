<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\CEO;
use Str;

class CEOResource extends JsonResource
{
    
    public function toArray($request)
    {
        return [
        	'name' =>ucfirst($this->name),
        	'year'=> date("d M,Y", strtotime($this->year)),
        	'headquarter'=>ucfirst($this->headquarter),
        	'Activities'=>Str::words($this->Activities, $words = 2, $end = '...'),
        	'created_at'=>$this->created_at->diffForHumans(),
        ];
     }
}
