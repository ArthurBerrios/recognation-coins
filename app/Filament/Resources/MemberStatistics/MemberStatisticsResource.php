<?php

namespace App\Filament\Resources\MemberStatistics;

use App\Filament\Resources\MemberStatistics\Pages\ListMemberStatistics;
use App\Filament\Resources\MemberStatistics\Pages\ViewMemberStatistics;
use App\Filament\Resources\MemberStatistics\Schemas\MemberStatisticsForm;
use App\Filament\Resources\MemberStatistics\Tables\MemberStatisticsTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MemberStatisticsResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChartBar;
    protected static ?string $navigationLabel = 'Estatísticas dos membros'; 
    public static function form(Schema $schema): Schema
    {
        return MemberStatisticsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberStatisticsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMemberStatistics::route('/'),
            'view' => ViewMemberStatistics::route('/{record}/view')
        ];
    }
}
