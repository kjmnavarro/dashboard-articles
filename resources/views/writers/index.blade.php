@extends('layouts.app')

@section('title', "Writer's Dashboard")

@section('content_header_title', "Writer's")
@section('content_header_subtitle', "Dashboard")

@php
$heads = [
    'Image',
    'Title',
    'Link',
    'Date',
    'Writer',
    'Editor',
    'Status',
];

$config = [
    'order' => [[1, 'asc']],
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
        @if (auth()->user()->type === 'Writer')
            <a href="{{ route('writers.create') }}" class="btn btn-success">Create Article</a>            
        @endif 
    </h2>
    <h3 class="mt-4 mb-4"><span class="fw-bold text-uppercase mr-3">For Edit Articles</span></h3> 
    <x-adminlte-datatable id="table1" head-theme="dark" :heads="$heads">
        @foreach($forEditArticles as $article)
            <tr>
                <td><img src="{{ $article->image }}" alt="Image" style="width: 50px;"></td>
                <td>{{ $article->title }}</td>
                <td><a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></td>
                <td>{{ $article->date }}</td>
                <td>{{ $article->writer ? $article->writer->firstname . ' ' . $article->writer->lastname : '-' }}</td>
                <td>{{ $article->editor ? $article->editor->firstname . ' ' . $article->editor->lastname : '-' }}</td>
                <td><span class="badge bg-warning">{{ $article->status }}</span></td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    <h3 class="mt-5 mb-4"><span class="fw-bold text-uppercase">Published Articles</span></h3>
    <x-adminlte-datatable id="table2" head-theme="dark" :heads="$heads">
        @foreach($publishedArticles as $article)
            <tr>
                <td><img src="{{ $article->image }}" alt="Image" style="width: 50px;"></td>
                <td>{{ $article->title }}</td>
                <td><a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></td>
                <td>{{ $article->date }}</td>
                <td>{{ $article->writer ? $article->writer->firstname . ' ' . $article->writer->lastname : '-' }}</td>
                <td>{{ $article->editor ? $article->editor->firstname . ' ' . $article->editor->lastname : '-' }}</td>
                <td><span class="badge bg-success">{{ $article->status }}</span></td>
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
