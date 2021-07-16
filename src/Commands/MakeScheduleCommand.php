<?php
namespace Sparkinzy\LaravelScheduleCommand\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeScheduleCommand extends GeneratorCommand
{
    protected $signature = 'make:schedule-command {name}';
    protected function getStub()
    {
        return __DIR__.'/stubs/DummyScheduleCommand.stub';
    }
}