<?php

namespace App\Filament\Resources\Donations\Tables;

use App\Filament\Components\NotificationAction;
use App\Filament\Resources\UsersDonations\Pages\ListUsersDonations;
use App\Filament\Resources\UsersDonations\Tables\UsersDonationsTable;
use App\Services\UserService;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donorUser.name')
                    ->formatStateUsing(function($record){
                        if($record->donorUser->id === Auth::user()->id){
                            return 'Você';
                        }
                        else{
                            return $record->donorUser->name;
                        }
                    })
                    ->label('Doador'),
                    
                TextColumn::make('value')
                    ->label('Moedas'),

                TextColumn::make('reason')
                    ->label('Motivo'),

                TextColumn::make('doneeUser.name')
                    ->formatStateUsing(function($record){
                        if($record->doneeUser->id === Auth::user()->id){
                            return 'Você';
                        }
                        else{
                            return $record->doneeUser->name;
                        }
                    })                
                    ->label('Donatário'),

                TextColumn::make('created_at')
                    ->label('Data')
                    ->date('M/d/Y')
                    ->badge()
                    ->color('success')
                    ->sortable()
                    ->searchable()
                ])
                ->searchPlaceholder('Motivo')

            ->actions([

                ViewAction::make('view')
                   ->modalActions([
                        Action::make('viewLog')
                            ->label('Ver histórico do doador')
                            ->icon('heroicon-o-clock')
                            ->color('gray')
                            ->action(function ($record) {   
                                return redirect()->to(ListUsersDonations::getUrl( ['filters[users][value]' => $record->donor]));
                        }),
                    ])
                    ->color(Color::Amber)
                    ->infolist([
                        Section::make()
                            ->schema([
                                Grid::make(2)
                                ->schema([
                                    TextEntry::make('donorUser.name')
                                        ->label('Doador:'),
                                    
                                    TextEntry::make('value')
                                        ->label('Beecoins:'),

                                    TextEntry::make('reason')
                                        ->label('Motivo:'),

                                    TextEntry::make('doneeUser.name')
                                        ->label('Donatário: '),
                                    
                                    TextEntry::make('created_at')
                                        ->label('Data:')
                                        ->date('M/d/Y')
                                        ->badge()
                                        ->color('success'),
                                ]),
                                    NotificationAction::make('message'),
                            ]),    
                    ]),
                NotificationAction::make('message')
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('startDate')
                            ->label('Data inicial:')
                            ->prefixIcon(Heroicon::Calendar)
                            ->maxDate(now()),
                        
                        DatePicker::make('endDate')
                            ->label('Data final:')
                            ->prefixIcon(Heroicon::Calendar)
                            ->maxDate(now())

                    ])

                    ->query(function(Builder $query, array $data){
                        if(empty($data['startDate'] && $data['endDate'])){
                            return $query;
                        }
                        return $query->whereBetween('created_at',[$data['startDate'], $data['endDate']]);
                    })
            ]);
    }
}
