<?php

namespace App\Filament\Resources\UsersDonations;

use App\Filament\Resources\UsersDonations\Pages\CreateUsersDonation;
use App\Filament\Resources\UsersDonations\Pages\EditUsersDonation;
use App\Filament\Resources\UsersDonations\Pages\ListUsersDonations;
use App\Filament\Resources\UsersDonations\Schemas\UsersDonationForm;
use App\Filament\Resources\UsersDonations\Tables\UsersDonationsTable;
use App\Models\Donation;
use App\Models\UsersDonation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UsersDonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

    protected static ?string $recordTitleAttribute = 'Membros';
    protected static ?string $navigationLabel = 'Movimentações dos membros'; 

    public static function form(Schema $schema): Schema
    {
        return UsersDonationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersDonationsTable::configure($table);
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
            'index' => ListUsersDonations::route('/')
        ];
    }
}
