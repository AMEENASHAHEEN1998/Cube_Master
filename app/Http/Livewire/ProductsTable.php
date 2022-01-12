<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;


class ProductsTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('Product Name', 'product_name')
                ->sortable()
                ->searchable(),
            Column::make('Description' , 'description')
                ->sortable()
                ->searchable(),
            Column::make('Section Name' , 'section_id')
            ->sortable()
            ->searchable(),
            Column::make('Created At', 'created_at')
                ->sortable()
                ->searchable(),
            Column::make('Updated At', 'updated_at')
                ->sortable()
                ->searchable(),

        ];
    }

    public function query(): Builder
    {
        return Product::query();
    }
}
