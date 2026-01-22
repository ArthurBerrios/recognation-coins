<?php

namespace App\Filament\Resources\MemberStatistics\Pages;

use App\Filament\Resources\MemberStatistics\MemberStatisticsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListMemberStatistics extends ListRecords
{
    protected static string $resource = MemberStatisticsResource::class;
    public function getTitle(): string|Htmlable
    {
        return 'Membros e suas estatísticas';
    }
}
