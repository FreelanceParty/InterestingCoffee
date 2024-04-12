@php
	use App\ValuesObject\Constants\ProductType;
@endphp

@extends('content.product._common', [
	'productType' => ProductType::COFFEE,
	'products' => $coffees,
])