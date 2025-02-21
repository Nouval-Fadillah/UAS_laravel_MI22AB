<?php

namespace App\Filament\Resources\KategoriResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Kategori extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kategori', \App\Models\Kategori::count()),
            Stat::make('Total Produk', \App\Models\Produk::count()),
        ];
    }
}
