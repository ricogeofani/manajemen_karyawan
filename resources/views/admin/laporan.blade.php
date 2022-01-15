@extends('layouts.admin')
@push('css')
    <style type="text/css"></style>
@endpush
@section('header', 'laporan')

@section('content')
<component id="controller">
     <div class="container"><h2>halaman laporan</h2></div>
</component>
@endsection

@push('js')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
@endpush