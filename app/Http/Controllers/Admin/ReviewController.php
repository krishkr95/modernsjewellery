<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $query = Review::with(['product.primaryImage', 'user', 'images'])->latest();

        if ($request->filled('status')) {
            $st = $request->string('status');
            if ($st === 'pending') {
                $query->where('is_approved', false);
            } elseif ($st === 'approved') {
                $query->where('is_approved', true);
            } elseif ($st === 'with_images') {
                $query->has('images');
            } elseif ($st === 'featured') {
                $query->where('is_featured', true);
            }
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->integer('rating'));
        }

        if ($request->filled('search')) {
            $s = '%' . $request->string('search') . '%';
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', $s)
                  ->orWhere('comment', 'like', $s)
                  ->orWhere('customer_name', 'like', $s)
                  ->orWhere('customer_email', 'like', $s)
                  ->orWhereHas('user', fn($uq) => $uq->where('name', 'like', $s)->orWhere('email', 'like', $s))
                  ->orWhereHas('product', fn($pq) => $pq->where('name', 'like', $s)->orWhere('sku', 'like', $s));
            });
        }

        $reviews = $query->paginate(12)->withQueryString();
        
        // Comprehensive KPI metrics
        $totalCount = Review::count();
        $pendingCount = Review::where('is_approved', false)->count();
        $approvedCount = Review::where('is_approved', true)->count();
        $featuredCount = Review::where('is_featured', true)->count();
        $withImagesCount = Review::has('images')->count();
        $totalImagesCount = ReviewImage::count();
        $averageRating = Review::avg('rating') ? number_format((float)Review::avg('rating'), 1) : '5.0';

        // Customer uploaded imagery collection for dedicated imagery moderation tab
        $customerImages = ReviewImage::with(['review.product', 'review.user'])->latest()->paginate(24, ['*'], 'img_page');

        return view('admin.reviews.index', compact(
            'reviews', 
            'pendingCount', 
            'approvedCount', 
            'featuredCount', 
            'totalCount', 
            'withImagesCount', 
            'totalImagesCount', 
            'averageRating',
            'customerImages'
        ));
    }

    public function approve(Review $review): RedirectResponse
    {
        $review->update([
            'is_approved' => true,
            'approved_by' => auth()->id(),
        ]);

        AdminActivityLog::record("Approved review #{$review->id} for '{$review->product?->name}'", $review);

        return back()->with('toast', ['type' => 'success', 'message' => 'Review approved for public showcase.']);
    }

    public function reject(Review $review): RedirectResponse
    {
        $review->update([
            'is_approved' => false,
            'approved_by' => null,
        ]);

        AdminActivityLog::record("Unapproved review #{$review->id}", $review);

        return back()->with('toast', ['type' => 'success', 'message' => 'Review unapproved.']);
    }

    public function toggleFeature(Review $review): RedirectResponse
    {
        $review->update(['is_featured' => !$review->is_featured]);

        return back()->with('toast', ['type' => 'success', 'message' => 'Review feature status updated.']);
    }

    public function destroy(Review $review): RedirectResponse
    {
        foreach ($review->images as $img) {
            if ($img->image_path && Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
            $img->delete();
        }

        $review->delete();
        AdminActivityLog::record("Deleted review #{$review->id}");

        return back()->with('toast', ['type' => 'success', 'message' => 'Review and its images deleted successfully.']);
    }

    public function destroyImage(ReviewImage $image): RedirectResponse
    {
        $reviewId = $image->review_id;
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();

        AdminActivityLog::record("Deleted image #{$image->id} from review #{$reviewId}");

        return back()->with('toast', ['type' => 'success', 'message' => 'Review image deleted successfully.']);
    }
}
