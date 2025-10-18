@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>{{ $impact->title }}</h2>
    <p class="mb-3"><strong>Type:</strong> {{ ucfirst($impact->type) }}</p>
    <p class="mb-3">{{ $impact->description }}</p>

    <div class="mb-4">
        @for($i=1; $i<=4; $i++)
            @php $img = 'image'.$i.'_path'; @endphp
            @if($impact->$img)
                <img src="{{ asset('storage/'.$impact->$img) }}" width="150" class="rounded me-2 mb-2">
            @endif
        @endfor
    </div>

    <div class="mb-4">
        <h5>Impact Points:</h5>
        <ul>
            @foreach($impact->points as $point)
                <li>{{ $point->point }}</li>
            @endforeach
        </ul>
    </div>

    <a href="{{ route('impacts.edit', $impact->id) }}" class="btn btn-success me-2"><i class="bi bi-pencil-square"></i> Edit</a>
    <a href="{{ route('impacts.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection
