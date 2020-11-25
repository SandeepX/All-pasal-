<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PDF;


class BillController extends Controller
{
    
    public function getContent()
    {
       $response = Http::withHeaders([
                'content-type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiNzNiYmIzOTZmZGVlYmY0ZmVkODYxZjU1Mzk2NWMyYjMxYWMzMzIxNmFiZWZlN2UwZjA5OGMyZDFlYzIyMzEwZTQ5NTk4YmNlMzEyNTljYmQiLCJpYXQiOjE2MDYyNzg2MzQsIm5iZiI6MTYwNjI3ODYzNCwiZXhwIjoxNjA2MzY1MDMzLCJzdWIiOiJVMDAwMDAwMDMiLCJzY29wZXMiOltdfQ.g4_Y_cjnR84TluzEsTq5RxD-RGmkHcK170wNcjEfK_S18HDPimr0mOcZZATjZhHcb-R5oGZYtyT8QXpuSt54A09fbJ2pYtcIu83lTzdO3SapXA1JooexH_A4LGboBNDxlMnUUgYGrGZ3-J0UHfCQq6yleo33xsHM1OtEbwHKQZoCsZMoLJGX2-8ZgDFoOCUCqdkeQ_rhJlYvH6ije3cf-Oew8nVRFqBkbIutTDiFo-i3kq_S2C4trhpyqwtm3JtaXbq3NZrPVADspZtxAh5_IYsRqv1V1dXIiNqxo7T1bsc9xW4JbUYwcsAeRIGjRL5J8fggLtLakXToU3V1PFOHVRO4fwO8h63CIwe_mAWVCM3OEYS58_jOUqXvFnKuOEwHcO6DU14ULFEzmhZVAan7K5Hh-RXgx6vwwd63ywxeGTuTy9o2xb3C9fEXmf7vnxQ6yNQMgZpajtPdpUPvbRwmEI-P_z-HVryNFLSDg221Uo0ySNdWGCSpSLSfPCLDrb1r763-QWTMAbEErKFObHGydiEzWXVxhqvW8lbKPiX90GPXyH9YRQCLt7-JDbKxZddJy0XOfKUVfSIiREycMVEOxLLQ1iKkjyJwz0j5TEjbY7dSZ3vNJTm4izY-bHzCTg_D_AaJ4GLjXVWgAQ5YW-d0XtVJHeHQG7y9O1zNPGs5aKo',
            ])
            ->get('http://192.168.10.82:8000/api/store/orders/S01040');

        if($response){

            $data = json_decode ($response);
            $detail = $data->data->details;
            //dd($detail);
            return view('allpasal' ,compact('detail'));
            //view()->share('allpasal',$detail);
          
           // $pdf = PDF::loadView('allpasal',compact('detail'));
    
           //return $pdf->download('Allpasal.pdf');
           
            //return view('allpasal',compact('detail'));
        }

        
        
    }

    public function generateBill()
    {
        
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiNzNiYmIzOTZmZGVlYmY0ZmVkODYxZjU1Mzk2NWMyYjMxYWMzMzIxNmFiZWZlN2UwZjA5OGMyZDFlYzIyMzEwZTQ5NTk4YmNlMzEyNTljYmQiLCJpYXQiOjE2MDYyNzg2MzQsIm5iZiI6MTYwNjI3ODYzNCwiZXhwIjoxNjA2MzY1MDMzLCJzdWIiOiJVMDAwMDAwMDMiLCJzY29wZXMiOltdfQ.g4_Y_cjnR84TluzEsTq5RxD-RGmkHcK170wNcjEfK_S18HDPimr0mOcZZATjZhHcb-R5oGZYtyT8QXpuSt54A09fbJ2pYtcIu83lTzdO3SapXA1JooexH_A4LGboBNDxlMnUUgYGrGZ3-J0UHfCQq6yleo33xsHM1OtEbwHKQZoCsZMoLJGX2-8ZgDFoOCUCqdkeQ_rhJlYvH6ije3cf-Oew8nVRFqBkbIutTDiFo-i3kq_S2C4trhpyqwtm3JtaXbq3NZrPVADspZtxAh5_IYsRqv1V1dXIiNqxo7T1bsc9xW4JbUYwcsAeRIGjRL5J8fggLtLakXToU3V1PFOHVRO4fwO8h63CIwe_mAWVCM3OEYS58_jOUqXvFnKuOEwHcO6DU14ULFEzmhZVAan7K5Hh-RXgx6vwwd63ywxeGTuTy9o2xb3C9fEXmf7vnxQ6yNQMgZpajtPdpUPvbRwmEI-P_z-HVryNFLSDg221Uo0ySNdWGCSpSLSfPCLDrb1r763-QWTMAbEErKFObHGydiEzWXVxhqvW8lbKPiX90GPXyH9YRQCLt7-JDbKxZddJy0XOfKUVfSIiREycMVEOxLLQ1iKkjyJwz0j5TEjbY7dSZ3vNJTm4izY-bHzCTg_D_AaJ4GLjXVWgAQ5YW-d0XtVJHeHQG7y9O1zNPGs5aKo',
        ])
        ->get('http://192.168.10.82:8000/api/store/orders/S01040');

        if($response){

            $data = json_decode ($response);
            $detail = $data->data->details;
            
            view()->share('allpasal',$detail);
        
            $pdf = PDF::loadView('allpasal',compact('detail'));

            return $pdf->download('Allpasal.pdf');
        
           
        }

       
    }


    
}
