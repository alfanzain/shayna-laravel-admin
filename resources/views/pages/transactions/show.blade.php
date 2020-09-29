<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <td>{{ $transaction->name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $transaction->email }}</td>
    </tr>
    <tr>
        <th>Nomor</th>
        <td>{{ $transaction->number }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $transaction->address }}</td>
    </tr>
    <tr>
        <th>Total Transaksi</th>
        <td>{{ $transaction->transaction_total }}</td>
    </tr>
    <tr>
        <th>Status Transaksi</th>
        <td>{{ $transaction->transactionStatusLabel() }}</td>
    </tr>
    <tr>
        <th>Pembelian Produk</th>
        <td>
            <table class="table table-bordered u-100">
                <tr>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Harga</th>
                </tr>
                @foreach ($transaction->details as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->product->type }}</td>
                        <td>{{ $detail->product->price }}</td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>
<div class="row">
    <div class="col-4">
        <a href="{{ route('transactions.status', $transaction->id) }}?status=success" class="btn btn-success btn-block">
            <i class="fa fa-check"></i> Set Sukses
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transactions.status', $transaction->id) }}?status=failed" class="btn btn-danger btn-block">
            <i class="fa fa-times"></i> Set Gagal
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transactions.status', $transaction->id) }}?status=pending" class="btn btn-info btn-block">
            <i class="fa fa-spinner"></i> Set Pending
        </a>
    </div>
</div>