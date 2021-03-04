<h1 align="center"> laravel-schedule-command </h1>

<p align="center"> 命令中直接定义定时任务，避免Kernel中大量定义定时任务.</p>


## Installing

```shell
$ composer require sparkinzy/laravel-schedule-command -vvv
```

## Usage

参考示例如下

```php 
# 文件 app/Console/Commands/TestCommand.php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Sparkinzy\LaravelScheduleCommand\Commands\ScheduleCommand;

class AdvertAutoDelete extends ScheduleCommand
{
/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:schedule';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试命令自带定时任务配置';
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    
    }

    /**
     * @param Schedule $schedule
     * 此命令每分钟执行一次
     */
    public function schedule(Schedule $schedule)
    {
        #$schedule->command(static::class)
        #            ->everyMinute()
        #            ->runInBackground();
        # 定时任务执行时带参数
        $schedule->command(static::class,['param1'=>'1'])
                            ->everyMinute()
                            ->runInBackground();
    }
}

```
安装后，修改命令重新继承 sparkinzy\LaravelScheduleCommand\Commands\ScheduleCommand

并在命令中新增function schedule(Schedule $schedule){

}



## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/sparkinzy/laravel-schedule-plus/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/sparkinzy/laravel-schedule-plus/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT