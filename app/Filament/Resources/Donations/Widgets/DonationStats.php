<?php   

namespace App\Filament\Resources\Donations\Widgets;

use App\Filament\Resources\Donations\Pages\ListDonations;
use App\Models\Balance;
use App\Models\Donation;
use App\Services\BalanceService;
use App\Services\DonationService;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class DonationStats extends StatsOverviewWidget
{
    use InteractsWithPageTable;

    public array $tableColumnSearches = [];

    protected function getTablePage(): string
    {
        return ListDonations::class;
    }
    protected function getStats(): array
    {
        $balanceService = app(BalanceService::class);
        $donationService = app(DonationService::class);
        
        $totalDonations = $donationService->totalDonations();

        $largetsDonor = $donationService->largestDonor();
        
        $moreBalance = $balanceService->moreBalance();

        $userMoreBalance = $balanceService->userMoreBalance();
    
        
        return [
            Stat::make('Total de doações:', $totalDonations ?? ''),
            Stat::make('Maior doador:',$largetsDonor->name ?? '' ),
            Stat::make('Maior saldo: ' . $moreBalance->value ?? '' , $userMoreBalance->name ?? ''),

        ];
    }
}