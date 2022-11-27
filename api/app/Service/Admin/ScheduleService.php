<?php

namespace App\Service\Admin;

use App\Contracts\Service\Admin\ScheduleServiceInterface;
use App\Contracts\Dao\Admin\ScheduleDaoInterface;
use DB;

class ScheduleService implements ScheduleServiceInterface {
    protected $scheduleDao;

    public function __construct(ScheduleDaoInterface $scheduleDao)
    {
        $this->scheduleDao = $scheduleDao;
    }

    public function saveSchedule($request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->all() as $value) {
                $dateAttributes = [
                    'day' => $value['date']['day'],
                    'month' => $value['month'],
                    'year' => $value['year'],
                    'type' => $value['date']['type'],
                ];
                $date = $this->scheduleDao->saveDate($dateAttributes);

                $scheduleTimes = $value['date']['schedule_times'];
                foreach ($scheduleTimes as $time) {
                    $scheduleAttributes = [
                        'date_id' => $date->id,
                        'start_time' => $time['start_time'],
                        'end_time' => $time['end_time'],
                    ];
                    $this->scheduleDao->saveSchedule($scheduleAttributes);
                }
            }
        });
    }
}
