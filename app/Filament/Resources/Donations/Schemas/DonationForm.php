<?php

namespace App\Filament\Resources\Donations\Schemas;

use App\Models\User;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {   
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Select::make('donee')
                            ->label('Para quem deseja doar?')
                            ->rules(['required'])
                            ->validationMessages([
                                'required' => 'Selecione para quem quer doar as beecoins.'
                            ])
                            ->options(function(){

                                $users = User::all();

                                $options = [];
                                foreach($users as $user){
                                    if($user['id'] === Auth::id()){
                                        continue;
                                    }
                                    $options += [
                                        $user['id'] => $user['name']
                                    ];
                                    
                                    }

                                return $options;
                            }),

                        TextInput::make('value')
                            ->label(function(){
                                $balance = Auth::user()->balance->value;

                                return 'Quantas beecoins deseja doar?' . ' Saldo: ' . $balance;
                            })
                            ->numeric()
                            ->rules(function(){
                                $balance = Auth::user()->balance->value;

                                return [
                                   'required', 
                                   'max:'. $balance,
                                ];
                            })
                            ->validationMessages([
                                'max' => 'Você não possui saldo!',
                                'required' => 'Digite quantas beecoins deseja doar.'
                            ]),
                        
                        Textarea::make('reason')
                            ->label('Escreva o motivo:')
                            ->rules(['required'])
                            ->validationMessages([
                                'required' => 'Digite o motivo.'
                            ])
                            ->columnSpanFull()
                        
                    ])
            ]);
    }
}
