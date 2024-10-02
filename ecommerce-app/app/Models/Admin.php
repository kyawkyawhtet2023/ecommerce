<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Admin as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'country_code',
        'email',
        'role',
        'address',
        'position',
        'salary',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'salary' => 'decimal:2', // Example of casting the salary to decimal
    ];

    /**
     * The validation rules for the Admin model.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'country_code' => 'required|string|max:5',
            'email' => 'required|string|email|max:255|unique:admins',
            'role' => 'required|in:owner,admin,assistant,sales',
            'address' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'password' => 'required|string|min:8|confirmed', // For registration
        ];
    }
}
