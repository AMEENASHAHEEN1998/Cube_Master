<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Invoices') }}
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if (session()->has('message'))
        <div id="alert" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
            <span class="inline-block align-middle mr-8">
                {{ session('message') }}
            </span>
            <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                <span>×</span>
            </button>
        </div>
    @endif
    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-bold font-bold py-2 px-4 rounded mt-10">Create New Invoice</button>
    @if ($count_invoices>0)
        <div class="py-10">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">

                <livewire:invoices-table />

            </div>
        </div>
    @endif
    @if($isOpen)
        <div class="fixed z-100 w-full h-full bg-gray-500 opacity-75 top-0 left-0"></div>
        <div class="fixed z-101 w-full h-full top-0 left-0 overflow-y-auto">
            <div class="table w-full h-full py-6">
                <div class="table-cell text-center align-middle">
                    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl">
                            <form>

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4 md:6 ">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="invoice_numberInput" class="block text-gray-700 text-sm font-bold mb-2">Invoice Number:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="invoice_numberInput" placeholder="Enter Invoice Number رقم الفاتورة" wire:model="invoice_number">
                                            @error('invoice_number') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="invoice_DateInput" class="block text-gray-700 text-sm font-bold mb-2">Invoice Date:</label>
                                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="invoice_DateInput" placeholder="Enter Invoice Date تاريخ الفاتورة" wire:model="invoice_Date">
                                            @error('invoice_Date') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="Due_dateInput" class="block text-gray-700 text-sm font-bold mb-2">Due Date:</label>
                                            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Due_dateInput" placeholder="Enter Due Date تاريخ الاستحقاق" wire:model="Due_date">
                                            @error('Due_date') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="section_idInput" class="block text-gray-700 text-sm font-bold mb-2">Section Name:</label>
                                            <select id="section_idInput" wire:model="section_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >

                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>

                                                @endforeach
                                            </select>
                                            @error('section_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="product_idInput" class="block text-gray-700 text-sm font-bold mb-2">Product Name:</label>
                                            <select id="product_idInput" wire:model="product_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >

                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>

                                                @endforeach
                                            </select>
                                            @error('product_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="Amount_collection" class="block text-gray-700 text-sm font-bold mb-2">Amount Collection:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="Amount_collection" placeholder="Enter Amount Collection  مبلغ التحصيل"
                                            wire:model="Amount_collection" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            @error('Amount_collection') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="Amount_Commission" class="block text-gray-700 text-sm font-bold mb-2">Amount Commission:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                             id="Amount_Commission" placeholder="Enter  Amount Commission  مبلغ العمولة"
                                             wire:model="Amount_Commission" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                             required>
                                            @error('Amount_Commission') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="Discount" class="block text-gray-700 text-sm font-bold mb-2">Discount:</label>
                                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Discount" placeholder="Enter Discount الخصم"
                                            wire:model="Discount" >
                                            @error('Discount') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="Rate_VAT" class="block text-gray-700 text-sm font-bold mb-2">Tax Rate:</label>
                                            <select id="Rate_VAT" wire:model="Rate_VAT" onchange="myFunction()"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >

                                                <option value="0" selected> حدد نسبة الضريبة</option>
                                                <option value="5%">5%</option>
                                                <option value="10%">10%</option>


                                            </select>
                                            @error('Rate_VAT') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="Value_VAT" class="block text-gray-700 text-sm font-bold mb-2">Tax Value:</label>
                                            <input type="text" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Value_VAT" placeholder="Enter Tax Value قيمة ضريبة القيمة المضافة" wire:model="Value_VAT">
                                            @error('Value_VAT') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label for="Total" class="block text-gray-700 text-sm font-bold mb-2">Total:</label>
                                            <input type="text" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Total" placeholder="Enter Total الاجمالي شامل الضريبة" wire:model="Total">
                                            @error('Total') <span class="text-red-500">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label for="note" class="block text-gray-700 text-sm font-bold mb-2">Note:</label>
                                        <textarea  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3" id="note" wire:model="note"></textarea>
                                        @error('note') <span class="text-red-500">{{ $message }}</span>@enderror
                                    </div>
                                </div>


                                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
                                    <button wire:click.prevent="store()" type="button" class="inline-flex bg-blue-500 hover:bg-blue-700 text-bold font-bold py-2 px-4 rounded">Save</button>
                                </span>
                                <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
                                    <button wire:click="closeModal()" type="button" class="inline-flex bg-white hover:bg-gray-200 border border-gray-300 text-gray-500 font-bold py-2 px-4 rounded">Cancel</button>
                                </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
@endpush

@push('scripts')


<script>
    function myFunction() {
        var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
        var Discount = parseFloat(document.getElementById("Discount").value);
        var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
        var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

        var Amount_Commission2 = Amount_Commission - Discount;

        if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
            alert('يرجي ادخال مبلغ العمولة ');
        } else {
            var intResults = Amount_Commission2 * Rate_VAT / 100;
            var intResults2 = parseFloat(intResults + Amount_Commission2);
            sumq = parseFloat(intResults).toFixed(2);
            sumt = parseFloat(intResults2).toFixed(2);
            console.log(sumq);
            console.log(sumt);
            Livewire.emit('getTotalForInput', sumt);
            Livewire.emit('getValueVATForInput', sumq);

            // document.getElementById("Value_VAT").value = sumq;
            // document.getElementById("Total").value = sumt;

        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

@endpush


