@include('includes.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1>Edit Gift</h1>
                </div>
                <div>
                    <a href="{{ route('gifts.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h3>Edit a gift</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('gifts.update', $gift->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="g_name">Gift name</label>
                            <input type="text" class="form-control" id="g_name" name="gift_name"
                                value="{{ $gift->gift_name }}">
                            @error('gift_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Gift price</label>
                            <input type="number" class="form-control" id="price" name="gift_price"
                                value="{{ $gift->gift_price }}">
                            @error('gift_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="g_image" class="form-label">Gift image</label>
                            <input class="form-control" type="file" id="g_image" name="gift_image">
                            @error('gift_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary form-control">Update Gift</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@include('includes.footer')
