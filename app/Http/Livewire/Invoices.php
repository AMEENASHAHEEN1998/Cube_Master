<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Livewire\Component;

class Invoices extends Component
{


    public $invoice_number;
    public $invoice_Date;
    public $Due_date;
    public $Amount_collection;
    public $Amount_Commission;
    public $Discount;
    public $Value_VAT;
    public $Rate_VAT;
    public $Total;
    public $Status;
    public $Value_Status;
    public $note;
    public $invoice_id;
    public $section_id;
    public $product_id;
    public $isOpen = 0;

    protected $listeners = [
        'getTotalForInput' , 'getValueVATForInput' ,
    ];
    public function getTotalForInput($value)
    {
        if(!is_null($value))
            $this->Total = $value;
    }
    public function getValueVATForInput($value)
    {
        if(!is_null($value))
            $this->Value_VAT = $value;
    }


    public function render()
    {
        return view('livewire.invoices' ,[
            'invoices' => Invoice::orderBy('id', 'desc'),
            'sections' => Section::all(),
            'products' => Product::all(),
            'count_invoices' => Product::all()->count(),
        ]);
    }



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
        $this->invoice_number = '';
        $this->invoice_Date = '';
        $this->Due_date = '';
        $this->Amount_collection = '';
        $this->Amount_Commission = '';
        $this->Discount = '';
        $this->Value_VAT = '';
        $this->Rate_VAT = '';
        $this->Total = '';
        $this->Status = '';
        $this->Value_Status = '';
        $this->note = '';
        $this->invoice_id = '';
        $this->section_id = '';
        $this->product_id = '';
    }

    public function store()
    {
        $this->validate([
            'invoice_number' => 'required|unique:invoices,invoice_number,'.$this->invoice_id,
        ]);
        $data = array(
            'invoice_number'    => $this->invoice_number,
            'invoice_Date'      => $this->invoice_Date,
            'Due_date'          => $this->Due_date,
            'Amount_collection' => $this->Amount_collection,
            'Amount_Commission' => $this->Amount_Commission,
            'Discount'          => $this->Discount,
            'Value_VAT'         => $this->Value_VAT,
            'Rate_VAT'          => $this->Rate_VAT,
            'Total'             => $this->Total,
            'Value_Status'            => 1,
            'Status'      => "فواتير مدفوعة",
            'note'              => $this->note,
            'section_id'        => $this->section_id,
            'product_id'        => $this->product_id,


        );
        $invoice = Invoice::updateOrCreate(['id' => $this->invoice_id],$data);
        session()->flash('message', $this->invoice_id ? 'Invoice updated successfully.' : 'Invoice created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }



}
