<?php

use Illuminate\Support\Facades\Schedule;

Schedule::call(function (Schedule $schedule) {
    $schedule->command('tasks:send-due-notifications');
})->daily();
