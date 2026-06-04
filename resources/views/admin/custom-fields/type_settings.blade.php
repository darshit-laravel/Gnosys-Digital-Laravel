<div class="mt-3 p-3 border rounded bg-light">
    <h5 class="mb-3">{{ $fieldType->name }} Settings</h5>

    @if($fieldType->has_options)
        <div class="form-group mb-3">
            <label>Field Options <span class="text-danger">*</span></label>

            <div id="dynamic-options-container">
                @if (!empty($options))
                    @foreach ($options as $key => $option)
                        <div class="input-group mb-2 option-row">
                            <input type="text" name="options[{{ $key }}]" class="form-control" placeholder="Enter option value" value="{{ $option }}">
                            <button class="btn {{ $loop->first ? 'btn-success add-option-btn' : 'btn-danger remove-option-btn' }}" type="button">
                                <strong>{{ $loop->first ? '+' : '-' }}</strong>
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="input-group mb-2 option-row">
                        <input type="text" name="options[]" class="form-control" placeholder="Enter option value">
                        <button class="btn btn-success add-option-btn" type="button">
                            <strong>+</strong>
                        </button>
                    </div>
                @endif
            </div>

            <small class="text-muted">Add the choices the user will see (e.g., Red, Green, Blue).</small>
        </div>
    @endif

    <div class="row">
        @if(is_array($field_type_params) && array_key_exists('placeholder', $field_type_params))
            <div class="col-md-6 mb-3">
                <label>Placeholder</label>
                <input type="text" name="params[placeholder]" class="form-control" placeholder="e.g., Enter your name..." value="{{ !empty($params['placeholder']) ? $params['placeholder'] : '' }}" >
            </div>
        @endif

        @if(is_array($field_type_params) && array_key_exists('default_value', $field_type_params))
            <div class="col-md-6 mb-3">
                <label>Default Value</label>
                <input type="text" name="params[default_value]" class="form-control" value="{{ !empty($params['default_value']) ? $params['default_value'] : '' }}">
            </div>
        @endif

        @if(is_array($field_type_params) && array_key_exists('min', $field_type_params))
            <div class="col-md-6 mb-3">
                <label>Min Value</label>
                <input type="text" name="params[min]" class="form-control" placeholder="Min value" value="{{ !empty($params['min']) ? $params['min'] : '' }}">
            </div>
        @endif

        @if(is_array($field_type_params) && array_key_exists('max', $field_type_params))
            <div class="col-md-6 mb-3">
                <label>Max Value</label>
                <input type="text" name="params[max]" class="form-control" placeholder="Max value" value="{{ !empty($params['max']) ? $params['max'] : '' }}">
            </div>
        @endif

        @if(is_array($field_type_params) && array_key_exists('rows', $field_type_params))
            <div class="col-md-6 mb-3">
                <label>Textarea Rows</label>
                <input type="number" name="params[rows]" class="form-control" value="3" value="{{ !empty($params['rows']) ? $params['rows'] : '' }}">
            </div>
        @endif
    </div>

    @if(is_array($field_type_params) && array_key_exists('is_required', $field_type_params))
        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" name="params[is_required]" value="1" {{ !empty($params['is_required']) ? 'checked' : '' }} id="is_required_check">
            <label class="form-check-label" for="is_required_check">
                Is this field required?
            </label>
        </div>
    @endif
</div>

<script>
    $(document).ready(function() {

        $(document).off('click', '.add-option-btn').on('click', '.add-option-btn', function() {

            var newRow = $(this).closest('.option-row').clone();

            newRow.find('input').val('');

            newRow.find('button')
                .removeClass('btn-success add-option-btn')
                .addClass('btn-danger remove-option-btn')
                .html('<strong>-</strong>');

            $('#dynamic-options-container').append(newRow);
        });

        $(document).off('click', '.remove-option-btn').on('click', '.remove-option-btn', function() {
            $(this).closest('.option-row').remove();
        });

    });
</script>
