@include('includes.header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Points</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="mb-4">Below you can see all the points that the users have.</p>
        </div>

        <div>
            <a href="{{ route('points.create') }}" class="btn btn-primary">Give points to a new point</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Current points</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Available Points</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($points as $point)
                            <tr>
                                <td>{{ $point->id }}</td>
                                <td>{{ $point->user_name }}</td>
                                <td>{{ $point->user_email }}</td>
                                <td>{{ $point->points }}</td>
                                <td>{{ $point->date }}</td>

                                <td>
                                    <a href="{{ route('points.edit', $point->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('points.destroy', $point->id) }}" method="POST"
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
