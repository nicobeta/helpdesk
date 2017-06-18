<?php

namespace App;

use App\Message;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $connection = 'account';

    protected $fillable = ['reference', 'subject'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
