<?php

namespace App\Livewire\Modals;

use App\Models\BorrowRequest;
use LivewireUI\Modal\ModalComponent;

class RejectRequest extends ModalComponent
{
  public $request_id;

  public function render()
  {

    return view('livewire.modals.reject-request', [
      'request_id' => $this->request_id,
    ]);
  }

  public function rejectRequest($requestId)
  {
    $request = BorrowRequest::findOrFail($requestId);
    if ($request) {
      $request->status = 'rejected';
    }

    $request->save();

    session()->flash('success', 'Request rejected successfully.');

    $this->closeModal();

    return redirect()->route('requests.index');
  }
}
