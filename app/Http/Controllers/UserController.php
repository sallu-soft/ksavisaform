<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\Visa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
   public function index(Request $request){

    if(Session::get('user')){
        if($request->isMethod('GET')){
           
            // $candidates = DB::table('candidates')
            //         ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
            //         ->select('candidates.*', 'visas.visa_no', 'visas.mofa_no', 'visas.spon_id')->where('candidates.agency', '=', Session::get('user'))
            //         // ->select('candidates.*', 'visas.*')->where('candidates.agency', '=', Session::get('user'))
            //         // ->paginate(100);
            //         ->get();
            // $user = DB::table('user')->select('*')->where('email','=', Session::get('user'))->first();
            // // dd($user);
            // return view('user.index', compact('candidates', 'user'));
            
            $query = DB::table('candidates')
            ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
            ->select('candidates.*', 'visas.visa_no', 'visas.mofa_no', 'visas.spon_id','visas.prof_name_english')
            ->where('candidates.agency', '=', Session::get('user'));

            $agents = DB::table('agents')
                ->select('*')
                ->where('user', '=', Session::get('user'))
                ->where('is_delete', '=', 0)
                ->paginate(10);
            $agentsform = DB::table('agents')
                ->select('*')
                ->where('user', '=', Session::get('user'))
                ->where('is_delete', '=', 0)->get();
        // Add search functionality
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('candidates.name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('candidates.id', 'like', '%' . $searchTerm . '%')
                      ->orWhere('candidates.passport_number', 'like', '%' . $searchTerm . '%');
            });
        }

        $query->orderBy('candidates.created_at', 'desc');

        $candidates = $query->paginate(10);
        $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();

        return view('user.index', compact('candidates','agentsform','agents','user'));
        }
    
        else {
            DB::beginTransaction();
            $response = [
                'redirect_url' => 'user/index',
            ];
        
            try {
                $candidate = new Candidates();
                $candidate->name = strtoupper($request->pname);
                $candidate->agent = $request->agent_id;
                $candidate->passport_number = strtoupper($request->pnumber);
                // $candidate->passport_issue_date = date('Y-m-d', strtotime($request->pass_issue_date));
                // $candidate->passport_expire_date = date('Y-m-d', strtotime($request->pass_expire_date));
                $issueDate = \DateTime::createFromFormat('d/m/Y', $request->pass_issue_date);
                // dd($request->all(), $issueDate);
                if ($issueDate !== false) {
                    $candidate->passport_issue_date = $issueDate->format('Y-m-d');
                } else {
                  
                }

               
                $expireDate = \DateTime::createFromFormat('d/m/Y', $request->pass_expire_date);
                if ($expireDate !== false) {
                    $candidate->passport_expire_date = $expireDate->format('Y-m-d');
                } else {
                   
                }
                $birthDate = \DateTime::createFromFormat('d/m/Y', $request->date_of_birth);
                if ($birthDate !== false) {
                    $candidate->date_of_birth = $birthDate->format('Y-m-d');
                } else {
                   
                }
                // $candidate->date_of_birth = $request->date_of_birth;
                $candidate->place_of_birth = strtoupper($request->place_of_birth);
                $candidate->address = strtoupper($request->address);
                $candidate->father = strtoupper($request->father);
                $candidate->mother = strtoupper($request->mother);
                $candidate->religion = strtoupper($request->religion);
                $candidate->married = $request->married;
                $candidate->medical_center = strtoupper($request->medical_center_name);
                // $candidate->medical_issue_date = date('Y-m-d', strtotime($request->medical_issue_date));
                // $candidate->medical_expire_date = date('Y-m-d', strtotime($request->medical_expire_date));
                $issueDate = \DateTime::createFromFormat('d/m/Y', $request->medical_issue_date);
                if ($issueDate !== false) {
                    $candidate->medical_issue_date = $issueDate->format('Y-m-d');
                } else {
                 
                }

           
                $expireDate = \DateTime::createFromFormat('d/m/Y', $request->medical_expire_date);
                if ($expireDate !== false) {
                    $candidate->medical_expire_date = $expireDate->format('Y-m-d');
                } else {
               
                }
                $candidate->police = strtoupper($request->police_licence);
                $candidate->driving_licence = strtoupper($request->driving_licence);
                $candidate->is_delete = 0;
                $candidate->gender = strtoupper($request->gender);
                
                $candidate->agency = Session::get('user');
                // dd($request->all(), $candidate);
                // Save the candidate
                if ($candidate->save()) {
                    DB::commit();
                    $response['title'] = 'Success';
                    $response['success'] = true;
                    $response['icon'] = 'success';
                    $response['message'] = 'Successfully created';
                } else {
                    $response['title'] = 'Error';
                    $response['success'] = false;
                    $response['icon'] = 'error';
                    $response['message'] = 'Cannot add';
                }
            } catch (\Exception $e) {
                DB::rollback();
                $response['title'] = 'Error';
                $response['success'] = false;
                $response['icon'] = 'error';
                $response['message'] = $e->getMessage(); // Get the actual error message
            }
        
            return response()->json($response);
        }
        
    }
    else{
        // return view('welcome');
        return redirect(url('/'));
    }
       
   }

   public function logout(){
        session()->flush();
        return redirect(url('/'));
   }

   public function visa_add(Request $request, $id){
    if(Session::get('user')){
        if($request->isMethod('GET')){
            
            $candidates = DB::table('candidates')
            ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
            ->select('candidates.*', 'visas.*')->where('candidates.id', '=', $id)
            ->get();
    // dd($candidates);        
    // return view('user.addvisa', compact('id', 'candidates'));

            $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
            return view('user.addvisa', ['id' => $id], compact('id', 'candidates','user'));
            }
            else{
         
            $visa = new Visa();
    
            $visa->visa_no = strtoupper($request->input('visa_no'));
            $visa->candidate_id = $id;
            $visa->visa_date2 = strtoupper($request->input('visa_date'));
            $visa->spon_id = strtoupper($request->input('spon_id'));
            $visa->spon_name_arabic = strtoupper($request->input('spon_name_arabic'));
            $visa->salary = strtoupper($request->input('salary'));
            // $visa->spon_name_english = strtoupper($request->input('spon_name_english'));
            $visa->prof_name_arabic = strtoupper($request->input('prof_name_arabic'));
            $visa->prof_name_english = strtoupper($request->input('prof_name_english'));
            $visa->mofa_no = strtoupper($request->input('mofa_no'));

            $mofaDate = \DateTime::createFromFormat('Y-m-d', $request->mofa_date);
            if ($mofaDate !== false) {
                $visa->mofa_date = $mofaDate->format('Y-m-d');
            } else {
           
            }
            // $visa->mofa_date = strtoupper($request->input('mofa_date'));
            $visa->okala_no = strtoupper($request->input('okala_no'));
            $visa->musaned_no = strtoupper($request->input('musaned_no'));
            $visa->user = Session::get('user');
            $candidate = Candidates::find($id);
            $flag = Visa::where('candidate_id', $id)->exists();
            // dd(1,$request->all(), 2, $id, 3, $flag);
            if ($flag == false){
                if($visa->save()){
                    return response()->json([
                        'title'=> 'Success',
                        'success' => true,
                        'icon' => 'success',
                        'message' => 'added succesfully',
                        'redirect_url' => 'user/index'
                    ]);
                }
                else{
                    return response()->json([
                        'title'=> 'Error',
                        'success' => false,
                        'icon' => 'error',
                        'message' => 'Cannot add',
                        'redirect_url' => 'user/index'
                    ]);
                }
            }
            else{
                return response()->json([
                    'title'=> 'Error',
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'This candidate have a visa',
                    'redirect_url' => 'user/index'
                ]);
            }
        }
    
    }
    else{
        return redirect(url('/'));
    }

    }  
    
    public function embassy_list(){
        if(Session::get('user')){
            $candidates = DB::table('candidates')
                    ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                    ->select('candidates.*', 'visas.*')
                    ->where('candidates.agency', '=', Session::get('user'))
                    ->get();
        // dd($candidates);
        $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
            return view('user.embassy_list', compact('candidates','user'));
        }
        else{
            return redirect(url('/'));
        }
        
    }
    
    // public function embassy_report() {
    //     if (Session::has('user')) {
    //         $userEmail = Session::get('user');
    //         $user = User::where('email', $userEmail)->first();
    
    //         // Get the total records grouped by date for the specific user
    //         $records = DB::table('visa_record')
    //             ->select(DB::raw('DATE(date) as record_date'), DB::raw('COUNT(*) as total_records'))
    //             ->where('user', $userEmail)  // Filter by user
    //             ->groupBy('record_date')  // Group by date
    //             ->get();
    
    //         // For debugging purposes (can be removed in production)
    //         // dd($records, $user);
    
    //         return view('user.embassy_record', compact('records', 'user'));
    //     } else {
    //         return redirect(url('/'));
    //     }
    // }

    public function embassy_report(Request $request) {
        if (Session::has('user')) {
            $userEmail = Session::get('user');
            $user = User::where('email', $userEmail)->first();
    
            // Get the search date from the request
            $searchDate = $request->query('search_date');
    
            // Build the query to get total records grouped by date
            $query = DB::table('visa_record')
                ->select(DB::raw('DATE(date) as record_date'), DB::raw('COUNT(*) as total_records'))
                ->where('user', $userEmail)
                ->groupBy('record_date');
    
            // If a search date is provided, filter by the search date
            if ($searchDate) {
                $query->whereDate('date', $searchDate);
            }
    
            // Execute the query
            $records = $query->get();
    
            // Return the view with the records and user information
            return view('user.embassy_record', compact('records', 'user'));
        } else {
            return redirect(url('/'));
        }
    }
    
    public function edit($id, Request $request){
        if(Session::get('user')){
            if($request->isMethod('GET')){
                $candidates = DB::table('candidates')
                        ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                        ->select('candidates.*', 'visas.*')->where('candidates.id', '=', $id)
                        ->get();
                $agentsform = DB::table('agents')
                ->select('*')
                ->where('user', '=', Session::get('user'))
                ->where('is_delete', '=', 0)->get();
                // dd($candidates); 
                $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
                return view('user.edit', compact('id', 'candidates','user','agentsform'));
            }
        }
        else{
            return redirect(url('/'));
        }
        
    }
    public function view($id, Request $request){
        if(Session::get('user')){
            if($request->isMethod('GET')){
                $candidates = DB::table('candidates')
                        ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                        ->select('candidates.*', 'visas.*')->where('candidates.id', '=', $id)
                        ->get();
                // dd($candidates); 
                $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
                return view('user.view', compact('id', 'candidates','user'));
            }
        } else{
            return redirect(url('/'));
        }
        
        
    }
    public function delete($id, Request $request) {
        if(Session::get('user')){
        $candidate = Candidates::find($id);
        if ($candidate) {
            $target = (Visa::where('candidate_id', $id)->delete());
            $flag = ($candidate->delete());
            if($flag){
                if($target = 1){
                    return response()->json(['message'=>'Visa And Candidate Deleted', 'success'=>true]);
                }
                else{
                    return response()->json(['message'=>'Candidate Deleted', 'success'=>true]);
                }
            }
            else{
                return response()->json(['message'=>'Something went wrong', 'success'=>false]);
            }
        }
           
        else {
            return response()->json([
               
                'message' => 'Contact to the support team, candidate not found',
                'success' => false
            ]);
        }
    }else{
        return redirect(url('/'));
    }
    }
    public function addisa($id, Request $request){
        if(Session::get('user')){
            if($request->isMethod('GET')){
                $candidates = DB::table('candidates')
                        ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                        ->select('candidates.*')->where('candidates.id', '=', $id)
                        ->get();
                // dd($candidates); 
                $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
                return view('user.addvisa', compact('id', 'candidates','user'));
            }
        }
        else{
            return redirect(url('/'));
        }
        
    }

    public function personal_edit($id, Request $request){
        // dd( $request->all());
        if(Session::get('user')){
            $candidate = Candidates::where('id', $id)->first();
            if($candidate){
            $candidate->name = strtoupper($request->pname);
            $candidate->agent = $request->agent_id;
            $candidate->passport_number = strtoupper($request->pnumber);
            $issueDate = \DateTime::createFromFormat('d/m/Y', $request->pass_issue_date);
            if ($issueDate !== false) {
                $candidate->passport_issue_date = $issueDate->format('Y-m-d');
            } else {
              
            }

           
            $expireDate = \DateTime::createFromFormat('d/m/Y', $request->pass_expire_date);
            if ($expireDate !== false) {
                $candidate->passport_expire_date = $expireDate->format('Y-m-d');
            } else {
               
            }
            $birthDate = \DateTime::createFromFormat('d/m/Y', $request->date_of_birth);
                if ($birthDate !== false) {
                    $candidate->date_of_birth = $birthDate->format('Y-m-d');
                } else {
                   
                }
            // $candidate->date_of_birth = $request->date_of_birth;
            $candidate->place_of_birth = strtoupper($request->place_of_birth);
            $candidate->address = strtoupper($request->address);
            $candidate->father = strtoupper($request->father);
            $candidate->mother = strtoupper($request->mother);
            $candidate->religion = strtoupper($request->religion);
            $candidate->married = $request->married;
            $candidate->medical_center = strtoupper($request->medical_center_name);
            $issueDate = !empty($request->medical_issue_date) ? \DateTime::createFromFormat('d/m/Y', $request->medical_issue_date) : null;

            if ($issueDate !== false && $issueDate !== null) {
                $candidate->medical_issue_date = $issueDate->format('Y-m-d');
            } else {
               
                // $candidate->medical_issue_date = null; 
            }

            $expireDate = !empty($request->medical_expire_date) ? \DateTime::createFromFormat('d/m/Y', $request->medical_expire_date) : null;

            if ($expireDate !== false && $expireDate !== null) {
                $candidate->medical_expire_date = $expireDate->format('Y-m-d');
            } else {
               
                // $candidate->medical_expire_date = null; 
            }
            $candidate->police = strtoupper($request->police_licence);
            $candidate->address = strtoupper($request->address);
            $candidate->driving_licence = strtoupper($request->driving_licence);
            $candidate->is_delete = 0;
            $candidate->gender = strtoupper($request->gender);
            // dd($candidate->save());
            if($candidate->save()){
                return response()->json([
                    'title'=> 'Success',
                    'success' => true,
                    'icon' => 'success',
                    'message' => 'Edited succesfully',
                    'redirect_url' => 'user/index'
                ]);
            }
            else{
                return response()->json([
                    'title'=> 'Error',
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'Cannot edit',
                    'redirect_url' => 'user/index'
                    
                ]);
            }
        }
            else{
                return response()->json([
                    'title'=> 'Error',
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'Candidate does not exist',
                    'redirect_url' => 'user/index'
                ]);
            }
        }
        else{
            return redirect(url('/'));
        }
        
    }

    public function visa_edit($id, Request $request){
        if(Session::get('user')){
            $visa = Visa::where('candidate_id', $id)->first();
            // dd($visa,2, $id);
            if($visa){
                $visa->visa_no = $request->input('visa_no');
                $visa->candidate_id = $id;
                $visa->visa_date2 = $request->input('visa_date');
                $visa->spon_id = $request->input('spon_id');
                $visa->spon_name_arabic = $request->input('spon_name_arabic');
                $visa->salary = $request->input('salary');
                $visa->spon_name_english = $request->input('spon_name_english');
                $visa->prof_name_arabic = $request->input('prof_name_arabic');
                $visa->prof_name_english = $request->input('prof_name_english');
                $visa->mofa_no = $request->input('mofa_no');

                $mofaDate = \DateTime::createFromFormat('Y-m-d', $request->mofa_date);
            if ($mofaDate !== false) {
                $visa->mofa_date = $mofaDate->format('Y-m-d');
            } else {
           
            }

                // $visa->mofa_date = $request->input('mofa_date');
                $visa->okala_no = $request->input('okala_no');
                $visa->musaned_no = $request->input('musaned_no');
                // dd($visa->save());
                if($visa->save()){
                    return response()->json([
                        'title'=> 'Success',
                        'success' => true,
                        'icon' => 'success',
                        'message' => 'Successfully Updated Visa',
                        'redirect_url' => 'user/index'
                    ]);
                }
                else{
                    return response()->json([
                        'title'=> 'Error',
                        'success' => false,
                        'icon' => 'error',
                        'message' => 'Cannot edit',
                        'redirect_url' => 'user/index'
                    ]);
                }
            }
            else{
               
                    return response()->json([
                        'title'=> 'Error',
                        'success' => false,
                        'icon' => 'error',
                        'message' => 'Visa Not Found ',
                        'redirect_url' => 'user/index'
                    ]);
               
            }
        }
        else{
            return redirect(url('/'));
        }
        
    }

    public function update(Request $request){
        if(Session::get('user')){
            $name = request('uname');
            $phn = request('wsphn');
            // $arabic_name = request('arabic_name');
            $agphn = request('phone');
            $email = session('user');
            $user = User::where('email', $email)->first();
            if($user){

                if(!empty($agphn)){
                    $user->embassy_man_name = $name;
                    $user->embassy_man_phone = $phn;
                    $user->phone = $agphn;
                    // $user->arabic_name = $arabic_name;
                }
                else{
                    $user->embassy_man_name = $name;
                    $user->embassy_man_phone = $phn;
                }
                
                if($user->save()){
                    return redirect()->route('user/index')->with('success', 'User created successfully');
    
                }
                else{
                    return response()->json([
                        'title'=> 'Error',
                        'success' => false,
                        'icon' => 'error',
                        'message' => 'Internal error',
                        
                    ]);
                }
            }
            else{
                return response()->json([
                    'title'=> 'Error',
                    'success' => false,
                    'icon' => 'error',
                    'message' => 'User Not Found ',
                    
                ]);
            }
        }
        else{
            return redirect(url('/'));
        }
        // dd($request->all());
        
    }  

    public function printer($id){
        if(Session::get('user')){
            $candidates = DB::table('candidates')
            ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
            ->select('candidates.*', 'visas.*')->where('candidates.id', '=', $id)
            ->get();
    
    
            $agencyemail = Session::get('user');
            $agency = User::select('*')->where('email', '=', $agencyemail)->get();
            // dd(1,$candidates, $agency);        
            return view('user.print', compact('id', 'candidates', 'agency'));
        }
        else{
            return redirect(url('/'));
        }
        
    }

    public function get(){
        if(Session::get('user')){
        $candidates = DB::table('candidates')
            ->where('is_delete', '=', 0)
            ->pluck('agency', 'passport_number');
        
        $users = DB::table('user')
            ->where('is_delete', '=', 0)
            ->select('licence_name', 'rl_no', 'email')
            ->get();
        
        $userData = [];
        
        foreach ($users as $user) {
            $userData[$user->email] = [
                'licence_name' => $user->licence_name,
                'rl_no' => $user->rl_no,
            ];
        }
        // dd($candidates);
        $data = [
            'candidates' => $candidates,
            'users' => $userData
        ];

        // Return the combined data as a JSON response
        return response()->json($data);
    }else{
        return redirect(url('/'));
    }
}

    public function visa_search($visa_no){
        if(Session::get('user')){
        $visa = Visa::where('visa_no', $visa_no)
            ->where('user', '=', Session::get('user'))
            ->first();

        if ($visa) {
            return response()->json($visa);
        } else {
            return response()->json(['message' => 'Visa not found']);
        }
        }else{
        return redirect(url('/'));
    }

    }
}
