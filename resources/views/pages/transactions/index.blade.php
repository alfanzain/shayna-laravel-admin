@extends('layouts.default')

@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Daftar Transaksi Masuk</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <small>TXN ID : {{ $transaction->uuid }}</small>
                                            <br />
                                            {{ $transaction->name }}
                                        </td>
                                        <td>
                                            {{ $transaction->email }}
                                        </td>
                                        <td>
                                            {{ $transaction->number }}
                                        </td>
                                        <td>
                                            {{ $transaction->transaction_total }}
                                        </td>
                                        <td>
                                            @if($transaction->transaction_status == '0')
                                            <span class="badge badge-info">
                                            @elseif($transaction->transaction_status == '1')
                                            <span class="badge badge-success">
                                            @elseif($transaction->transaction_status == '2')
                                                <span class="badge badge-danger">
                                            @else
                                            <span>
                                            @endif
                                            {{ $transaction->transactionStatusLabel() }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($transaction->transaction_status == "PENDING")
                                                <a href="{{ route('transactions.status', $transaction->id) }}?status=1" class="btn btn-success btn-sm">
                                                    <i class="fa fa-check"></i>
                                                </a>

                                                <a href="{{ route('transactions.status', $transaction->id) }}?status=2" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-times"></i>
                                                </a>

                                            |
                                            
                                            @endif
                                            <a href="#show-detail"
                                                data-remote="{{ route("transactions.show", $transaction->id) }}"
                                                data-toggle="modal"
                                                data-target="#show-detail"
                                                data-title="Detail Transaksi {{ $transaction->uuid }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ route('transactions.edit', ['transaction'=>$transaction->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center p-5">
                                            Data Tidak Tersedia
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        jQuery( document ).ready(function( $ ) {
            $('#show-detail').on('show.bs.modal', function(e) {
                let button = $(e.relatedTarget)
                let modal = $(this)

                modal.find('.modal-body').load(button.data('remote'))
                modal.find('.modal-title').html(button.data('title'))
            })
        })
    </script>
@endpush

<div class="modal" id="show-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>
</div>