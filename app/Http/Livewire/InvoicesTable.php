<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class InvoicesTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Invoice Number', 'invoice_number')
                ->sortable()
                ->searchable(),
            Column::make('Invoice Date' , 'invoice_Date')
                ->sortable()
                ->searchable(),
            Column::make('Due Date ' , 'Due_date')
            ->sortable()
            ->searchable(),
            Column::make('Section Name', 'section_id')
                ->sortable()
                ->searchable(),
            Column::make('Product Name', 'product_id')
                ->sortable()
                ->searchable(),
            Column::make('Discount ' , 'Discount')
                ->sortable()
                ->searchable(),
            Column::make('Tax Rate', 'Rate_VAT')
                ->sortable()
                ->searchable(),
            Column::make('Tax Value', 'Value_VAT')
                ->sortable()
                ->searchable(),
            Column::make('Total', 'Total')
            ->sortable()
            ->searchable(),
            Column::make('Status', 'Status')
            ->sortable()
            ->searchable(),
            Column::make('Note', 'note')
            ->sortable()
            ->searchable(),

        ];
    }

    public function query(): Builder
    {
        return Invoice::query();
    }
}
