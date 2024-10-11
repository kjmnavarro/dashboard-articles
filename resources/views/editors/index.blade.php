@extends('layouts.app')

@section('title', "Editor's Dashboard")

@section('content_header_title', "Editor's")
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

<div class="container-fluid mt-3">
    <h2>
        {{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span>
    </h2>
    <h3 class="mt-4 mb-4"><span class="fw-bold text-uppercase mr-3">For Edit Articles</span></h3> 
    <x-adminlte-datatable id="editor1" head-theme="dark" :heads="$heads">
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
    <x-adminlte-datatable id="editor2" head-theme="dark" :heads="$heads">
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
