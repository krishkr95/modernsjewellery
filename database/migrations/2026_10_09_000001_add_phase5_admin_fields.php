<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('reviews') && !Schema::hasColumn('reviews', 'is_featured')) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->boolean('is_featured')->default(false)->after('is_approved');
            });
        }

        if (Schema::hasTable('products') && !Schema::hasColumn('products', 'viewer_type')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('viewer_type')->nullable()->default('model-viewer')->after('3d_model_provider');
            });
        }

        if (Schema::hasTable('coupons')) {
            Schema::table('coupons', function (Blueprint $table) {
                if (!Schema::hasColumn('coupons', 'applicable_products')) {
                    $table->json('applicable_products')->nullable()->after('usage_limit_per_user');
                }
                if (!Schema::hasColumn('coupons', 'applicable_categories')) {
                    $table->json('applicable_categories')->nullable()->after('applicable_products');
                }
            });
        }
    }

    public function down(): void
    {
        // Safe reversible
    }
};
