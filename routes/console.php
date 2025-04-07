<?php

use App\Enums\TaskStatus;
use App\Jobs\SendTaskReminder;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $tasks = Task::query()->where(
        'mail_sent', false
    )
    ->where('status', '!=', TaskStatus::DONE)
    ->where('deadline', '<=', Carbon::now()->addDays())->get();
    foreach ($tasks as $task) {
        $task->update(['mail_sent' => true]);
        SendTaskReminder::dispatch($task);
    }
    // TODO: Zmienić w razie testowania
})->daily();
