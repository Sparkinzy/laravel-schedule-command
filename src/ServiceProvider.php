<?php
namespace Sparkinzy\LaravelScheduleCommand;
use Sparkinzy\LaravelScheduleCommand\Commands\ScheduleCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Console\Application as Artisan;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        Artisan::starting(function($artisan){
            collect($artisan->all())->each(function($command)use($artisan){
                if ($command instanceof ScheduleCommand){
                    $command->setApplication($artisan);
                    $this->app->call([$command,'schedule']);
                }
            });
        });
    }

}