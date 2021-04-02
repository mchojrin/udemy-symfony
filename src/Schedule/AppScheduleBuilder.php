<?php


namespace App\Schedule;


use Zenstruck\ScheduleBundle\Schedule;

class AppScheduleBuilder implements \Zenstruck\ScheduleBundle\Schedule\ScheduleBuilder
{
    public function buildSchedule(Schedule $schedule): void
    {
        $schedule
            ->timezone('GMT-3')
            ->environments('prod')
            ;

        $schedule
            ->addCommand('app:remove-old-offers')
            ->description('Remove non interesting offers')
            ->daily()
            ->at(1)
            ;
    }
}