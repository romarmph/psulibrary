<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DashboardCard extends Component
{
  public $title;
  public $value = 0;
  public $icon;
  public $iconColor;
  public $iconBgColor;
  public $route;

  public function render()
  {
    return view('livewire.components.dashboard-card', [
      'title' => $this->title,
      'value' => $this->value,
      'icon' => $this->icon,
      'iconColor' => $this->iconColor,
      'iconBgColor' => $this->iconBgColor,
      'route' => $this->route,
    ]);
  }
}
