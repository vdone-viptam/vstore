<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReportRequest;
use App\Services\Api\ReportService;

class ReportController extends Controller
{
    public function report(ReportRequest $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $data = ReportService::new()->report($startDate, $endDate);
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'data' => $data
        ]);
    }
}
