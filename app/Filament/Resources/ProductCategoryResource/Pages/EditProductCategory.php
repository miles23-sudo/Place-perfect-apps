<?php

namespace App\Filament\Resources\ProductCategoryResource\Pages;

use App\Filament\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCategory extends EditRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getGoBackAction(),
        ];
    }

    // Custom Actions

    // Go Back Action
    public function getGoBackAction(): Actions\Action
    {
        return Actions\Action::make('goBack')
            ->label('Go Back')
            ->icon('heroicon-o-arrow-left')
            ->url(self::getResource()::getUrl());
    }
}
