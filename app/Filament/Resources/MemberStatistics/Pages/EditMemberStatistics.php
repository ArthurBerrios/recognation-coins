<?php

namespace App\Filament\Resources\MemberStatistics\Pages;

use App\Filament\Resources\MemberStatistics\MemberStatisticsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemberStatistics extends EditRecord
{
    protected static string $resource = MemberStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
