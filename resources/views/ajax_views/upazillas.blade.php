<option value="">Select Upazilla</option>
@foreach($upazillas as $upazilla)
    <option value="{{ $upazilla->id }}">{{ $upazilla->name }}</option>
@endforeach