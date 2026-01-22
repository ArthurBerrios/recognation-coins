<?php

namespace App\Filament\Resources\UsersDonations\Tables;

use App\Filament\Components\NotificationAction;
use App\Services\UserService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

use function Laravel\Prompts\form;

class UsersDonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        TextColumn::make('donorUser.name')
                        ->formatStateUsing(function($record){
                            if($record->donorUser->id === Auth::user()->id){
                                return 'Você';
                            }
                            else{
                                return $record->donorUser->name;
                            }
                        })
                        ->label('Doador')
                        ->icon(Heroicon::UserMinus)
                        ->color('danger')
                        ->badge(),

                        TextColumn::make('value')
                            ->label('Beecoins')
                            ->icon(Heroicon::CurrencyDollar)
                            ->color('danger')
                            ->badge()
                            ->state(fn($record) => '-' . $record->value),

                        TextColumn::make('reason')
                            ->label('Motivo')
                            ->icon(Heroicon::ChatBubbleBottomCenter)
                            ->color(Color::Amber),

                    ]),
                    Stack::make([
                        TextColumn::make('doneeUser.name')
                            ->formatStateUsing(function($record){
                                if($record->doneeUser->id === Auth::user()->id){
                                    return 'Você';
                                }
                                else{
                                    return $record->doneeUser->name;
                                }
                            })                
                            ->label('Donatário')
                            ->icon(Heroicon::UserPlus)
                            ->color('success')
                            ->badge(),

                        TextColumn::make('value')
                            ->label('Beecoins')
                            ->icon(Heroicon::CurrencyDollar)
                            ->badge()
                            ->color('success')
                            ->state(fn($record) => '+' . $record->value),
                        
                        TextColumn::make('created_at')
                            ->label('Data')
                            ->date('d/M/Y')
                            ->color(Color::Amber)
                            ->sortable()
                            ->searchable()
                            ->icon(Heroicon::Calendar),
                    ])
                ])
            ])
            ->filters([
  
                SelectFilter::make('users')
                    ->options(function(){
                        $userService = app(UserService::class);
                        $users = $userService->allUsers();
                        
                        $members = [];
                        foreach($users as $user){
                            if($user->id === Auth::user()->id){
                                $members[$user->id] = "Você";                                    
                            }else{
                            $members[$user->id] = $user->name;
                            }

                        }

                        return $members;
                        
                })
                ->columnSpanFull()
                ->label('Selecione para ver o usuário')
                ->default(fn() => Auth::user()->id)         
                ->query(function(Builder $query, $value){
                    if(empty($value)){
                        return $query->where('donor', '=', Auth::user()->id)
                            ->orWhere('donee','=',Auth::user()->id);
                    }
                    else{
                        return $query->where('donor', '=', $value);
                    }
                }),
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
                    ->columns(2)
                    ->query(function(Builder $query, array $data){
                        if(empty($data['startDate'] && $data['endDate'])){
                            return $query;
                        }
                        return $query->whereBetween('created_at',[$data['startDate'], $data['endDate']]);
                    })->columnSpanFull()

             ], FiltersLayout::AboveContent)->filtersFormColumns(2)
            ->hiddenFilterIndicators()
            ->actions([
                NotificationAction::make('message')
            ]);
    }
}
