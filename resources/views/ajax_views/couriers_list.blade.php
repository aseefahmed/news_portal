<option value="">Select Courier</option>
@foreach($couriers as $courier)
    <option value="{{ $courier->id }}">{{ $courier->first_name }} {{ $courier->last_name }}</option>
@endforeach