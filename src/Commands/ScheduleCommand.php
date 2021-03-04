<?php
namespace Sparkinzy\Commands;
use Illuminate\Console\Command as BaseCommand;
use Illuminate\Console\Scheduling\Schedule;


abstract class ScheduleCommand extends BaseCommand
{
    public function schedule(Schedule $schedule)
    {
        // TODO: Change the schedule
    }

    public function setLaravel($laravel)
    {
        parent::setLaravel($this->app = $laravel);
    }

    public function call($command, array $arguments = [])
    {
        return parent::call($command, $arguments);
    }
}