<?php

namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

/**
 * 查询日志输出
 *
 * @package app.Listeners
 */
class QueryLogTrackerListener
{
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