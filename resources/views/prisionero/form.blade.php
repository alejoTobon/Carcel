<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_completo" class="form-label">{{ __('Nombre Completo') }}</label>
            <input type="text" name="nombre_completo" class="form-control @error('nombre_completo') is-invalid @enderror" value="{{ old('nombre_completo', $prisionero?->nombre_completo) }}" id="nombre_completo" placeholder="Nombre Completo">
            {!! $errors->first('nombre_completo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_nacimiento" class="form-label">{{ __('Fecha Nacimiento') }}</label>
            <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento', $prisionero?->fecha_nacimiento) }}" id="fecha_nacimiento" placeholder="Fecha Nacimiento">
            {!! $errors->first('fecha_nacimiento', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_ingreso" class="form-label">{{ __('Fecha Ingreso') }}</label>
            <input type="date" name="fecha_ingreso" class="form-control @error('fecha_ingreso') is-invalid @enderror" value="{{ old('fecha_ingreso', $prisionero?->fecha_ingreso) }}" id="fecha_ingreso" placeholder="Fecha Ingreso">
            {!! $errors->first('fecha_ingreso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="delito_cometido" class="form-label">{{ __('Delito Cometido') }}</label>
            <input type="text" name="delito_cometido" class="form-control @error('delito_cometido') is-invalid @enderror" value="{{ old('delito_cometido', $prisionero?->delito_cometido) }}" id="delito_cometido" placeholder="Delito Cometido">
            {!! $errors->first('delito_cometido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="celda_asignada" class="form-label">{{ __('Celda Asignada') }}</label>
            <input type="text" name="celda_asignada" class="form-control @error('celda_asignada') is-invalid @enderror" value="{{ old('celda_asignada', $prisionero?->celda_asignada) }}" id="celda_asignada" placeholder="Celda Asignada">
            {!! $errors->first('celda_asignada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>