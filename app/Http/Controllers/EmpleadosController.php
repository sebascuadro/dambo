<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados']=Empleados::paginate(5);

        return view('empleados.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'photo' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosEmpleados=request()->except('_token');

        if($request->hasFile('photo')){

            $datosEmpleados['photo']=$request->file('photo')->store('upload', 'public');

        }

        Empleados::insert($datosEmpleados);

        //return response()->json($datosEmpleados);
        return redirect('empleados')->with('Mensaje','Empleado agregado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado= Empleados::findOrFail($id);

        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email'
        ];

        if ($request->hasFile('photo')) {
            
            $campos+=[
                'photo' => 'required|max:10000|mimes:jpeg,png,jpg'
            ];
        }

        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);

        $datosEmpleados=request()->except(['_token', '_method']);

        if($request->hasFile('photo')){

            $empleado= Empleados::findOrFail($id);

            Storage::delete('public/'.$empleado->photo);

            $datosEmpleados['photo']=$request->file('photo')->store('upload', 'public');

        }
       
        Empleados::where('id', '=', $id)->update($datosEmpleados);

        //$empleado= Empleados::findOrFail($id);
        //return view('empleados.edit', compact('empleado'));

        return redirect('empleados')->with('Mensaje', 'Empleado modiicado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado= Empleados::findOrFail($id);
        if(Storage::delete('public/'.$empleado->photo)){
            Empleados::destroy($id);
        }
        
        //return redirect('empleados');

        return redirect('empleados')->with('Mensaje', 'Empleado eliminado!');
    }
}
