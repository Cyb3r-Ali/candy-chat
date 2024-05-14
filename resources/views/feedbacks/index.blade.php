@include('includes.header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">feedbacks</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="mb-4">Below you can see all the feedbacks that you have.</p>
        </div>

        {{-- <div>
            <a href="{{ route('feedbacks.create') }}" class="btn btn-primary">Create New</a>
        </div> --}}
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Current feedbacks</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Feedback</th>
                            <th>Review</th>
                            <th>Status</th>
                            <th>Date</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->id }}</td>
                                <td>{{ $feedback->feedback }}</td>
                                <td>{{ $feedback->review }}</td>
                                <td>{{ $feedback->status }}</td>
                                <td>{{ $feedback->date }}</td>
                                {{-- <td>
                                    <a href="{{ route('feedbacks.edit', $feedback->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td> --}}
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
