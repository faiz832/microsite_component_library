@extends('layout.app')
@section('title', 'Create New Component')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create New Component</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('component.store') }}" method="POST">
        @csrf
        <div class="">
            <label for="year_id" class="font-semibold">Input Year</label>
            <span class="text-danger">*</span>
            <select name="year_id" id="year_id" class="form-select">
                <option value="" hidden>Choose</option>
                @foreach ($year as $item)
                    <option value="{{ $item->id }}">{{ $item->year }}</option>
                @endforeach
            </select>
            <div class="mt-3"></div>
            <label for="category_id" class="font-semibold">Input Category</label>
            <span class="text-danger">*</span>
            <select name="category_id" id="category_id" class="form-select"></select>
            <div class="mt-3"></div>
            <label for="component">Input component</label>
            <span class="text-danger">*</span>
            <input type="text" class="form-control" name="component" id="component" value="{{ old('component') }}">
            <div class="mt-3"></div>
            <label for="iframe_src">Input Source iframe</label>
            <span class="text-danger">*</span>
            <input type="text" class="form-control" name="iframe_src" id="iframe_src" value="{{ old('iframe_src') }}">
            <div class="mt-3"></div>
            <label for="note">Additional Note</label>
            <textarea class="form-control" name="note" id="note">{{ old('note') }}</textarea>
        </div>
        <div class="modal-footer">
            <a href="{{ url('component') }}" class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
    </form>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#year_id").change(function() {
                let id = $("#year_id").val();

                $("#category_id").select2({
                    placeholder: 'Choose',
                    ajax: {
                        url: "{{ url('getCategory') }}/" + id,
                        processResults: function({
                            data
                        }) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id,
                                        text: item.category,
                                    }
                                })
                            }
                        }
                    }
                })
            })
        });
    </script>
@endsection
