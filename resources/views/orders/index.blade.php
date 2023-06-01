@extends('layouts.admin')

@section('title', 'Orders List')
@section('content-header', 'Order List')
@section('content-actions')
    <a href="{{ route('cart.index') }}" class="btn btn-success">Open POS</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                {{-- <form action="{{ route('orders.index') }}"> --}}
                    <form action="{{route('orders.index')}}">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                            </div>
                            <div class="col-md-5">
                                <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                <form action="{{ route('generate.pdf') }}">

                    <div class="row">
                        {{-- <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" />
                        </div> --}}
                        <div class="col-md-2">
                            {{-- <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button> --}}
                        </div>
                    </div>
                </form>
               
            </div>
        </div>
        <hr>
      
        <a href="{{ route('generate.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success">
            <i class="fas fa-file-pdf"></i> Generate PDF
        </a>
                
        
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Received</th>
                    <th>Status</th>
                    <th>Remain.</th>
                    <th>Action</th>
                    <th>Created At</th>
                    <th></th> <!-- Empty th for the button -->
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->getCustomerName() }}</td>
                        <td> {{ $order->formattedTotal() }} {{ config('settings.currency_symbol') }}</td>
                        <td> {{ $order->formattedReceivedAmount() }} {{ config('settings.currency_symbol') }}</td>
                        <td>
                            @if($order->receivedAmount() == 0)
                                <span class="badge badge-danger">Not Paid</span>
                            @elseif($order->receivedAmount() < $order->total())
                                <span class="badge badge-warning">Partial</span>
                            @elseif($order->receivedAmount() == $order->total())
                                <span class="badge badge-success">Paid</span>
                            @elseif($order->receivedAmount() > $order->total())
                                <span class="badge badge-info">Change</span>
                            @endif
                        </td>
                        <td> {{ number_format($order->total() - $order->receivedAmount(), 2) }} {{ config('settings.currency_symbol') }}</td>
                        <td>
                            @if($order->receivedAmount() >= $order->total())
                                <a href="{{ route('orders.receipt', ['order' => $order->id]) }}" class="btn btn-success">Print Invoice</a>
                            @endif
                        </td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection
