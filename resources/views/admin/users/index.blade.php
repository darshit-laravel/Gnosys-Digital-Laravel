@extends('admin.layouts.app')

@section('title', 'Manage Users')
@section('page-title', 'Manage Users')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users me-2"></i> Users</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-light">
            <i class="fas fa-plus me-1"></i> Add User
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Wallet Balance</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $user->name }}</div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div>
                                <span>
                                    {{ number_format($user->wallet?->balance ?? 0, 2) }}
                                </span>
                                <span class="checkHistoryBtn cursor-pointer" role="button" data-id="{{encrypt($user->id)}}">
                                    <i class="fa fa-info-circle"></i>
                                </span>
                            </div>
                        </td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>
                            @if($user->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="checkHistoryModal" tabindex="-1" aria-labelledby="checkHistoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="checkHistoryModalLabel">Transaction History</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body historyData">
        ...
      </div>
    </div>
  </div>
</div>

@section('script')
    <script>
        $(document).ready(function () {

            $(document).on('click', '.checkHistoryBtn', function () {

                var id = $(this).data('id');
                var modal = $('#checkHistoryModal');

                if (id) {

                    $.ajax({
                        url: '{{ route('admin.users.transection.history') }}',
                        type: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },

                        beforeSend: function () {
                            $('.historyData').html('Loading...');
                        },

                        success: function (response) {

                            // response html show
                            $('.historyData').html('');
                            $('.historyData').html(response.html);

                            // modal open
                            modal.modal('show');
                        },

                        error: function (xhr) {
                            console.log(xhr.responseText);
                            alert('Something went wrong');
                        }
                    });
                }

            });

        });
    </script>
@endsection

@endsection
