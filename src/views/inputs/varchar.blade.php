<div class="form-group">
    <label for="{{ $column->Field }}">{{ $column->FieldDisplayName }}</label>

    @if($column->Field == "state")
        <select class="form-control" name="{{ $column->Field }}">
            @include('autoform::inputs.common.states')
        </select>
    @elseif($column->Field == "password")
        <input autocomplete="off" class="form-control @error($column->Field) is-invalid @enderror" type="password" name="password" @if(@$column->Type['length']) maxlength='{{ $column->Type['length'] }}' @endif />
    @else
        <input class="form-control @error($column->Field) is-invalid @enderror" @if(@$column->Value) value="{{ $column->Value }}" @endif type="search" name="{{ $column->Field }}" @if(@$column->Type['length']) maxlength='{{ $column->Type['length'] }}' @endif />
    @endif

    <div class="invalid-feedback">
        Please provide a valid {{ ucwords($column->Field) }}.
    </div>

    {{ @$column->Model->table }}
    
</div>