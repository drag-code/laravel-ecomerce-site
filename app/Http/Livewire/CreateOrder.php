<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CreateOrder extends Component
{
    public $departments = [];
    public $cities = [];
    public $districts = [];
    public $department_id = "";
    public $city_id = "";
    public $district_id = "";
    public $address = "";
    public $reference = "";
    public $contact = "";
    public $phone = "";
    public $shipping_type = 1;
    public $shipping_cost = 0;

    protected $rules = [
        'contact' => ['required'],
        'phone' => ['required', 'min:10', 'max:10'],
        'shipping_type' => ['required'],
        'department_id' => ['required_if:shipping_type,2'],
        'city_id' => ['required_if:shipping_type,2'],
        'district_id' => ['required_if:shipping_type,2'],
        'address' => ['required_if:shipping_type,2', 'max:40'],
        'reference' => ['required_if:shipping_type,2', 'max:40']
    ];

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function render()
    {
        return view('livewire.create-order');
    }

    protected function updatedDepartmentId()
    {
        $this->cities = City::where('department_id', $this->department_id)->get();
        $this->reset(['city_id', 'district_id']);
    }

    protected function updatedCityId()
    {
        $this->districts = District::where('city_id', $this->city_id)->get();
        $city = City::find($this->city_id);
        $this->shipping_cost = $city->shipping_cost;
        $this->reset(['district_id']);
    }

    protected function updatedShippingType()
    {
        if ($this->shipping_type == 1) {
            $this->reset(['shipping_cost', 'department_id', 'city_id', 'district_id', 'address', 'reference']);
            $this->resetValidation(['department_id', 'city_id', 'district_id', 'address', 'reference']);
        }
    }

    public function create() {
        $this->validate();
        $order = new Order();
        $order->department_id = !$this->department_id ? null : $this->department_id;
        $order->district_id = !$this->district_id ? null : $this->district_id;
        $order->city_id = !$this->city_id ? null : $this->city_id;
        $order->user_id = auth()->id();
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->shipping_cost = $this->shipping_cost;
        $order->total = $this->shipping_cost + Cart::subtotalFloat();
        $order->content = Cart::content();
        $order->save();
        return redirect()->route('orders.payment', $order);
    }
}
