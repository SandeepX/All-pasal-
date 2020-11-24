<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use PDF;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
     {
    //     $data = [
    //         'title' => 'This is testing Pdf genration ',
    //         'date' => date('m/d/Y')
    //     ];

        //$data = User::where('email','pooja@gmail.com')->get();
        $data = User::all();
        //dd($data);

        view()->share('welcome',$data);
          
        $pdf = PDF::loadView('myPDF',compact('data'));
    
        return $pdf->download('Example.pdf');
    }
}