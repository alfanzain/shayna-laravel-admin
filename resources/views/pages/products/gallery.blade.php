@extends('layouts.default')

@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Photos of Item</h4>
                        <small>"{{ $product->name }}" | (Product ID : {{ $product->id }})</small>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Default</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($galleries as $gallery)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <img src="{{ url($gallery->photo) }}" alt="">
                                            <br/>
                                            <small>Photo ID : {{ $gallery->id }}</small>
                                        </td>
                                        <td>
                                            {{ $gallery->is_default ? 'Ya' : 'Tidak' }}
                                        </td>
                                        <td>
                                            <form action="{{ route('product-galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center p-5">
                                            Data Tidak Tersedia
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection