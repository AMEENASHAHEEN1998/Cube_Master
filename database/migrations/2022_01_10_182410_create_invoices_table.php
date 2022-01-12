<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50); // رقم الفاتورة
            $table->date('invoice_Date')->nullable(); // تاريخ الفاتورة
            $table->date('Due_date')->nullable(); // تاريخ الاستحقاق
            $table->decimal('Amount_collection',8,2)->nullable();; // مبلغ التحصيل
            $table->decimal('Amount_Commission',8,2); // مبلغ العمولة
            $table->decimal('Discount',8,2); // الخصم
            $table->decimal('Value_VAT',8,2); // قيمة ضريبة القيمة المضافة
            $table->string('Rate_VAT', 999); // نسبة ضريبة القيمة المضافة
            $table->decimal('Total',8,2); // الاجمالي شامل الضريبة
            $table->string('Status', 50); // مدفوعة غير مدفوعة
            $table->integer('Value_Status'); // 1 2
            $table->text('note')->nullable(); // ملاحظات
            $table->foreignId('section_id');// القسم
            $table->foreignId('product_id');// المنتج
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
