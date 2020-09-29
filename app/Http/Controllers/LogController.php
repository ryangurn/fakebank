<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;

/**
 * Class LogController
 * @package App\Http\Controllers
 */
class LogController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index() {
        $logs = Activity::orderBy('created_at', 'desc')->paginate(15);
        $statistics = [];

        foreach($logs->pluck('log_name')->unique() as $item) {
            $statistics[$item] = Activity::where('log_name', $item)->get()->count();
        }

        return view('logs.index', compact('logs', 'statistics'));
    }
}
