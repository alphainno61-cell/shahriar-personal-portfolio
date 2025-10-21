@extends('layouts.app')

@section('title', 'Edit Philosophical Logic')

@push('styles')
<style>
    /* Reuse create.blade.php styles */
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card p-4">
                <div class="card-header bg-primary text-white text-center rounded-3 mb-3">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Philosophical Logic</h4>
                </div>

                <form action="{{ route('philosophies.update', $philosophy->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Logic Theory --}}
                    <div class="mb-4">
                        <label for="logic_theory" class="form-label">Logic Theory</label>
                        <input type="text" name="logic_theory" id="logic_theory" class="form-control form-control-lg"
                            value="{{ old('logic_theory', $philosophy->logic_theory) }}" required>
                    </div>

                    {{-- Logic Inputs --}}
                    <div id="logicWrapper">
                        @foreach(old('logics', $philosophy->logics) as $index => $logic)
                            <div class="logic-group mb-3">
                                <label class="form-label">Logic #{{ $index + 1 }}</label>
                                <div class="input-group">
                                    <input type="text" name="logics[]" class="form-control" value="{{ $logic }}" required>
                                    @if($index > 0)
                                        <button type="button" class="btn btn-remove ms-2"><i class="bi bi-trash"></i></button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-end mb-4">
                        <button type="button" id="addLogicBtn" class="btn btn-add btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Add Logic
                        </button>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('philosophies.index') }}" class="btn btn-back px-4">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-submit px-4">
                            <i class="bi bi-check-circle me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Dynamic Logic Fields Script --}}
@push('scripts')
<script>
    let logicCount = document.querySelectorAll('.logic-group').length;
    const logicWrapper = document.getElementById('logicWrapper');
    const addLogicBtn = document.getElementById('addLogicBtn');

    addLogicBtn.addEventListener('click', () => {
        logicCount++;
        const logicGroup = document.createElement('div');
        logicGroup.classList.add('logic-group', 'mb-3');
        logicGroup.innerHTML = `
            <label class="form-label">Logic #${logicCount}</label>
            <div class="input-group">
                <input type="text" name="logics[]" class="form-control" placeholder="Enter your logic" required>
                <button type="button" class="btn btn-remove ms-2"><i class="bi bi-trash"></i></button>
            </div>
        `;
        logicWrapper.appendChild(logicGroup);

        logicGroup.querySelector('.btn-remove').addEventListener('click', () => {
            logicGroup.remove();
            updateLabels();
        });
    });

    function updateLabels() {
        const groups = document.querySelectorAll('.logic-group');
        groups.forEach((group, index) => {
            group.querySelector('.form-label').textContent = `Logic #${index + 1}`;
        });
        logicCount = groups.length;
    }

    // Remove button for existing fields
    document.querySelectorAll('.btn-remove').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.target.closest('.logic-group').remove();
            updateLabels();
        });
    });
</script>
@endpush
@endsection
