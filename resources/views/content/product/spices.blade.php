@php
	use App\ValuesObject\ProductType;
@endphp

@extends('content.product._common', [
	'productType' => ProductType::SPICE,
	'products' => $spices,
])