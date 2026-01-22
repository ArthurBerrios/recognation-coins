<?php
namespace App\Filament\Resources\MemberStatistics\Pages;

use App\Filament\Resources\MemberStatistics\MemberStatisticsResource;
use App\Services\UserService;
use Dom\Text;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

class ViewMemberStatistics extends ViewRecord{
    protected static string $resource = MemberStatisticsResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->name;
    }
    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Flex::make([
                            Grid::make(2)
                                ->schema([
                                    Group::make([    

                                        TextEntry::make('lastDonationSent.created_at')
                                            ->label('Última doação feita : ')
                                            ->dateTime('d/M/Y')
                                            ->icon(Heroicon::Calendar)
                                            ->color(Color::Amber),
                                        
                                        TextEntry::make('lastDonationSent.reason')
                                            ->label('Motivo:')
                                            ->icon(Heroicon::ChatBubbleBottomCenter)
                                            ->color(Color::Amber),
                                    ]),
                                    Group::make([

                                        TextEntry::make('lastDonationReceived.created_at')
                                            ->label('Última doação recebida : ')
                                            ->dateTime('d/M/Y')
                                            ->icon(Heroicon::Calendar)
                                            ->color(Color::Amber),
                                        
                                        TextEntry::make('lastDonationReceived.reason')
                                            ->label('Motivo:')
                                            ->color(Color::Amber)
                                            ->icon(Heroicon::ChatBubbleBottomCenter),
                                    ])
                                ])
                        ])
                    ]),
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Group::make([
                                    TextEntry::make('sent')
                                        ->state(fn($record) => app(UserService::class)->sent($record->id))
                                        ->label('Doações feitas:')
                                        ->icon(Heroicon::Check)
                                        ->color(Color::Amber),

                                    TextEntry::make('received')
                                        ->state(fn($record) => app(UserService::class)->received($record->id))
                                        ->label('Doações recebidas:')
                                        ->icon(Heroicon::Check)
                                        ->color(Color::Amber),
                                ]),
                                Group::make([
                                    TextEntry::make('balance.value')
                                        ->label('Saldo')
                                        ->icon(Heroicon::CurrencyDollar)
                                        ->badge()
                                        ->color('success')
,

                                    TextEntry::make('avg')
                                        ->state(fn($record) => app(UserService::class)->avgDonationReceived($record->id))
                                        ->icon(Heroicon::CurrencyDollar)
                                        ->label('Média de moedas nas doações feitas:')
                                        ->badge()
                                        ->color(Color::Amber),
                                ])                   
                            ])
                    ])->collapsible()  
            ]);
    }
}