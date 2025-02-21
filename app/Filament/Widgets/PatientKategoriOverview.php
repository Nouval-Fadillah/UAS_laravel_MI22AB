<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientKategoriOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kategori', \App\Models\Kategori::count()),
            Stat::make('Total Produk', \App\Models\Produk::count()),
            Stat::make('Total User', \App\Models\User::count()),
        ];
    }
}
