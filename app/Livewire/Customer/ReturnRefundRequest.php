<?php

namespace App\Livewire\Customer;

use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Mail\Order\ReturnRefundMail;
use App\Enums\OrderStatus;

class ReturnRefundRequest extends Component
{
    use WithFileUploads;
    public $order_id;

    public $return_reason, $return_photos = [];

    public function mount()
    {
        abort_if(!$this->order->isReturnRefundable(), 403);
    }

    public function rules()
    {
        return [
            'return_reason' => 'required|string|max:1000',
            'return_photos' => 'required|array|max:5',
            'return_photos.*' => 'image|max:10248|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'return_photos.*.image' => 'Each photo must be an image.',
            'return_photos.*.max' => 'Each photo may not be greater than 10MB.',
        ];
    }

    public function submitRequest()
    {
        $this->validate();

        $stored_photos = [];
        foreach ($this->return_photos as $photo) {
            $stored_photos[] = $photo->store(path: 'return_photos');
        }

        $data = [
            'return_reason' => $this->return_reason,
            'return_photos' => $stored_photos,
            'status' => OrderStatus::ReturnRefund,
            'return_refund_at' => now()
        ];

        $this->order->update($data);

        Mail::to($this->order->customer->email)->send(new ReturnRefundMail($this->order));

        notyf('Sorry to hear that. Your return/refund request has been submitted.');

        return $this->redirect(route('customer.order'));
    }

    public function getOrderProperty()
    {
        return auth('customer')->user()->orders()
            ->findOrFail($this->order_id);
    }

    public function render()
    {
        return view('livewire.customer.return-refund-request');
    }
}
