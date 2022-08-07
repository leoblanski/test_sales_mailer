<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function getJobs(Request $request) {
        $failed = $request->only('failed');
        
        $response = DB::table($failed ? 'failed_jobs' : 'jobs')->get()->toArray();

        return response()->json($response);
    }
}
