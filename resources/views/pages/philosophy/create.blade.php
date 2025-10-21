@extends('layouts.app')

@section('title', 'Add New Philosophical Logic')

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
    }

    .btn-add {
        background-color: #0d6efd;
        color: #fff;
        transition: 0.3s ease;
    }

    .btn-add:hover {
        background-color: #0b5ed7;
        transform: scale(1.05);
    }

    .btn-remove {
        background-color: #dc3545;
        color: #fff;
        border: none;
    }

    .btn-remove:hover {
        background-color: #c82333;
    }

    .btn-submit {
        background-color: #198754;
        color: #fff;
        font-weight: 600;
    }

    .btn-submit:hover {
        background-color: #157347;
    }

    .btn-back {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-back:hover {
        background-color: #5c636a;
    }
</style>
@endpush

@section('content')
<div class="pt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card p-4">
                <div class="card-header bg-primary text-white text-center rounded-3 mb-3">
                    <h4 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Add New Philosophical Logic</h4>
                </div>

                <form action="{{ route('philosophies.store') }}" method="POST">
                    @csrf

                    {{-- Logic Theory Input --}}
                    <div class="mb-4">
                        <label for="logic_theory" class="form-label">Logic Theory</label>
                        <input type="text" name="logic_theory" id="logic_theory" class="form-control form-control-lg"
                            placeholder="Enter main logic theory" required>
                    </div>

                    {{-- Logic Inputs --}}
                    <div id="logicWrapper">
                        <div class="logic-group mb-3">
                            <label class="form-label">Logic #1</label>
                            <div class="input-group">
                                <input type="text" name="logics[]" class="form-control"
                                    placeholder="Enter your logic" required>
                            </div>
                        </div>
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
                            <i class="bi bi-check-circle me-1"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript for Dynamic Logic Fields --}}
@push('scripts')
<script>
    let logicCount = 1;
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
</script>
@endpush
@endsection
