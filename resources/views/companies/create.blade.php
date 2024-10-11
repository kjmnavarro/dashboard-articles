@extends('layouts.app')

@section('title', 'Company - Create')

@section('content_header_title', 'Company')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="container">
    <h2 class="mb-3">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span></h2>
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <x-adminlte-input name="logo" label="Logo URL" placeholder="type your image url here" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-images text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-input name="name" label="Name" placeholder="type your name here" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-heading text-cyan"></i>
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
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </x-adminlte-select>
        </div>

        <button type="submit" class="btn btn-block btn-success">Create Company</button>
    </form>
</div>
@endsection
