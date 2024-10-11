@extends('layouts.app')

@section('title', 'Manage User')

@section('content_header_title', 'User')
@section('content_header_subtitle', 'Edit')

@section('content')
<div class="container">
    <h2 class="mb-3">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span></h2>
    <form action="{{ route('users.update', Crypt::encrypt($user)) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <x-adminlte-input name="firstname" label="First Name" value="{{ $user->firstname }}" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-input name="lastname" label="Last Name" value="{{ $user->lastname }}" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        @if($user->id == auth()->user()->id)
            <input type="hidden" name="type" value="{{ $user->type }}">
        @else
            <div class="mb-3">
                <x-adminlte-select name="type" label="Type" label-class="text-cyan"
                    igroup-size="lg" required>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-cyan">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </x-slot>
                    <option value="Writer" {{ $user->type == 'Writer' ? 'selected' : '' }}>Writer</option>
                    <option value="Editor" {{ $user->type == 'Editor' ? 'selected' : '' }}>Editor</option>
                </x-adminlte-select>
            </div>
        @endif
        
        @if($user->id == auth()->user()->id)
            <input type="hidden" name="status" value="{{ $user->status }}">
        @else
            <div class="mb-3 {{ $user->id == auth()->user()->id ? 'd-none' : '' }}">
                <x-adminlte-select name="status" label="Status" label-class="text-cyan"
                    igroup-size="lg" required>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-cyan">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </x-slot>
                    <option value="Active" {{ $user->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $user->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </x-adminlte-select>
            </div>
        @endif

        <button type="submit" class="btn btn-lg btn-info">Save User</button>
    </form>
</div>
@endsection