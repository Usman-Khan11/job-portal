@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="fw-bold">{{ $page_title }}</h4>
                    <hr />
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control" value="{{ old('name') }}"
                                    placeholder="Name" />
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input name="image" type="file" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12 col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
