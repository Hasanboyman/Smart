<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class   reports extends Model
{
    use Notifiable;

    protected $table = 'reports';

    protected $fillable = [
        'title',
        'message',
        'feedback',
        'rating',
        'status',
        'person_id',
        'user_id',
    ];

    // Optionally, if the `created_at` and `updated_at` timestamps are used, you can disable this if not
    public $timestamps = true;

    /**
     * Define a relationship with the Person model.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Define a relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
