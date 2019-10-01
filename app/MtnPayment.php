<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MtnPayment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mtn_payments';

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = true;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'reason',
        'id',
        'donation_id',
        'party_id_type',
        'party_id',
        'currency',
        'amount',
        'payer_message',
        'payee_note',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id', 'id');
    }
}
