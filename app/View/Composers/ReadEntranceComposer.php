<?php

namespace App\View\Composers;

use App\Models\Entrance;
use Illuminate\View\View;

class ReadEntranceComposer
{
    public function compose(View $view): void
    {
        $read_sum = Entrance::where('read', 0)->get()->count();
        $view->with(['read_sum'=>$read_sum]);
    }
}
