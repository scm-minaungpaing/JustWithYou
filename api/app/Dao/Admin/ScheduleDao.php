<?php

namespace App\Dao\Admin;

use App\Contracts\Dao\Admin\ScheduleDaoInterface;
use App\Models\Date;
use App\Models\Schedule;

class ScheduleDao implements ScheduleDaoInterface
{
    public function saveDate($attributes)
    {
        return Date::create($attributes);
    }

    public function saveSchedule($attributes)
    {
        Schedule::create($attributes);
    }
}
