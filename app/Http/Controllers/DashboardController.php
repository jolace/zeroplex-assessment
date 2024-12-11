<?php

namespace App\Http\Controllers;

use App\Enums\Task\StatusEnum;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $statusFilter = StatusEnum::cases();

        return view('dashboard', compact('statusFilter'));
    }
}
