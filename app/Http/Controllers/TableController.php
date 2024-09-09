<?php
    
namespace App\Http\Controllers;

  
  use Illuminate\Http\Request;
  use App\Models\VisaRecord;
  use Illuminate\Support\Facades\Session;
  use Carbon\Carbon;  // For handling date
  use Illuminate\Support\Facades\View;

  
  class TableController extends Controller
  {
      public function saveTableData(Request $request)
      {
          $tableBodyData = $request->input('table_body');  // Retrieve table body data
          $tableCancelData = $request->input('table_cancel_body');  // Retrieve cancel table data
  
          $currentUser = Session::get('user');  // Get the currently authenticated user
          $currentDate = Carbon::now();  // Get the current date

        //   dd($currentDate, $currentUser, $tableBodyData, $tableCancelData); //
  
          // Save table body data
          foreach ($tableBodyData as $data) {
              VisaRecord::create([
                  'profession' => $data['profession'],
                  'year' => $data['year'],
                  'visa_number' => $data['visaNumber'],
                  'sponsor_name' => $data['sponsorName'],
                  'passport_no' => $data['passportNo'],
                //   'sl' => $data['sl'],
                  'is_cancelled' => false, 
                  'date' => $currentDate,  // Save the current date
                  'user' => $currentUser,  // Save the current user's ID
              ]);
          }
  
          // Save table cancel body data
          foreach ($tableCancelData as $data) {
              VisaRecord::create([
                  'profession' => $data['profession'],
                  'year' => $data['year'],
                  'visa_number' => $data['visaNumber'],
                  'sponsor_name' => $data['sponsorName'],
                  'passport_no' => $data['passportNo'],
                //   'sl' => $data['sl'],
                  'is_cancelled' => true,  // Set a flag for cancelled records
                  'date' => $currentDate,  // Save the current date
                  'user' => $currentUser,  // Save the current user's ID
              ]);
          }
  
          return response()->json(['message' => 'Data saved successfully!'], 200);
      }


      public function printReport(Request $request)
      {
          $date = $request->query('date');
  
          // Validate the date format
          if (!Carbon::createFromFormat('Y-m-d', $date, 'UTC')->isValid()) {
              return redirect()->back()->with('error', 'Invalid date format.');
          }
  
          $records = VisaRecord::whereDate('date', $date)
                  ->get();

          // dd($records);
  
          $view = View::make('user.embassy_list_report', compact('records', 'date'));
          return $view;
      }
}