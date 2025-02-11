<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\VisaRecord;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;  // For handling date
use Illuminate\Support\Facades\DB;
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

    public function deleteByDate($date)
    {
        if (Session::has('user')) {
            $userEmail = Session::get('user');

            // Delete records for the specified date and user
            DB::table('visa_record')
                ->whereDate('date', $date)
                ->where('user', $userEmail)
                ->delete();

            // Redirect back with success message
            return redirect()->route('user/index')->with('success', 'Records deleted successfully.');
        } else {
            return redirect(url('/'));
        }
    }
    public function printReport(Request $request)
    {
        $date = $request->query('date');

        $user = Session::get('user');

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Validate the date format
        try {
            $parsedDate = Carbon::createFromFormat('Y-m-d', $date, 'UTC');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid date format.');
        }

        $records = VisaRecord::where('user', $user) // Filter by user_id
            ->whereDate('date', $date) // Filter by date
            ->get();

        // dd($records);

        $view = View::make('user.embassy_list_report', compact('records', 'user', 'date'));
        return $view;
    }
    public function withAgentReport(Request $request)
    {
        $date = $request->query('date');
        $user = Session::get('user');
        // If the user is not found, redirect with an error
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Validate the date format
        try {
            $parsedDate = Carbon::createFromFormat('Y-m-d', $date, 'UTC');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid date format.');
        }

        // Fetch the records associated with the authenticated user and the provided date
        // $records = VisaRecord::where('user', $user) // Filter by user_id
        //             ->whereDate('date', $date) // Filter by date
        //             ->get();

        $records = VisaRecord::select('visa_record.*', 'agents.agent_name as agent_name')
        ->join('candidates', 'visa_record.passport_no', '=', 'candidates.passport_number')
        ->leftJoin('agents', 'candidates.agent', '=', 'agents.id')
        ->where('visa_record.user', $user)
        ->whereDate('visa_record.date', $date)
        ->get();

        // dd($records);
        $view = View::make('user.embassy_list_agentReport', compact('records', 'date'));
        return $view;
    }
}
