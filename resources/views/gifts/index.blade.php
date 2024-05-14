@include('includes.header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">gifts</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="mb-4">Below you can see all the gifts that have.</p>
        </div>

        <div>
            <a href="{{ route('gifts.create') }}" class="btn btn-primary">Add new gift</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Current gifts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gift Name</th>
                            <th>Gift Price</th>
                            <th>Gift Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gifts as $gift)
                            <tr>
                                <td>{{ $gift->id }}</td>
                                <td>{{ $gift->gift_name }}</td>
                                <td>{{ $gift->gift_price }}</td>
                                <td><img src="{{ $gift->gift_image }}" width="150" alt=""></td>
                                <td>
                                    <a href="{{ route('gifts.edit', $gift->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('gifts.destroy', $gift->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@include('includes.footer')
