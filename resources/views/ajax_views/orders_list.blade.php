<option value="">Select Orders</option>
@foreach($orders as $order)
    <option value="{{ $order->id }}">{{ $order->id }}</option>
@endforeach