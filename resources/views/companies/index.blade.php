@extends('layouts.app')

@section('title', "Manage Companies")

@section('content_header_title', "Manage")
@section('content_header_subtitle', "Companies")

@php
$heads = [
    'Logo',
    'Name',
    'Status',
    'Actions',
];

$config = [
    'order' => [[2, 'asc']],
];
@endphp

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="container-fluid mt-3">
    <h2>
        {{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span>
        <a href="{{ route('companies.create') }}" class="btn btn-success">Create Company</a>
    </h2>
    <h3 class="mt-4 mb-4"><span class="fw-bold text-uppercase mr-3">View all Companies</span></h3> 
    <x-adminlte-datatable id="companies" head-theme="dark" :heads="$heads" :config="$config">
        @foreach($companies as $company)
            <tr>
                <td><img src="{{ $company->logo }}" alt="Image" style="width: 50px;"></td>
                <td>{{ $company->name }}</td>
                <td><span class="badge {{$company->status == 'Active' ? 'bg-success' : 'bg-warning'}}">{{ $company->status }}</span></td>
                <td><a href="{{ route('companies.edit', Crypt::encrypt($company)) }}" class="btn btn-xs btn-default text-primary mx-1"><i class="fa fa-lg fa-fw fa-pen"></i></a></td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
</div>
@endsection

@push('js')
<script>

    $(document).ready(function() {
        var alert = $('#successAlert');
        if (alert.length) {
            setTimeout(function() {
                alert.alert('close');
            }, 2000);
        }
    });

</script>
@endpush
