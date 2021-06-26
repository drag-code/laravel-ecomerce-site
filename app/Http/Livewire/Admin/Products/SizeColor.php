<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Color;
use Livewire\Component;
use App\Models\ColorSize as Pivot;
use App\Models\Size;

class SizeColor extends Component
{

    public $colors;
    public $color_id = "";
    public $quantity;
    public $size;
    public $open = false;
    public $open_delete = false;
    public $pivot;
    public $delete_pivot;
    public $pivot_color_id;
    public $pivot_quantity;

    protected $rules = [
        'color_id' => 'required',
        'quantity' => ['required', 'numeric', 'min:1'],
    ];

    protected $listeners = ['destroy'];

    public function mount(Size $size)
    {
        $this->size = $size;
        $this->colors = Color::select('id', 'name')->get();
    }

    public function render()
    {
        $size_colors =  $this->size->colors;
        return view('livewire.admin.products.size-color', compact('size_colors'));
    }

    public function create()
    {
        $this->validate();
        $pivot = Pivot::where('color_id', $this->color_id)->where('size_id', $this->size->id)->first();
        if ($pivot) {
            $pivot->quantity += $this->quantity;
            $pivot->save();
        } else {
            $this->size->colors()->attach([
                $this->color_id => [
                    'quantity' => $this->quantity
                ]
            ]);
        }
        
        $this->reset(['quantity', 'color_id']);
        $this->emit('saved');
        $this->size = $this->size->fresh();
    }

    public function edit(Pivot $pivot)
    {
        $this->open = true;
        $this->pivot = $pivot;
        $this->pivot_color_id = $this->pivot->color_id;
        $this->pivot_quantity = $this->pivot->quantity;
    }

    public function update()
    {
        $this->pivot->color_id = $this->pivot_color_id;
        $this->pivot->quantity = $this->pivot_quantity;
        $this->pivot->save();
        $this->emit('saved');
        $this->size = $this->size->fresh();
        $this->reset('open');
    }

    public function showDelete(Pivot $pivot)
    {
        $this->open_delete = true;
        $this->delete_pivot = $pivot;
    }

    public function destroy()
    {
        $this->delete_pivot->delete();
        $this->size = $this->size->fresh();
        $this->reset('open_delete');
        $this->emit('success');
    }

    // public function destroy(Pivot $pivot)
    // {
    //     $pivot->delete();
    //     $this->size = $this->size->fresh();
    // }
}
