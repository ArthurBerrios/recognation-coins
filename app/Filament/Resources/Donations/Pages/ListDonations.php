<?php

namespace App\Filament\Resources\Donations\Pages;

use App\Filament\Resources\Donations\DonationResource;
use App\Filament\Resources\Donations\Widgets\DonationStats;
use App\Models\Donation;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Contracts\Support\Htmlable;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Doar moedas'),
        ];
    }
    public function getTitle(): string|Htmlable
    {
        return 'Doações';
    }
    protected function getHeaderWidgets(): array 
    {
        return [
            DonationStats::class,
        ];
    }
}
