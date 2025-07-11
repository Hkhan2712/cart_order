<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* 1️⃣ ROLES */
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        /* 2️⃣ USERS  – tạo FK tới roles trước, KHÔNG gắn FK shipping_address ngay */
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles');
            $table->unsignedBigInteger('shipping_address_id')->nullable(); // FK thêm sau
            $table->string('phone');
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        /* 3️⃣ SHIPPING ADDRESSES – phải tạo trước khi thêm FK vào users */
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('fullname');
            $table->string('phone', 15);
            $table->string('address');
            $table->string('ward_code');
            $table->string('district_code');
            $table->string('city_code');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        /* 3️⃣.1️⃣ THÊM FK shipping_address_id cho users SAU khi bảng shipping_addresses đã tồn tại */
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses')->nullOnDelete();
        });

        /* 4️⃣ CATEGORIES */
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('path')->nullable();
            $table->timestamps();
        });

        /* 5️⃣ PRODUCTS */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('weight');
            $table->enum('unit', ['g', 'kg', 'ml', 'l']);
            $table->unsignedBigInteger('stock_quantity');
            $table->foreignId('category_id')->constrained('categories');
            $table->boolean('status')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        /* 6️⃣ PRODUCT IMAGES */
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('image_path');
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        /* 7️⃣ CARTS */
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('session_id')->nullable()->index();
            $table->timestamps();
        });

        /* 8️⃣ CART ITEMS */
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        /* 9️⃣ COUPONS */
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('discount_type', ['fixed', 'percent']);
            $table->decimal('discount_value', 10, 2);
            $table->timestamp('expired_at');
            $table->unsignedBigInteger('usage_limit');
            $table->timestamps();
        });

        /* 🔟 ORDERS – payment_id FK thêm sau để tránh vòng lặp */
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('total_amount', 10, 2);
            $table->string('order_status');
            $table->foreignId('shipping_address_id')->constrained('shipping_addresses');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->nullOnDelete();
            $table->text('order_note')->nullable();
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->timestamps();
        });

        /* 10.1 PAYMENTS (tạo sau orders) */
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('transaction_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        /* 10.2 THÊM FK payment_id vào orders */
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('payment_id')->nullable()->constrained('payments')->nullOnDelete();
        });

        /* 11️⃣ ORDER ITEMS */
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        /* 12️⃣ REVIEWS */
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->boolean('is_verfied_purchase')->default(false);
            $table->timestamps();
        });

        /* 13️⃣ REVIEW IMAGES */
        Schema::create('review_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained('reviews')->cascadeOnDelete();
            $table->string('image_path');
        });

        /* 14️⃣ INVENTORY LOGS */
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity_change');
            $table->unsignedBigInteger('stock_after_change');
            $table->string('type');
            $table->string('reference_type')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });

        /* 15️⃣ ORDER STATUS LOGS */
        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('old_status');
            $table->string('new_status');
            $table->string('changed_by_type');
            $table->unsignedBigInteger('changed_by_id');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        /* 16️⃣ WISHLISTS */
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->timestamps();
        });

        /* 17️⃣ NOTIFICATIONS */
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('type');
            $table->string('title');
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        /* 18️⃣ SEARCH LOGS */
        Schema::create('search_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('keyword');
            $table->timestamps();
        });

        /* 19️⃣ SOCIAL ACCOUNTS */
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('provider');
            $table->string('provider_user_id');
            $table->text('access_token');
            $table->timestamps();
        });

        /* 2️⃣0️⃣ USER ACTIVITIES */
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('action');
            $table->string('ip_address');
            $table->text('user_agent');
            $table->timestamps();
        });

        /* 2️⃣1️⃣ SHIPPING PROVIDERS */
        Schema::create('shipping_providers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('api_key')->nullable();
            $table->string('api_url')->nullable();
            $table->string('webhook_url')->nullable();
            $table->text('fee_formula')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        $tables = ['shipping_providers','user_activities','social_accounts','search_logs','notifications','wishlists','order_status_logs','inventory_logs','review_images','reviews','order_items','payments','orders','coupons','cart_items','carts','product_images','products','categories','shipping_addresses','users','roles'];
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
        Schema::enableForeignKeyConstraints();
    }
};
