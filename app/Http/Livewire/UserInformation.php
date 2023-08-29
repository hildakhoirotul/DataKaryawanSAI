<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Information;

class UserInformation extends Component
{
    public $informations, $information;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields()
    {
        $this->information = '';
    }

    public function store()
    {
        $validatedDate = $this->validate(
            [
                'information.0' => 'required',
                'information.*' => 'required',
            ],
            [
                'information.0.required' => 'This field is required',
                'information.*.required' => 'This field is required',
            ]
        );

        foreach ($this->information as $key => $value) {
            Information::create(['information' => $this->information[$key]]);
        }

        $this->inputs = [];

        $this->resetInputFields();

        session()->flash('message', 'Information Added Successfully.');
    }

    public function edit($id)
    {
        $this->updateMode = $id;
        $this->informations = Information::find($id)->information;
    }

    public function saveEdit($id)
    {
        $info = Information::find($id);
        $info->update([
            'information' => $this->informations
        ]);

        $this->updateMode = false;
        $this->informations = $info->information;
    }


    public function delete($id)
    {
        $info = Information::find($id);
        $info->delete();
    }

    public function render()
    {
        $data = Information::all();
        return view('livewire.information', ['data' => $data]);
    }
}
