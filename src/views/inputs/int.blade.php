<div class="form-group">
    <label for="{{ $column->Field }}">{{ $column->FieldDisplayName }}</label>

    @if(@$column->Model)
        @include('autoform::inputs.relationship', ['model' => $column->Model, 'column' => $column])
    @else
        <input class="form-control" type="text" @if(@$column->Value) value="{{ $column->Value }}" @endif placeholder="{{ $column->FieldDisplayName }}" name="{{ $column->Field }}" @if(@$column->Type['length']) maxlength='{{ $column->Type['length'] }}' @endif />
    @endif
</div>