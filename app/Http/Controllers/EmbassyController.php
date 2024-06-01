<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class EmbassyController extends Controller
{
   public function sendcandidate($id){
      if(Session::get('user')){
         $candidates = DB::table('candidates')
        ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
        ->select('candidates.*', 'visas.visa_no', 'visas.prof_name_arabic', 'visas.spon_name_arabic', 'visas.visa_date2')
        ->where('visas.candidate_id' ,'=', $id)
        ->where('candidates.agency' ,'=',Session::get('user'))->get();
        
         // dd($candidates);
         return response()->json($candidates);
      
     
        
   }else{
      return redirect(url('/'));
  }
}
}
