<?php

namespace App\Contracts\Service\Admin;

interface ScheduleServiceInterface {
    public function getDates($request);
    public function saveSchedule($request);
}
