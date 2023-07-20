<?php

namespace App\Http\Livewire\App\Shop\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class View extends Component
{
    use LivewireAlert;
    public Product $product;

    public function addCart(Product $product) : void
    {

        dd(\Cart::getContent());


        \Cart::add($product->id, $product->title, $product->current_price, 1, array());


        $this->emit('updateCart');
        $this->alert(
            'success',
            __('bap.added')
        );
    }

    public function removeCart(Product $product) : void
    {
        \Cart::update($product->id, array(
            'quantity' => -1,
        ));

        $this->emit('updateCart');
        $this->alert(
            'success',
            __('bap.removed')
        );
    }

    public function mount(Product $product) : void
    {
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.app.shop.product.view');
    }
}