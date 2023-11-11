<!-- formulario que tendrá los datos en común con create y edit -->
<h1>{{$modo}} empleado</h1>


@if(count($errors)>0) <!-- control de validacion de formularios  -->

<div class="alert alert-danger" role="alert">
    <ul>
    @foreach( $errors->all() as $error)
   <li> {{$error}} </li>
    @endforeach
    </ul>
</div>
@endif

<div class="form-group">
    <label for="Nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{isset($empleado->nombre)?$empleado->nombre:old('nombre')}}" class="form-control">
    <br>
</div>

<div class="form-group">
    <label for="Primer apellido">Primer apellido</label>
    <input type="text" name="primerapellido" id="apellido1" value="{{isset($empleado->primerapellido)?$empleado->primerapellido:old('primerapellido')}}" class="form-control">
    <br>
</div>

<div class="form-group">
    <label for="Segundo apellido">Segundo apellido</label>
    <input type="text" name="segundoapellido" id="apellido2" value="{{isset($empleado->segundoapellido)?$empleado->segundoapellido:old('segundoapellido')}}" class="form-control">
    <br>
</div>

<div class="form-group">
    <label for="Correo">Correo</label>
    <input type="text" name="correo" id="correo" value="{{isset($empleado->correo)?$empleado->correo:old('correo')}}" class="form-control">
    <br>
</div>

<div class="form-group">
    <label for="Foto"></label>
    @if(isset($empleado->foto))
    <img src="{{asset('storage').'/'.$empleado->foto}}" alt="" width="60" class="img-thumbnail img-fluid">
    @endif
    <input type="file" name="foto" id="foto" value="" class="form-control">

</div><br>


<input type="submit" value="{{$modo}} datos" class="btn btn-success">

<a href="{{url('empleado/')}}" class="btn btn-primary">Regresar</a>