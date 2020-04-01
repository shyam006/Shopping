@extends('layout.app')

@section('title', 'Page Title')

@section('header')
    @parent      <!-- This is to append the header with template else it will replace     -->

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>This is my body content.</p>
@endsection