@extends('layouts.app')

@section('title', 'User - Create')

@section('content_header_title', 'User')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="container">
    <h2 class="mb-3">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span></h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <x-adminlte-input name="firstname" label="First Name" placeholder="type your first name here" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-input name="lastname" label="Last Name" placeholder="type your last name here" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-select name="type" label="Type" label-class="text-cyan"
                igroup-size="lg" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-cyan">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </x-slot>
                <option value="Writer">Writer</option>
                <option value="Editor">Editor</option>
            </x-adminlte-select>
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

        <div class="mb-3">
            <x-adminlte-input name="email" label="Email" placeholder="type your email here" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-globe text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <button type="submit" class="btn btn-block btn-success">Create User</button>
    </form>
</div>
@endsection
