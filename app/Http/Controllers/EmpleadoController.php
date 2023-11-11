<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; /* borrar fotografuais */

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consultar la informacioón y tomar los primeros 5 y guardarlos en la var empleado
        $datos['empleados']= Empleado::paginate(2);

        return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validacion obligar a que se inserten contyrol de errores
        $campos = [
            'nombre'=>'required|string|max:100',
            'primerapellido'=>'required|string|max:100',
            'segundoapellido'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'required|max:2000|mimes:jepg,png,jpg',
        ];

        $mensajeErrorForm=[
            'required'=>'El :attribute es requerido',
            'foto.required'=> 'La foto es requerida',
        ];

        $this->validate($request, $campos, $mensajeErrorForm);

        // obtener la información por formulario y ostrar los datos en json
        //$datosEmpleado = request()->all(); /* recolectar la información  */
        $datosEmpleado = request()->except('_token'); //todo menos el token para insertar en la bd
            /* almacenar foto */
            if ($request->hasFile('foto')) {
                $datosEmpleado['foto']=$request->file('foto')->store('uploads','public'); /* uploaDS ES EL NOMBRE DE LA CARPETA */
            }

        Empleado::insert($datosEmpleado);
        /* return response()->json($datosEmpleado); */
        return redirect('empleado')->with('mensaje','Empleado agregado con exito');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado=Empleado::findOrFail($id);

        return view('empleado.edit', compact('empleado')); /* empleado es el nombre de la variable creada */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validación datos al actulizar
        $campos = [
            'nombre'=>'required|string|max:100',
            'primerapellido'=>'required|string|max:100',
            'segundoapellido'=>'required|string|max:100',
            'correo'=>'required|email',
        ];

        //mensaje de error
        $mensajeErrorForm=[
            'required'=>'El :attribute es requerido',
        ];
    
        //validación de la foto
        if ($request->hasFile('foto')) {
            $campos =['foto'=>'required|max:2000|mimes:jepg,png,jpg',];
            $mensaje=[
                'foto.required'=> 'La foto es requerida',];
        }

        $this->validate($request, $campos, $mensajeErrorForm);

        //
        $datosEmpleado = request()->except(['_token', '_method']); //todo menos el token para insertar en la bd

        if ($request->hasFile('foto')) {

            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->foto);

            $datosEmpleado['foto']=$request->file('foto')->store('uploads','public'); /* uploaDS ES EL NOMBRE DE LA CARPETA */
        }

        Empleado::where('id', '=', $id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);

        //return view('empleado.edit', compact('empleado')); /* empleado es el nombre de la variable creada. regrasa a la pagina edit/2 con los datos actualizados */
        return redirect('/empleado')->with('mensaje', 'Empleado modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrFail($id);

        if (Storage::delete('public/'.$empleado->foto)) {
            Empleado::destroy($id);
        }

       
        return redirect('/empleado')->with('mensaje', 'borrado');
    }
}
