<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function gameImage()
    {
        $imagePath = ($this->image) ? $this->image : '/games/default/ldm9dHF0JwNjLIIYhdb3v4zgv0nLCeHSBcuzQuEC.jpg';

        return '/storage/' . $imagePath;
    }
}
