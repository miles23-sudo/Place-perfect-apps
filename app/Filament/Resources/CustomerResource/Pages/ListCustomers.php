<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Illuminate\Support\Str;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
use App\Filament\Resources\CustomerResource;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCreateAction()
        ];
    }

    // Action

    // Create Action
    public function getCreateAction(): Actions\CreateAction
    {
        $raw_password = Str::random(10);

        return Actions\CreateAction::make()
            ->icon('ri-add-line')
            ->mutateFormDataUsing(function ($data) use ($raw_password) {
                $data['password'] = bcrypt($raw_password);
                $data['is_primary'] = true;

                return $data;
            })
            ->after(function ($record) use ($raw_password) {
                // TODO: Send email to the customer with the raw password
                // Mail::to($record->email)->send(new CustomerCreated($record, $raw_password));
            })
            ->modalWidth(MaxWidth::Large)
            ->closeModalByClickingAway(false);
    }
}
