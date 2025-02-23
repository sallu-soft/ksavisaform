<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Agents;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('*', function ($view) {
            if (Session::get('user')) {
                $maxSlNumber = DB::table('candidates')
                    ->where('agency', '=', Session::get('user'))
                    ->where('is_delete', 0)
                    ->max('sl_number');
        
                $agentsform = DB::table('agents')
                    ->select('*')
                    ->where('user', '=', Session::get('user'))
                    ->where('is_delete', '=', 0)
                    ->get();
        
                $agents = DB::table('agents')
                    ->select('*')
                    ->where('user', '=', Session::get('user'))
                    ->where('is_delete', '=', 0)
                    ->paginate(10);
        
                $query = DB::table('candidates')
                    ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                    ->leftJoin('manpower', 'candidates.id', '=', 'manpower.candidate_id')
                    ->select(
                        'candidates.*',
                        'visas.visa_no',
                        'visas.mofa_no',
                        'visas.spon_id',
                        'visas.prof_name_english',
                        'manpower.visa_issued_date',
                        'manpower.visa_exp_date'
                    )
                    ->where('candidates.agency', '=', Session::get('user'))
                    ->where('candidates.is_delete', 0)
                    ->orderBy('candidates.created_at', 'desc');
        
                $candidates = $query->paginate(10);
                $totalCount = $candidates->total();
                $startNumber = $totalCount - (($candidates->currentPage() - 1) * $candidates->perPage());
        
                foreach ($candidates as $candidate) {
                    $candidate->agent = DB::table('agents')->where('id', $candidate->agent)->value('agent_name');
                    $candidate->serial_number = $startNumber--;
                }

                $candidates_manpower = DB::table('candidates')
                ->leftJoin('manpower', 'candidates.id', '=', 'manpower.candidate_id')
                ->leftJoin('visas', 'candidates.id', '=', 'visas.candidate_id')
                ->select('candidates.*', 'manpower.*', 'visas.spon_name_english')
                ->where('candidates.agency', '=', Session::get('user'))
                ->get();
        
                $user = DB::table('user')->select('*')->where('email', '=', Session::get('user'))->first();
        
                // Pass all variables to the view
                $view->with([
                    'maxSlNumber' => $maxSlNumber,
                    'agentsform' => $agentsform,
                    'agents' => $agents,
                    'candidates' => $candidates,
                    'candidates_manpower' => $candidates_manpower,
                    'totalCount' => $totalCount,
                    'startNumber' => $startNumber,
                    'user' => $user,
                ]);
            }
        });
        
    }
}
