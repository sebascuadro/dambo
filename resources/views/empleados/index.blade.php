@extends('layouts.app')

@section('content')
<div class="container">
@if(Session::has('Mensaje')){{
    Session::get('Mensaje')
}}
@endif
<a href="{{ url('empleados/create')}}" class="btn btn-success">Agregar Empleado</a>
<br><br>
<table class="table table-light table-hover">
    <thead class="thead-light">
        <tr>
            <th>&</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
            
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>
                <img src="{{ asset('storage').'/'.$empleado->photo}}" alt="" class="img-thumbnail img-fluid" width="100">
            </td>
            <td>{{ $empleado->name}} {{ $empleado->last_name}}</td>
            <td>{{ $empleado->email}}</td>
            <td>
                <a class="btn btn-warning" href="{{url('/empleados/'.$empleado->id.'/edit')}}">Editar</a>
                 | 
                <form method="post" action="{{ url('/empleados/'.$empleado->id)}}" style="display: inline">     
                    {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Borrar?');">Borrar</button>
                </form>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

</div>
@endsection