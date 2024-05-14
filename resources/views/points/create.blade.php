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
    @if ($user)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Give Points</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('points.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" readonly>
                                <input type="hidden" name="id" value="{{ $user->id }}">
                            </div>
                            <div class="form-group">
                                <label for="points">Points</label>
                                <input type="number" class="form-control" id="points" name="points">
                                @error('points')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {{-- <label for="payment_type">Payment type</label> --}}
                                <input type="hidden" value="local" class="form-control" id="payment_type"
                                    name="payment_type">
                                @error('payment_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Give Points</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@include('includes.footer')
