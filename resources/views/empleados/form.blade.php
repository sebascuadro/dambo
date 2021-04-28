    
   <div class="form-group">
        <label for="nombre" class="control-label">{{'Nombre'}}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="nombre" value="{{ isset( $empleado->name)?$empleado->name:old('name') }}">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div> 

    <div class="form-group">
        <label for="last_name" class="control-label">{{'Apellido'}}</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ isset( $empleado->last_name)?$empleado->last_name:old('last_name') }}">
        {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>  
    
    <div class="form-group">
        <label for="mail" class="control-label">{{'Email'}}</label>
        <input type="text" class="form-control" name="email" id="mail" value="{{ isset( $empleado->email)?$empleado->email:old('email') }}">
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group">
        <label for="photo" class="control-label">{{'Foto'}}</label>
        @if(isset($empleado->photo))
        
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->photo}}" alt="" width="100">
            
        @endif
        <input type="file" class="form-control" name="photo" id="photo" value="{{ isset( $empleado->photo)?$empleado->photo:'' }}">
        {!! $errors->first('photo', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <input type="submit" class="btn btn-success" value="{{ $Modo=='crear' ? 'Agregar':'Modificar' }}    ">

    <a href="{{ url('empleados')}}" class="btn btn-primary">Regresar</a>