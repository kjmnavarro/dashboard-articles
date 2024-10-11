@extends('layouts.app')

@section('title', "Writer's All Media")

@section('content_header_title', "Writer's")
@section('content_header_subtitle', "All Media")

@php
$heads = [
    'Actions',
    'Image',
    'Title',
    'Link',
    'Writer',
    'Editor',
    'Status',
];

$config = [
    'order' => [[0, 'desc']],
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
    <h2 class="mb-4">
        {{ auth()->user()->firstname }} {{ auth()->user()->lastname }} <span class="badge bg-info">{{ auth()->user()->type }}</span>
        @if (auth()->user()->type === 'Writer')
            <a href="{{ route('writers.create') }}" class="btn btn-success">Create Article</a>            
        @endif 
    </h2>
    <x-adminlte-datatable id="table1" head-theme="dark" :heads="$heads" :config="$config">
        @foreach($articles as $article)
            <tr>
                <td>
                    @if (Auth::user()->can('update-articles', $article))
                        <a href="{{ route('writers.edit', Crypt::encrypt($article)) }}" class="btn btn-xs btn-default text-primary mx-1"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                    @else
                        -
                    @endif
                </td>
                <td><img src="{{ $article->image }}" alt="Image" style="width: 50px;"></td>
                <td>{{ $article->title }}</td>
                <td><a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></td>
                <td>{{ $article->writer ? $article->writer->firstname . ' ' . $article->writer->lastname : '-' }}</td>
                <td>{{ $article->editor ? $article->editor->firstname . ' ' . $article->editor->lastname : '-' }}</td>
                <td><span class="badge {{$article->status == 'Published' ? 'bg-success' : 'bg-warning'}}">{{ $article->status }}</span></td>
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
