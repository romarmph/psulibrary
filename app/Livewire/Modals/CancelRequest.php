<?php

namespace App\Livewire\Modals;

use App\Models\BorrowRequest;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CancelRequest extends ModalComponent
{
  public $request_id;

  public function render()
  {

    return view('livewire.modals.cancel-request', [
      'request_id' => $this->request_id,
    ]);
  }

  public function cancelRequest($requestId)
  {
    $request = BorrowRequest::findOrFail($requestId);
    if ($request) {
      $request->status = 'canceled';
    }

    $request->save();

    session()->flash('success', 'Request canceled successfully.');

    $this->closeModal();

    return redirect()->route('borrower.requested');
  }
}
