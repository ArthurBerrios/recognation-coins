<?php

namespace App\Filament\Resources\MemberStatistics\Tables;

use App\Filament\Resources\MemberStatistics\Pages\ViewMemberStatistics;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MemberStatisticsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    TextColumn::make('name')
                        ->weight(FontWeight::Bold),

                    TextColumn::make('email')
                ])
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->recordActions([
                Action::make('view')
                    ->url(fn ($record): string => ViewMemberStatistics::getUrl(['record' => $record->id]))
                    ->icon(Heroicon::ChartBarSquare)
                    ->label('Ver estatísticas'),
            ]);
    }
}
