<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OrdersChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Orders status';

    protected function getData(): array
    {
        $data = Order::query()
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => array_values($data),
                ]
            ],
            'labels' => OrderStatusEnum::cases()
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
