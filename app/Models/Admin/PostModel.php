<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'idpost';
    public $timestamps = false; // Assuming you don't have created_at and updated_at columns

    protected $fillable = [
        'title', 'content', 'date', 'username'
    ];

    // Define the relationship with the Account model
}
