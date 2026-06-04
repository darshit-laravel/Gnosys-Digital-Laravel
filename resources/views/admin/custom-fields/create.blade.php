@extends('admin.layouts.app')

@section('title', 'Add Custom Field')
@section('page-title', 'Add Custom Field')

@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i> New Custom Field Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.custom.fields.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <label for="module-type" class="form-label">Module Type</label>
                            <select name="module_type" id="module-type" class="form-control @error('module_type') is-invalid @enderror">
                                <option value="">Select Module Type</option>
                                <option value="product" {{ old('module_type') == 'product' ? 'selected' : '' }}>Digital Product</option>
                                <option value="service" {{ old('module_type') == 'service' ? 'selected' : '' }}>Digital Service</option>
                            </select>
                            @error('module_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="name" class="form-label">Field Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Field name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="custom-field-type" class="form-label">Field Type</label>
                            <select name="custom_field_type_id" id="custom-field-type" class="form-control @error('custom_field_type_id') is-invalid @enderror">
                                <option value="">Select Field Type</option>
                                @if (!empty($customfieldtypes))
                                    @foreach ($customfieldtypes as $id => $name)
                                        <option value="{{ $id }}" {{ old('custom_field_type_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('custom_field_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>

                    <hr>
                    <div id="dynamic-field-settings"></div>
                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.custom.fields.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Custom Field</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {

        // 1. Core AJAX functionality for changing the dropdown
        $(document).on('change', '#custom-field-type', function() {
            var typeId = $(this).val();
            var settingsContainer = $('#dynamic-field-settings');

            if (typeId) {
                $.ajax({
                    url: "{{ route('admin.custom.fields.getFieldTypeData') }}",
                    type: "POST",
                    // Added CSRF token directly to headers so Laravel doesn't reject the POST request with a 419 error
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        type_id: typeId
                    },
                    beforeSend: function() {
                        settingsContainer.html('<div class="mt-3 text-muted">Loading settings...</div>');
                    },
                    success: function(response) {
                        if (response.success) {
                            settingsContainer.fadeOut(200, function () {
                                $(this).html(response.html).fadeIn(200);
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        settingsContainer.html('<div class="mt-3 text-danger">Error loading field settings.</div>');
                    }
                });
            } else {
                settingsContainer.empty();
            }
        });

        // 2. Auto-load dynamic fields if validation fails
        // If the user submits the form and gets a validation error, the page reloads.
        // This script automatically re-triggers the AJAX call to bring back the dynamic settings!
        var oldTypeId = "{{ old('custom_field_type_id') }}";
        if (oldTypeId) {
            $('#custom-field-type').trigger('change');
        }

    });
</script>
@endsection
