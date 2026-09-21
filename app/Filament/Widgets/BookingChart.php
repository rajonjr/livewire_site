<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Booking;
use Illuminate\Support\Carbon;

class BookingChart extends ChartWidget
{
    // protected ?string $heading = 'Booking Chart';

    protected ?string $heading = 'Évolution des réservations (7 derniers jours)';
    protected static ?int $sort = 2;
    protected string $color = 'info';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $days = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days[] = $date->translatedFormat('D d M');
            $counts[] = Booking::whereDate('created_at', $date->format('Y-m-d'))->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Réservations créées',
                    'data' => $counts,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                    'fill' => true,
                ],
            ],
            'labels' => $days,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
