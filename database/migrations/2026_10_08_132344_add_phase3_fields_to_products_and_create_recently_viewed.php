<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('badge')->nullable()->after('compare_at_price');
            $table->string('purity')->nullable()->after('metal_type');
            $table->string('weight')->nullable()->after('purity');
            $table->text('stone')->nullable()->after('gemstone_type');
            $table->string('certification')->nullable()->after('stone');
            $table->string('certificate_number')->nullable()->after('certification');
            $table->string('certificate_file')->nullable()->after('certificate_number');
            $table->string('dimensions')->nullable()->after('certificate_file');
            $table->string('occasion')->nullable()->after('dimensions');
            $table->json('available_sizes')->nullable()->after('occasion');
            $table->string('3d_model_url')->nullable()->after('available_sizes');
            $table->string('3d_model_provider')->nullable()->default('model-viewer')->after('3d_model_url');
            $table->boolean('3d_model_enabled')->default(false)->after('3d_model_provider');
            $table->decimal('rating', 3, 2)->default(4.90)->after('3d_model_enabled');
            $table->unsignedInteger('reviews_count')->default(14)->after('rating');

            $table->index(['occasion', 'badge']);
        });

        Schema::create('recently_viewed_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('session_id')->nullable()->index();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->timestamp('viewed_at');
            $table->timestamps();

            $table->index(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recently_viewed_products');

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['occasion', 'badge']);
            $table->dropColumn([
                'badge',
                'purity',
                'weight',
                'stone',
                'certification',
                'certificate_number',
                'certificate_file',
                'dimensions',
                'occasion',
                'available_sizes',
                '3d_model_url',
                '3d_model_provider',
                '3d_model_enabled',
                'rating',
                'reviews_count',
            ]);
        });
    }
};
