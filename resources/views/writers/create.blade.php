@extends('layouts.app')

@section('title', 'Writer - Create')

@section('content_header_title', 'Writer')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="container">
    <h2 class="mb-3">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span></h2>
    <form action="{{ route('writers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <x-adminlte-input name="image" label="Image URL" placeholder="type your image url here" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-images text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-input name="title" label="Title" placeholder="type your title here" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-heading text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-input name="link" label="Link" placeholder="type your link here" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-globe text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            @php
                $config = ['format' => 'L'];
            @endphp
            <x-adminlte-input-date name="date" label="Date" label-class="text-cyan" :config="$config" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-date>
        </div>

        <div class="mb-3">
            <x-adminlte-select name="company_id" label="Company" label-class="text-cyan"
                igroup-size="lg" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-cyan">
                        <i class="fas fa-building"></i>
                    </div>
                </x-slot>

                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="mb-3">
            @php
                $config = [
                    "height" => "100",
                    "toolbar" => [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ],
                ]
            @endphp
            <x-adminlte-text-editor name="content" label="Content" label-class="text-cyan"
                igroup-size="sm" placeholder="Write some text..." :config="$config" required/>
        </div>

        <button type="submit" class="btn btn-block btn-info">Create Article</button>
    </form>
</div>
@endsection
