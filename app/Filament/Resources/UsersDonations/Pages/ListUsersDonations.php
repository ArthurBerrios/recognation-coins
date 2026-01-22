<?php

namespace App\Filament\Resources\UsersDonations\Pages;

use App\Filament\Resources\UsersDonations\UsersDonationResource;
use App\Filament\Resources\UsersDonations\Widgets\UsersDonationsStats;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class ListUsersDonations extends ListRecords
{
    protected static string $resource = UsersDonationResource::class;
    public function getTabs(): array
    {
        return[
            null => Tab::make('Todos'),
            'sent' => Tab::make('Enviados')->query(fn($query) => $query->where('donor', '=' ,   $this->getTableFilterState('users'))),
            'received' => Tab::make('Recebidos')->query(fn($query) => $query->where('donee','=',   $this->getTableFilterState('users')))
        ];
    }
    public function getTitle(): string|Htmlable
    {
        return 'Movimentações dos membros';
    }
}
