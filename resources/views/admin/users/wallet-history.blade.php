<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Type</th>
            <th>Current Balance</th>
            <th>Amount</th>
            <th>Balance After</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

        @if (!empty($historys->wallet->histories))
            @foreach($historys->wallet->histories as $key => $history)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <td>
                        {{ $history->date }}
                    </td>

                    <td>
                        {{ ucfirst($history->type) }}
                    </td>

                    <td>
                        {{ number_format($history->current_balance, 2) }}
                    </td>

                    <td>
                        {{ number_format($history->amount, 2) }}
                    </td>

                    <td>
                        {{ number_format($history->balance_after, 2) }}
                    </td>

                    <td>
                        {{ ucfirst($history->status) }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">
                    No Transaction History Found
                </td>
            </tr>
        @endif

    </tbody>
</table>
