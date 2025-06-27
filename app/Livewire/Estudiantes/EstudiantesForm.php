<?php

namespace App\Livewire\Estudiantes;

use Livewire\Component;
use App\Models\Estudiante;
use Illuminate\Validation\Rule;

class EstudiantesForm extends Component
{
    public $estudiante_id, $codigo_estudiante, $dni, $nombre, $apellido, $email, $escuela_profesional, $ciclo;

    public $isEditing = false;
    public $modalVisible = false;

    protected function rules()
    {
        return [
            'codigo_estudiante' => 'required|integer|min:1|digits:10',
            'dni' => 'required|integer|min:1|digits:8',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'escuela_profesional' => 'required|string|max:150',
            'ciclo' => 'required|integer|min:1|max:10',
        ];
    }

    protected $messages = [
        'codigo_estudiante.required' => 'El campo código es obligatorio.',
        'codigo_estudiante.integer' => 'El código debe ser un número entero.',
        'codigo_estudiante.digits' => 'El código debe tener exactamente 10 dígitos.',
        'dni.required' => 'El campo DNI es obligatorio.',
        'dni.integer' => 'El DNI debe ser un número entero.',
        'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
        'nombre.required' => 'El campo nombre es obligatorio.',
        'apellido.required' => 'El campo apellido es obligatorio.',
        'email.required' => 'El campo correo es obligatorio.',
        'email.email' => 'Debe ingresar un correo válido.',
        'escuela_profesional.required' => 'El campo escuela profesional es obligatorio.',
        'ciclo.required' => 'El campo ciclo es obligatorio.',
        'ciclo.integer' => 'El ciclo debe ser un número entero.',
        'ciclo.max' => 'El ciclo no puede ser mayor que 10.',
        'ciclo.min' => 'El ciclo debe ser al menos 1.',
    ];

    public function loadEstudiante($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            session()->flash('error', 'El estudiante no existe.');
            return;
        }

        $this->estudiante_id = $estudiante->id;
        $this->codigo_estudiante = $estudiante->codigo_estudiante;
        $this->dni = $estudiante->dni;
        $this->nombre = $estudiante->nombre;
        $this->apellido = $estudiante->apellido;
        $this->email = $estudiante->email;
        $this->escuela_profesional = $estudiante->escuela_profesional;
        $this->ciclo = $estudiante->ciclo;

        $this->isEditing = true;
        $this->modalVisible = true;
    }

    public function showModalEstudiante()
    {
        $this->reset(['estudiante_id', 'codigo_estudiante', 'dni', 'nombre', 'apellido', 'email', 'escuela_profesional', 'ciclo']);
        $this->isEditing = false;
        $this->modalVisible = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'codigo_estudiante' => $this->codigo_estudiante,
            'dni' => $this->dni,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'escuela_profesional' => $this->escuela_profesional,
            'ciclo' => $this->ciclo,
        ];

        Estudiante::updateOrCreate(['id' => $this->estudiante_id],$data);

        $message = $this->isEditing ? 'Estudiante actualizado correctamente.' : 'Estudiante creado correctamente.';
        
        session()->flash('success', $message);
        $this->dispatch('swal', title: $message, icon: 'success');
        $this->modalVisible = false;
        $this->dispatch('refreshTable');
    }

    protected $listeners = ['edit' => 'loadEstudiante', 'showModalEstudiante' => 'showModalEstudiante', 'refreshTable' => '$refresh', 'swal' => 'swal'];

    public function render()
    {
        return view('livewire.estudiantes.estudiantes-form');
    }
}
