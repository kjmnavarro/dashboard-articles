@extends('layouts.app')

@section('title', 'Writer - Edit')

@section('content_header_title', 'Writer')
@section('content_header_subtitle', 'Edit')

@section('content')
<div class="container">
    <h2 class="mb-3">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span></h2>
    <form action="{{ route('writers.update', Crypt::encrypt($article)) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <x-adminlte-input name="image" label="Image URL" value="{{ $article->image }}" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-images text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-input name="title" label="Title" value="{{ $article->title }}" label-class="text-cyan" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-heading text-cyan"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
        </div>

        <div class="mb-3">
            <x-adminlte-input name="link" label="Link" value="{{ $article->link }}" label-class="text-cyan" required>
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
            <x-adminlte-input-date name="date" label="Date" label-class="text-cyan" :config="$config" value="{{ $article->date }}" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-info">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-date>
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
                igroup-size="sm" :config="$config" required/>
        </div>

        <div class="mb-3">
            <x-adminlte-select name="status" label="Status" label-class="text-cyan"
                igroup-size="lg" required>
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-gradient-cyan">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </x-slot>
                <option value="For Edit" {{ $article->status == 'For Edit' ? 'selected' : '' }}>For Edit</option>
                <option value="Published" {{ $article->status == 'Published' ? 'selected' : '' }}>Published</option>
            </x-adminlte-select>
        </div>

        <button type="submit" class="btn btn-lg btn-primary">Update Article</button>
    </form>
</div>
@endsection

@push('js')
<script>

    $(document).ready(function() {
        $('#content').summernote();
        const newValue = "{{ $article->content }}";
        $('#content').summernote('insertText', newValue);
    });

</script>
@endpush