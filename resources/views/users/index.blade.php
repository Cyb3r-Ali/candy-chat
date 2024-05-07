@include('includes.header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="mb-4">Below you can see all the Users that you have.</p>
        </div>

        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create New</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Current Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nickname</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Seeking</th>
                            <th>I Speak</th>
                            <th>WhatsApp</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->nickname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->age }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->seeking }}</td>
                                <td>{{ $user->i_speak }}</td>
                                <td>{{ $user->whatsapp }}</td>
                                <td>{{ $user->country }}
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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
