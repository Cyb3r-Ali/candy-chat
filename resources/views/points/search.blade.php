@include('includes.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1>Give Points to a user</h1>
                </div>
                <div>
                    <a href="{{ route('points.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="row mb-5 mt-5">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h3>Search user with email</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('points.search') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary form-control">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@include('includes.footer')
