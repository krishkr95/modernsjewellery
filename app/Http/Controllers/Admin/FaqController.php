<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::orderBy('sort_order')->latest()->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $faq = Faq::create([
            ...$validated,
            'is_active' => $request->boolean('is_active', true),
        ]);

        AdminActivityLog::record("Created FAQ '{$faq->question}'", $faq);

        return back()->with('toast', ['type' => 'success', 'message' => 'FAQ entry added.']);
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $faq->update([
            ...$validated,
            'is_active' => $request->boolean('is_active', true),
        ]);

        AdminActivityLog::record("Updated FAQ '{$faq->question}'", $faq);

        return back()->with('toast', ['type' => 'success', 'message' => 'FAQ updated.']);
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();
        return back()->with('toast', ['type' => 'success', 'message' => 'FAQ deleted.']);
    }
}
