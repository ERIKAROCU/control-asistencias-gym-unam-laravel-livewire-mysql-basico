<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserForm extends Component
{
    public $usuario_id;
    public $name, $email, $rol=0, $is_active=1, $password, $password_confirmation;

    public $isEditing = false; // Determina si es edición o creación
    public $modalVisible = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->usuario_id)
            ],
            'rol' => 'required|in:0,1',
            'is_active' => 'required|in:0,1',
        ];
    }

    protected $messages = [
        'name.required' => 'El campo nombres es obligatorio.',
        'email.required' => 'El campo correo es obligatorio.',
        'email.email' => 'Debe ingresar un correo válido.',
        'email.unique' => 'Este correo ya está en uso.',
        'rol.required' => 'Seleccione un rol.',
        'is_active.required' => 'Seleccione el estado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.confirmed' => 'La confirmación no coincide.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
    ];

    protected $listeners = ['edit' => 'loadUsuario', 'showModalUsuario' => 'showModalUsuario', 'refreshTable' => '$refresh', 'swal' => 'swal'];

    public function loadUsuario($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            session()->flash('error', 'El usuario no existe.');
            return;
        }

        $this->usuario_id = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->rol = $usuario->rol;
        $this->is_active = $usuario->is_active;

        $this->reset(['password', 'password_confirmation']);
        $this->isEditing = true;
        $this->modalVisible = true;
    }

    public function showModalUsuario()
    {
        $this->reset(['usuario_id', 'name', 'email', 'rol', 'is_active', 'password', 'password_confirmation']);
        $this->resetValidation();
        $this->isEditing = false;
        $this->modalVisible = true;
    }

    public function deleteRow($id)
    {
        User::find($id)?->delete();
        $this->dispatch('refreshTable');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'rol' => $this->rol,
            'is_active' => $this->is_active,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->usuario_id], $data);

        $message = $this->usuario_id ? 'Usuario actualizado.' : 'Usuario creado.';
        
        session()->flash('message', $message);
        $this->dispatch('swal', title: $message, icon: 'success');

        $this->modalVisible = false;
        $this->dispatch('refreshTable');
    }


    public function render()
    {
        return view('livewire.users.user-form');
    }
}
