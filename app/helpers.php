<?php

use App\Models\Product;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;

function quantity($product_id, $color_id=null, $size_id=null) {
    $product = Product::find($product_id);
    if ($size_id) {
        $size = Size::find($size_id);
        $quantity = $size->colors->find($color_id)->pivot->quantity;
    } elseif ($color_id) {
        $quantity = $product->colors->find($color_id)->pivot->quantity;
    } else {
        $quantity = $product->quantity;
    }

    return $quantity;
}

function getAddedQuantity($product_id, $color_id=null, $size_id=null) {
    $cart = Cart::content();
    $item = $cart->where('id', $product_id)
        ->where('options.color_id', $color_id)
        ->where('options.size_id', $size_id)
        ->first();
    if ($item) {
        return $item->qty;
    }
    return 0;
}

function getAvailableQuantity($product_id, $color_id=null, $size_id=null) {
    return quantity($product_id, $color_id, $size_id) - getAddedQuantity($product_id, $color_id, $size_id);
}

function decrementStock($item) {
    $product = Product::find($item->id);
    $quantity = getAvailableQuantity($item->id, $item->options->color_id, $item->options->size_id);
    if ($item->options->size_id) {
        $size = Size::find($item->options->size_id);
        $size->colors()->updateExistingPivot($item->options->color_id, ['quantity' => $quantity]);
    } elseif($item->options->color_id) {
        $product->colors()->updateExistingPivot($item->options->color_id, ['quantity' => $quantity]);
    } else {
        $product->quantity = $quantity;
        $product->save();
    }
}

function recoverStock($item) {
    $product = Product::find($item->id);
    $quantity = quantity($item->id, $item->options->color_id, $item->options->size_id) + $item->qty;
    if ($item->options->size_id) {
        $size = Size::find($item->options->size_id);
        $size->colors()->updateExistingPivot($item->options->color_id, ['quantity' => $quantity]);
    } elseif($item->options->color_id) {
        $product->colors()->updateExistingPivot($item->options->color_id, ['quantity' => $quantity]);
    } else {
        $product->quantity = $quantity;
        $product->save();
    }
}
