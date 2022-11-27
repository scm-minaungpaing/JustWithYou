<?php

namespace App\Contracts\Dao\Admin;

interface ScheduleDaoInterface {
    public function saveDate($attributes);

    public function saveSchedule($scheduleAttributes);
}
