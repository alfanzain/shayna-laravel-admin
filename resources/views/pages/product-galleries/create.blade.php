@extends('layouts.default')

@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Add Item Photo</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('product-galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">Item Name</label>
                    <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                    </select>
                    @error('product_id') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="photo" class="form-control-label">File Photo</label>
                    <input type="file" name="photo" value="{{ old('photo') }}" accept="image/*" class="form-control @error('photo') is-invalid @enderror" required />
                    @error('photo') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="is_default" class="form-control-label">Default</label>
                    <br />
                    <label>
                        <input type="radio" name="is_default" value="1" class="form-control @error('is_default') is-invalid @enderror"> Yes
                    </label>
                    &nbsp;
                    <label>
                        <input type="radio" name="is_default" value="0" class="form-control @error('is_default') is-invalid @enderror"> No
                    </label>
                    @error('is_default') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>

<!--Local Stuff-->
<script>
    ClassicEditor
        .create( document.querySelector( '.description' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>
@endpush