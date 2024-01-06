<?php

namespace App\Livewire\Admin\Staffs;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class StaffCreatePage extends Component
{
    use WithFileUploads;

    public $oldStaffId;
    public $isEdit = false;

    public $first_name;
    public $last_name;
    public $id_number;
    public $email;
    public $phone_number;
    public $address;
    public $photo_url;
    public $password;
    public $course_id;
    public $image;

    public function render()
    {
        $courses = \App\Models\Course::all();

        return view('livewire.admin.staffs.staff-create-page', [
            'courses' => $courses,
            'mode' => $this->isEdit ? 'Edit' : 'Create',
        ])->layout('layouts.admin');
    }

    public function create()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'id_number' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'image' => 'required|image|max:1024',
            'password' => 'required',
            'course_id' => 'required',
        ]);

        $role = 'staff';

        $name = md5($this->image . microtime()) . '.' . $this->image->extension();
        $path = $this->image->storeAs('staff_photos', $name);
        $url = Storage::url($path);

        $staff = \App\Models\User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'id_number' => $this->id_number,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'photo_url' => $url,
            'password' => $this->password,
            'role' => $role,
            'course_id' => $this->course_id,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        $this->dispatch('staffAdded');

        session()->flash('success', 'Staff added successfully!');

        return redirect()->route('staffs.index');
    }
}
