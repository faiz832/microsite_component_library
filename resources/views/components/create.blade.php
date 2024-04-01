@extends('layout.app')
@section('title', 'Create New Component')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-inner">
        <!-- Page Heading -->
        <div class="page-header">
            <h4 class="page-title">Create</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ url('home') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ url('component') }}">Components</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="">Create</a>
                </li>
            </ul>
        </div>

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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Create Component Form</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('component.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="year_id" class="font-semibold">Input Year</label>
                                <span class="text-danger">*</span>
                                <select name="year_id" id="year_id" class="form-control">
                                    <option value="" hidden>Choose</option>
                                    @foreach ($year as $item)
                                        <option value="{{ $item->id }}">{{ $item->year }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-3"></div>
                                <label for="category_id" class="font-semibold">Input Category</label>
                                <span class="text-danger">*</span>
                                <select name="category_id" id="category_id" class="form-control"></select>
                                <div class="mt-3"></div>
                                <label for="component">Input component</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" name="component" id="component"
                                    value="{{ old('component') }}">
                                <div class="mt-3"></div>
                                <label for="iframe_src">Input Source iframe</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="form-control" name="iframe_src" id="iframe_src"
                                    value="{{ old('iframe_src') }}">
                                <div class="mt-3"></div>
                                <label for="note">Additional Note</label>
                                <textarea class="form-control" name="note" id="note">{{ old('note') }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ url('component') }}" class="btn btn-secondary">Cancel</a>
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
