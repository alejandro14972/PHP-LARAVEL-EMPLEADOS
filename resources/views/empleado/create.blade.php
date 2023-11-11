@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url('/empleado')}}" method="post" enctype="multipart/form-data">
    @csrf <!-- token de seguridad -->
    <!-- los name tienen que llmarse igual que los campos de la base de datos -->
    @include('empleado.form', ['modo'=>'Creacion de '])

</form>

</div>
@endsection