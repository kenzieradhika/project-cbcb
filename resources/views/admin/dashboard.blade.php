@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h4 class="mb-4">Dashboard</h4>
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Produk</div>
                            <div class="fs-3 fw-bold">{{ $productCount }}</div>
                        </div>
                        <i class="bi bi-box-seam fs-1 text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Pesanan</div>
                            <div class="fs-3 fw-bold">{{ $orderCount }}</div>
                        </div>
                        <i class="bi bi-receipt fs-1 text-info opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Pelanggan</div>
                            <div class="fs-3 fw-bold">{{ $userCount }}</div>
                        </div>
                        <i class="bi bi-people fs-1 text-success opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Pendapatan</div>
                            <div class="fs-3 fw-bold">Rp {{ number_format($revenue, 0, ',', '.') }}</div>
                        </div>
                        <i class="bi bi-cash-stack fs-1 text-warning opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">Pesanan Terbaru</div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Status</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestOrders as $order)
                        <tr>
                            <td><a href="{{ route('admin.orders.show', $order) }}" class="text-decoration-none">{{ $order->order_number }}</a></td>
                            <td>{{ $order->user?->name ?? $order->customer_name }}</td>
                            <td>@include('partials.order-status-badge', ['status' => $order->status])</td>
                            <td class="text-end">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection