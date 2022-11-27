<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Service\Admin\ScheduleServiceInterface;

class ScheduleController extends Controller
{
    private $scheduleService;

    /**
     * Constructor function
     *
     * @param ScheduleServiceInterface $scheduleService
     */
    public function __construct(ScheduleServiceInterface $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function saveSchedule(Request $request)
    {
        $this->scheduleService->saveSchedule($request);
        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
