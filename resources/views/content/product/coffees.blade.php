@php
	use App\ValuesObject\ProductType;
@endphp

@extends('content.product._common', [
	'productType' => ProductType::COFFEE,
	'products' => $coffees,
])