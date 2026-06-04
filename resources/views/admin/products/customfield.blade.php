@if ($customfields->isNotEmpty())
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Custom Attributes</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($customfields as $field)
                    @php
                        // Safely decode JSON params and options (in case they aren't cast to arrays in the Model)
                        $params = is_string($field->params) ? json_decode($field->params, true) : ($field->params ?? []);
                        $options = is_string($field->options) ? json_decode($field->options, true) : ($field->options ?? []);

                        // Extract common attributes safely
                        $isRequired = !empty($params['is_required']) ? 'required' : '';
                        $placeholder = $params['placeholder'] ?? '';
                        $defaultValue = $params['default_value'] ?? '';

                        // Set up the input name and retrieve old values (for when validation fails)
                        $inputName = "custom_fields[" . $field->slug . "]";
                        $errorKey = "custom_fields." . $field->slug;

                        // For checkboxes, old value might be an array. For everything else, it's a string.
                        $oldValue = old($errorKey, $defaultValue);
                    @endphp

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="{{ $field->slug }}">
                            {{ $field->name }}
                            @if($isRequired) <span class="text-danger">*</span> @endif
                        </label>

                        @switch($field->custom_field_type_id)

                            {{-- 1: Single Text --}}
                            @case(1)
                                <input type="text" name="{{ $inputName }}" id="{{ $field->slug }}" class="form-control @error($errorKey) is-invalid @enderror" value="{{ $oldValue }}" placeholder="{{ $placeholder }}" {{ $isRequired }}>
                                @break

                            {{-- 2: Long Text (Textarea) --}}
                            @case(2)
                                <textarea name="{{ $inputName }}" id="{{ $field->slug }}" class="form-control @error($errorKey) is-invalid @enderror" rows="{{ $params['rows'] ?? 4 }}" placeholder="{{ $placeholder }}" {{ $isRequired }}>{{ $oldValue }}</textarea>
                                @break

                            {{-- 3: Number --}}
                            @case(3)
                                <input type="number" name="{{ $inputName }}" id="{{ $field->slug }}" class="form-control @error($errorKey) is-invalid @enderror" value="{{ $oldValue }}" placeholder="{{ $placeholder }}" min="{{ $params['min'] ?? '' }}" max="{{ $params['max'] ?? '' }}" {{ $isRequired }}>
                                @break

                            {{-- 4: Email --}}
                            @case(4)
                                <input type="email" name="{{ $inputName }}" id="{{ $field->slug }}" class="form-control @error($errorKey) is-invalid @enderror" value="{{ $oldValue }}" placeholder="{{ $placeholder }}" {{ $isRequired }}>
                                @break

                            {{-- 5: Dropdown (Select) --}}
                            @case(5)
                                <select name="{{ $inputName }}" id="{{ $field->slug }}" class="form-control @error($errorKey) is-invalid @enderror" {{ $isRequired }}>
                                    <option value="">Select {{ $field->name }}</option>
                                    @if(is_array($options))
                                        @foreach($options as $option)
                                            <option value="{{ $option }}" {{ $oldValue == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @break

                            {{-- 6: Checkbox (Multi-select) --}}
                            @case(6)
                                <div class="@error($errorKey) is-invalid @enderror">
                                    @if(is_array($options))
                                        @foreach($options as $index => $option)
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input" type="checkbox" name="{{ $inputName }}[]" id="{{ $field->slug }}_{{ $index }}" value="{{ $option }}"
                                                    {{ (is_array($oldValue) && in_array($option, $oldValue)) || $oldValue == $option ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $field->slug }}_{{ $index }}">{{ $option }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @break

                            {{-- 7: Radio Button (Single-select) --}}
                            @case(7)
                                <div class="@error($errorKey) is-invalid @enderror">
                                    @if(is_array($options))
                                        @foreach($options as $index => $option)
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input" type="radio" name="{{ $inputName }}" id="{{ $field->slug }}_{{ $index }}" value="{{ $option }}"
                                                    {{ $oldValue == $option ? 'checked' : '' }} {{ $isRequired }}>
                                                <label class="form-check-label" for="{{ $field->slug }}_{{ $index }}">{{ $option }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @break

                        @endswitch

                        {{-- Validation Error Display --}}
                        @error($errorKey)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
