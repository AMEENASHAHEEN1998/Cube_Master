<?php

namespace App\Http\Livewire;

use App\Models\Section;
use Livewire\Component;

class Sections extends Component
{
    public $section_name;
    public $description;
    public $section_id;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.sections' ,[
            'sections' => Section::orderBy('id', 'desc'),
            'count_section' => Section::all()->count(),
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
        $this->section_name = '';
        $this->description = '';
        $this->section_id = '';
    }

    public function store()
    {
        $this->validate([
            'section_name' => 'required|unique:sections,section_name,'.$this->section_id,
        ]);
        $data = array(
            'section_name' => $this->section_name,
            'description' => $this->description

        );
        $section = Section::updateOrCreate(['id' => $this->section_id],$data);
        session()->flash('message', $this->section_id ? 'Section updated successfully.' : 'Section created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $this->section_id = $id;
        $this->section_name = $section->section_name;
        $this->description = $section->description;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->section_id = $id;
        Section::find($id)->delete();
        session()->flash('message', 'Section deleted successfully.');
    }
}
