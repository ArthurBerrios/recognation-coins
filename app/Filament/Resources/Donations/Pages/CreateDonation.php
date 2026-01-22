<?php

namespace App\Filament\Resources\Donations\Pages;

use App\Filament\Resources\Donations\DonationResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;

class CreateDonation extends CreateRecord
{
    protected static string $resource = DonationResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Doar beecoins';
    }
    public function getBreadcrumb(): string
    {
        return __('Doar'); 
    }
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Doar'),
            $this->getCancelFormAction()
        ];
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['donor'] = Auth::id(); 
        
        return $data;
    }
}
