<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Section;
use Livewire\Component;

class Products extends Component
{
    public $product_name;
    public $description;
    public $section_id;
    public $product_id;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.products' ,[
            'products' => Product::orderBy('id', 'desc'),
            'sections' => Section::all(),
            'count_product' => Product::all()->count(),
        ]);
    }

    // public function mount()
    // {
    //     $this->goals = Goals::all()->isActive();
    // }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->product_name = '';
        $this->description = '';
        $this->section_id = '';
        $this->product_id = '';
    }

    public function store()
    {
        $this->validate([
            'product_name' => 'required|unique:products,product_name,'.$this->product_id,
        ]);
        $data = array(
            'product_name' => $this->product_name,
            'description' => $this->description,
            'section_id'  => $this->section_id

        );
        $product = Product::updateOrCreate(['id' => $this->product_id],$data);
        session()->flash('message', $this->product_id ? 'Product updated successfully.' : 'Product created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->product_name = $product->product_name;
        $this->description = $product->description;
        $this->section_id = $product->section_id;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->product_id = $id;
        Product::find($id)->delete();
        session()->flash('message', 'Product deleted successfully.');
    }
}
