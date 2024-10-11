@extends('layouts.app')

@section('title', "Manage Users")

@section('content_header_title', "Manage")
@section('content_header_subtitle', "Users")

@php
$heads = [
    'First Name',
    'Last Name',
    'Type',
    'Status',
    'Email',
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
        <a href="{{ route('users.create') }}" class="btn btn-success">Create User</a>
    </h2>
    <h3 class="mt-4 mb-4"><span class="fw-bold text-uppercase mr-3">View all Companies</span></h3> 
    <x-adminlte-datatable id="users" head-theme="dark" :heads="$heads" :config="$config">
        @foreach($users as $user)
            <tr>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td><span class="badge {{$user->type == 'Writer' ? 'bg-indigo' : 'bg-info'}}">{{ $user->type }}</span></td>
                <td><span class="badge {{$user->status == 'Active' ? 'bg-success' : 'bg-warning'}}">{{ $user->status }}</span></td>
                <td>{{ $user->email }}</td>
                <td><a href="{{ route('users.edit', Crypt::encrypt($user)) }}" class="btn btn-xs btn-default text-primary mx-1"><i class="fa fa-lg fa-fw fa-pen"></i></a></td>
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
