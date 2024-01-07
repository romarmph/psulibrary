<?php

namespace App\Livewire\Modals;

use App\Models\Publisher;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class DeleteStaff extends ModalComponent
{
  public $staff_id;

  public function render()
  {
    return view('livewire.modals.delete-staff', [
      'staff' => $this->staff_id,
    ]);
  }

  public function deleteStaff($id)
  {

    $staff = User::findOrFail($id);
    if ($staff) {
      $staff->delete();
    }


    session()->flash('message', 'Staff deleted successfully.');

    $this->closeModal();

    return redirect()->route('staffs.index');
  }
}
