@extends('layouts.app')

@section('content')
<div class="container">


    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @endif
    </div>
    <a href="{{url('empleado/create')}}" class="btn btn-success">Registrar</a>
    <br><br>
    <table class="table table-primary table-responsive">
        <thead>
            <tr>
                <th>id</th>
                <th>foto</th>
                <th>nombre</th>
                <th>apellido</th>
                <th>apellido 2</th>
                <th>correo</th>
                <th>acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($empleados as $empleado)
            <tr class="">
                <td>{{$empleado ->id}}</td>

                <td>
                    <img src="{{asset('storage').'/'.$empleado->foto}}" alt="" width="60" class="img-thumbnail img-fluid">
                </td>
                <td>{{$empleado->nombre}}</td>
                <td>{{$empleado->primerapellido}}</td>
                <td>{{$empleado->segundoapellido}}</td>
                <td>{{$empleado->correo}}</td>
                <td>
                    <!-- <form action="{{url('/empleado/'.$empleado->id.'/edit')}}" >
                        @csrf 
                        
                        <input type="submit" value="edit" >
                    </form> -->
                    <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">editar</a>

                    <form action="{{url('/empleado/'.$empleado->id)}}" method="post" class="d-inline">
                        @csrf
                        {{method_field('delete')}}
                        <input type="submit" value="borrar" onclick="return confirm('¿Quieres borrar?')" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!!$empleados->links()!!}
</div>

@endsection