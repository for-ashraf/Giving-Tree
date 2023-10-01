<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'is_money_involved',
        'target_amount',
        'current_amount',
        'campaign_status',
        'campaign_type',
        'organizer',
        'contact_person',
        'contact_email',
        'contact_phone',
        'volunteer_opportunities',
        'campaign_address',
        'campaign_image',
        'donor_instructions',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($campaign) {
            if (is_null($campaign->user_id)) {
                $campaign->user_id = auth()->user()->id;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define any other relationships or methods relevant to your Campaign model here
}
