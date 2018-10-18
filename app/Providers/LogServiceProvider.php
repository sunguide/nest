<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  illuminate.query  $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        if($event->sql){
            // 把sql  的日志独立分开
            $fileName = storage_path('logs/sql/'.date('Y-m-d').'.log');
            Log::useFiles($fileName,'info');
            $sql = str_replace("?", "'%s'", $event->sql);
            $log = vsprintf($sql, $event->bindings);
            Log::info($log);
        }
    }


}
