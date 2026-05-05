@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <h2 class="mb-4"><i class="bi bi-receipt me-2"></i>Pesanan Saya</h2>

    @if($orders->count() === 0)
        <div class="text-center py-5">
            <i class="bi bi-bag-x display-1 text-muted"></i>
            <h4 class="mt-3">Belum ada pesanan</h4>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover bg-white rounded-3 overflow-hidden">
                <thead class="table-dark">
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-end">Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="fw-semibold">{{ $order->order_number }}</td>
                            <td>{{ $order->created_at->translatedFormat('d M Y H:i') }}</td>
                            <td>@include('partials.order-status-badge', ['status' => $order->status])</td>
                            <td class="text-end fw-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="text-end"><a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>{{ $orders->links() }}</div>
    @endif
@endsection