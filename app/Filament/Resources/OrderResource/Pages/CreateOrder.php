<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\OrderStatus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;
use App\Models\Customer;
use App\Filament\Resources\OrderResource;
use App\Mail\Order\ToShipMail;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $customer = Customer::find($this->data['customer_id']);
        $this->data['subtotal'] = array_reduce($this->data['items'], fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        $this->data['shipping_fee'] = $customer->customerAddress->shipping_fee;
        $this->data['status'] = OrderStatus::ToShip->value;
        $this->data['to_ship_at'] = now();

        $order = static::getModel()::create($this->data);
        $order->items()->createMany($this->data['items']);

        return $order;
    }

    protected function afterCreate(): void
    {
        Mail::to($this->record->customer->email)->send(new ToShipMail($this->record));
    }
}
