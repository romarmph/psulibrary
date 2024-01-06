<?php

namespace App\Livewire\Admin\Staffs;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class StaffsPage extends Component
{
    public function render()
  {
    return view('livewire.admin..staffs.staffs-page')->layout('layouts.admin');
  }
}
