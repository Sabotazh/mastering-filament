<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ProductsChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Products per month';

    protected function getData(): array
    {
        $data = $this->getProductsPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Products',
                    'data' => $data['productsPerMonth']
                ]
            ],
            'labels' => $data['months']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getProductsPerMonth(): array
    {
        $now = Carbon::now();

        $productsPerMonth = [];
        $months = collect(range(1, 12))->map(function ($month) use ($now, &$productsPerMonth) {
            $count = Product::query()
                ->whereMonth('published_at', Carbon::parse($now->month($month)->format('Y-m')))
                ->count();
            $productsPerMonth[] = $count;

            return $now->month($month)->format('M');
        })->toArray();

        return [
            'productsPerMonth' => $productsPerMonth,
            'months' => $months,
        ];
    }
}
