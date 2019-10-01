<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Donation extends Model
{
    use Notifiable;

    protected $table = 'donations';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency',
        'amount',
        'id',
        'user_id',
        'remarks',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mtn_payment()
    {
        return $this->hasOne(MtnPayment::class, 'donation_id', 'id');
    }
}
