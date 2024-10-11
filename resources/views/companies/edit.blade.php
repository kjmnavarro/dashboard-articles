@extends('layouts.app')

@section('title', 'Manage Company')

@section('content_header_title', 'Company')
@section('content_header_subtitle', 'Edit')

@section('content')
<div class="container">
    <h2 class="mb-3">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span></h2>
    <form action="{{ route('companies.update', Crypt::encrypt($company)) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <x-adminlte-input name="logo" label="Logo URL" value="{{ $company->logo }}" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-images text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-input name="name" label="Name" value="{{ $company->name }}" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-select name="status" label="Status" label-class="text-cyan"
                igroup-size="lg" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-cyan">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </x-slot>
                <option value="Active" {{ $company->status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $company->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </x-adminlte-select>
        </div>

        <button type="submit" class="btn btn-lg btn-info">Save Company</button>
    </form>
</div>
@endsection