<?php

namespace App\Livewire\Customer;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Order;
use App\Models\Review as ReviewModel;

class Review extends Component
{
    public $order_id;

    public $rating = [];

    public $review = [];

    public function mount()
    {
        $existingReviews = $this->getOrder->reviews->keyBy('product_id');
        
        $this->getOrder->items->each(function ($item) use ($existingReviews) {
            $productId = $item->product->id;
            if ($existingReviews->has($productId)) {
                $this->rating[$productId] = $existingReviews->get($productId)->rating;
                $this->review[$productId] = $existingReviews->get($productId)->review;
            } else {
                $this->rating[$productId] = 5; // Default rating
                $this->review[$productId] = ''; // Default review
            }
        });
    }

    protected function rules()
    {
        $rules = [];

        // Generate validation rules for each product in the order
        foreach ($this->getOrder->items as $item) {
            $productId = $item->product->id;
            $rules["rating.{$productId}"] = 'required|integer|between:1,5';
            $rules["review.{$productId}"] = 'required|string|min:10|max:1000';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'rating.*.required' => 'Please provide a rating for each product.',
            'rating.*.between' => 'Rating must be between 1 and 5 stars.',
            'review.*.required' => 'Please provide a review for each product.',
            'review.*.min' => 'Review must be at least 10 characters.',
            'review.*.max' => 'Review must not exceed 1000 characters.',
        ];
    }

    public function submitReview($productId)
    {
        $data = $this->validate([
            "rating.{$productId}" => 'required|integer|between:1,5',
            "review.{$productId}" => 'required|string|min:10|max:1000'
        ]);

        ReviewModel::updateOrCreate([
            'customer_id' => auth('customer')->id(),
            'product_id' => $productId,
            'order_id' => $this->order_id,
        ], [
            'rating' => $data["rating"][$productId],
            'review' => $data["review"][$productId],
        ]);

        notyf('Your review has been submitted successfully. Thank you for helping us improve!');
    }

    #[Computed]
    public function getOrder()
    {
        return Order::whereCustomerId(auth('customer')->id())->findOrFail($this->order_id);
    }

    public function productAlreadyReviewed($productId)
    {
        return auth('customer')->user()->reviews()->where('product_id', $productId)->where('order_id', $this->order_id)->exists();
    }

    public function render()
    {
        return view('livewire.customer.review');
    }
}
