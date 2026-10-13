<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('manage-settings');

        $activeTab = $request->string('tab', 'general')->toString();

        $settings = [
            // General
            'site_name' => Setting::get('site_name', 'Modern Jewellery House'),
            'concierge_email' => Setting::get('concierge_email', 'concierge@modernjewelleryhouse.com'),
            'concierge_phone' => Setting::get('concierge_phone', '+1 (800) 492-9180'),
            'salon_address' => Setting::get('salon_address', 'Atelier 402, High Jewellery Enclave, Mumbai 400001, India'),
            
            // Store
            'currency_code' => Setting::get('currency_code', 'INR'),
            'currency_symbol' => Setting::get('currency_symbol', '₹'),
            'luxury_tax_rate' => Setting::get('luxury_tax_rate', '8.00'),
            'shipping_flat_rate' => Setting::get('shipping_flat_rate', '0.00'),
            
            // Payment (Razorpay)
            'razorpay_key_id' => Setting::get('razorpay_key_id', config('services.razorpay.key_id', 'rzp_test_luxuryhouse')),
            'razorpay_key_secret' => Setting::get('razorpay_key_secret', 'rzp_secret_sandbox_vault'),
            'razorpay_test_mode' => Setting::get('razorpay_test_mode', true),
            
            // SEO
            'meta_title' => Setting::get('meta_title', 'Modern Jewellery House | High Fine Jewellery Atelier'),
            'meta_description' => Setting::get('meta_description', 'Bespoke solitaires, diamond necklaces, and heirloom jewellery hand-crafted by master artisans.'),
            'social_image' => Setting::get('social_image', '/assets/images/hero-poster.jpg'),

            // Social
            'social_instagram' => Setting::get('social_instagram', 'https://instagram.com/modernjewelleryhouse'),
            'social_facebook' => Setting::get('social_facebook', 'https://facebook.com/modernjewelleryhouse'),
            'whatsapp_concierge' => Setting::get('whatsapp_concierge', '+919876543210'),

            // Email (SMTP)
            'smtp_host' => Setting::get('smtp_host', 'smtp.mailtrap.io'),
            'smtp_port' => Setting::get('smtp_port', '2525'),
            'smtp_username' => Setting::get('smtp_username', 'sandbox_user'),
            'smtp_encryption' => Setting::get('smtp_encryption', 'tls'),
            'mail_from_address' => Setting::get('mail_from_address', 'hello@modernjewelleryhouse.com'),
        ];

        return view('admin.settings.index', compact('settings', 'activeTab'));
    }

    public function update(Request $request): RedirectResponse
    {
        Gate::authorize('manage-settings');

        $tab = $request->string('tab', 'general')->toString();

        $updatableFields = [
            'site_name', 'concierge_email', 'concierge_phone', 'salon_address',
            'currency_code', 'currency_symbol', 'luxury_tax_rate', 'shipping_flat_rate',
            'razorpay_key_id', 'razorpay_key_secret', 'razorpay_test_mode',
            'meta_title', 'meta_description', 'social_image',
            'social_instagram', 'social_facebook', 'whatsapp_concierge',
            'smtp_host', 'smtp_port', 'smtp_username', 'smtp_encryption', 'mail_from_address'
        ];

        foreach ($updatableFields as $field) {
            if ($request->has($field)) {
                $val = $request->input($field);
                if ($field === 'razorpay_test_mode') {
                    $val = $request->boolean('razorpay_test_mode');
                }
                Setting::set($field, $val, $tab);
            }
        }

        AdminActivityLog::record("Updated system settings [Tab: {$tab}]");

        return redirect()->route('admin.settings.index', ['tab' => $tab])->with('toast', [
            'type' => 'success',
            'message' => 'Settings saved successfully.',
        ]);
    }

    public function sendTestEmail(Request $request): RedirectResponse
    {
        Gate::authorize('manage-settings');

        $recipient = $request->input('test_email', auth()->user()->email ?? 'admin@modernjewelleryhouse.com');

        try {
            \Illuminate\Support\Facades\Mail::raw('This is a test email sent from Modern Jewellery House Admin Settings.', function ($message) use ($recipient) {
                $message->to($recipient)->subject('Modern Jewellery House — SMTP Diagnostic Test');
            });
            $status = 'success';
            $msg = "Diagnostic test email dispatched to {$recipient}.";
        } catch (\Throwable $e) {
            $status = 'error';
            $msg = 'Failed to dispatch test email: ' . $e->getMessage();
        }

        AdminActivityLog::record("Dispatched SMTP test email to {$recipient} (Status: {$status})");

        return back()->with('toast', [
            'type' => $status,
            'message' => $msg,
        ]);
    }
}
