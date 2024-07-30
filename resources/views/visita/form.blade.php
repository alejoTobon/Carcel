<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="prisionero_id" class="form-label">{{ __('Prisionero Id') }}</label>
            <input type="text" name="prisionero_id" class="form-control @error('prisionero_id') is-invalid @enderror" value="{{ old('prisionero_id', $visita?->prisionero_id) }}" id="prisionero_id" placeholder="Prisionero Id">
            {!! $errors->first('prisionero_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="visitante_id" class="form-label">{{ __('Visitante Id') }}</label>
            <input type="text" name="visitante_id" class="form-control @error('visitante_id') is-invalid @enderror" value="{{ old('visitante_id', $visita?->visitante_id) }}" id="visitante_id" placeholder="Visitante Id">
            {!! $errors->first('visitante_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="guardia_id" class="form-label">{{ __('Guardia Id') }}</label>
            <input type="text" name="guardia_id" class="form-control @error('guardia_id') is-invalid @enderror" value="{{ old('guardia_id', $visita?->guardia_id) }}" id="guardia_id" placeholder="Guardia Id">
            {!! $errors->first('guardia_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_hora_inicio" class="form-label">{{ __('Hora Inicio') }}</label>
            <input type="datetime-local" name="fecha_hora_inicio" class="form-control @error('fecha_hora_inicio') is-invalid @enderror" value="{{ old('fecha_hora_inicio', $visita?->fecha_hora_inicio) }}" id="fecha_hora_inicio" placeholder="Hora Inicio">
            {!! $errors->first('fecha_hora_inicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_hora_fin" class="form-label">{{ __('Fecha Hora Fin') }}</label>
            <input type="datetime-local" name="fecha_hora_fin" class="form-control @error('fecha_hora_fin') is-invalid @enderror" value="{{ old('fecha_hora_fin', $visita?->fecha_hora_fin) }}" id="fecha_hora_fin" placeholder="Hora Fin">
            {!! $errors->first('fecha_hora_fin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>