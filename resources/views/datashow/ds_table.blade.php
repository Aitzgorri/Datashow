@extends('Datashow::layouts.master')

@section('main_content')
	@component('Datashow::components.table', compact('model', 'columns'))
	@endcomponent
@endsection

@push('scripts')

@endpush