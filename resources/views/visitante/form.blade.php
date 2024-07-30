<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_completo" class="form-label">{{ __('Nombre Completo') }}</label>
            <input type="text" name="nombre_completo" class="form-control @error('nombre_completo') is-invalid @enderror" value="{{ old('nombre_completo', $visitante?->nombre_completo) }}" id="nombre_completo" placeholder="Nombre Completo">
            {!! $errors->first('nombre_completo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="numero_identificacion" class="form-label">{{ __('Numero Identificacion') }}</label>
            <input type="text" name="numero_identificacion" class="form-control @error('numero_identificacion') is-invalid @enderror" value="{{ old('numero_identificacion', $visitante?->numero_identificacion) }}" id="numero_identificacion" placeholder="Numero Identificacion">
            {!! $errors->first('numero_identificacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="relacion_con_prisionero" class="form-label">{{ __('Relacion Con Prisionero') }}</label>
            <input type="text" name="relacion_con_prisionero" class="form-control @error('relacion_con_prisionero') is-invalid @enderror" value="{{ old('relacion_con_prisionero', $visitante?->relacion_con_prisionero) }}" id="relacion_con_prisionero" placeholder="Relacion Con Prisionero">
            {!! $errors->first('relacion_con_prisionero', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>