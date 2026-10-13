<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['nullable', 'string', 'max:255'],
            'comment' => ['required', 'string', 'min:3', 'max:2000'],
            'customer_name' => [Auth::check() ? 'nullable' : 'required', 'string', 'max:100'],
            'customer_email' => ['nullable', 'email', 'max:150'],
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $customerName = Auth::check() ? Auth::user()->name : ($validated['customer_name'] ?? 'Anonymous Patron');
        $customerEmail = Auth::check() ? Auth::user()->email : ($validated['customer_email'] ?? null);

        $review = Review::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'rating' => $validated['rating'],
            'title' => $validated['title'] ?? null,
            'comment' => $validated['comment'],
            'is_approved' => true, // Approved immediately for customer feedback
            'is_verified_buyer' => Auth::check(),
        ]);

        if ($request->hasFile('images')) {
            $sort = 0;
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('reviews', 'public');
                    ReviewImage::create([
                        'review_id' => $review->id,
                        'image_path' => $path,
                        'sort_order' => $sort++,
                    ]);
                }
            }
        }

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Thank you for your review! Your experience has been posted.',
        ])->withFragment('reviews-section');
    }
}
