<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Login;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class LoginsChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $data = [
            Login::whereBetween('created_at', [now()->subHours(3), now()->subHours(2)])->count(),
            Login::whereBetween('created_at', [now()->subHours(2), now()->subHour()])->count(),
            Login::whereBetween('created_at', [now()->subHour(), now()])->count(),
        ];

        return Chartisan::build()
            ->labels(['Two Hours Ago', 'One Hour Ago', 'This Hour'])
            ->dataset('Logins', $data);
    }
}
