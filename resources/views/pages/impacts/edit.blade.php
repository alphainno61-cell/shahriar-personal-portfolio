@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Edit Impact</h2>

    <form action="{{ route('impacts.update', $impact->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-select" required>
                <option value="entrepreneur" {{ $impact->type == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                <option value="technology" {{ $impact->type == 'technology' ? 'selected' : '' }}>Technology</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $impact->title }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $impact->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Images (up to 4)</label>
            @for($i=1; $i<=4; $i++)
                @php $img = 'image'.$i.'_path'; @endphp
                @if($impact->$img)
                    <img src="{{ asset('storage/'.$impact->$img) }}" width="100" class="rounded mb-2">
                @endif
                <input type="file" name="image{{$i}}" class="form-control mb-2">
            @endfor
        </div>

        <div class="mb-3">
            <label>Impact Points</label>
            <div id="points-wrapper">
                @foreach($impact->points as $point)
                    <input type="text" name="points[]" class="form-control mb-2" value="{{ $point->point }}">
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-secondary" onclick="addPoint()">+ Add Point</button>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" {{ $impact->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update Impact</button>
        <a href="{{ route('impacts.index') }}" class="btn btn-primary">Back</a>
    </form>
</div>

<script>
function addPoint() {
    let wrapper = document.getElementById('points-wrapper');
    let input = document.createElement('input');
    input.type = 'text';
    input.name = 'points[]';
    input.className = 'form-control mb-2';
    input.placeholder = 'Enter impact point';
    wrapper.appendChild(input);
}
</script>
@endsection
