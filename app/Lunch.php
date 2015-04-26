<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model {
    protected $table = 'lunches';

    public function ends_at()
    {
        return Carbon::instance($this->starts_at)->addMinutes($this->duration_in_minutes);
    }
}
