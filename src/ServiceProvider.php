<?php

namespace Sparkinzy\LaravelScheduleCommand;

use ReflectionClass;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Sparkinzy\LaravelScheduleCommand\Commands\ScheduleCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Console\Application as Artisan;
use Symfony\Component\Finder\Finder;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->loadCommands(app_path('Console/Commands'));
        Artisan::starting(function ($artisan) {
            collect($artisan->all())->each(function ($command) use ($artisan) {
                if ($command instanceof ScheduleCommand) {
                    $command->setApplication($artisan);
                    $this->app->call([$command, 'schedule']);
                }
            });
        });
    }

    protected function loadCommands($paths)
    {
        $paths = array_unique(Arr::wrap($paths));
        $paths = array_filter($paths, function ($path) {
            return is_dir($path);
        });
        if (empty($paths)) {
            return;
        }
        $namespace = $this->app->getNamespace();

        foreach ((new Finder)->in($paths)->files() as $command) {
            $command = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($command->getPathname(), realpath(app_path()) . DIRECTORY_SEPARATOR)
                );

            if (is_subclass_of($command, Command::class) &&
                !(new ReflectionClass($command))->isAbstract()) {
                Artisan::starting(function ($artisan) use ($command) {
                    $artisan->resolve($command);
                });
            }
        }
    }

}