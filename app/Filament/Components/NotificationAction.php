<?php
namespace App\Filament\Components;

use App\Services\UserService;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\Textarea;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class NotificationAction extends Action{

    public function setUp(): void
    {
        parent::setUp();

        $this
             ->icon(Heroicon::ChatBubbleOvalLeft)
                    ->label('Notificar grupo')
                    ->visible(fn($record) => $record->donor === Auth::id())
                    ->form([
                        Textarea::make('menssagem')
                                ->label('Mensagem:')
                                ->default(function($record){

                                    $userService = app(UserService::class);
                                    $donee = $userService->find($record->donee);

                                    return 'Olá, pessoal. Gostaria de doar ' . $record->value . ' beecoins para ' . $donee->name . ' pelo motivo de ' . $record->reason . '. Agradeço!';
                                })
                    ])
                    ->modalSubmitActionLabel('Enviar mensagem no grupo')
                    ->action(function(array $data){
                        $mensagem = $data['menssagem'];
                        $mensagemurl = urlencode($mensagem);

                        return redirect()->away('https://wa.me/?text=' . $mensagemurl);
                    });
    }
}