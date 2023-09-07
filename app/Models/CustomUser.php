<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class CustomUser extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable; // Import the Authenticatable trait

    // ... other model properties and methods ...

    use HasFactory;

    protected $table = 'customusers';
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'role_id'];
    protected $guarded = [];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Implement the required methods for the Authenticatable interface
    public function getAuthIdentifierName()
    {
        return 'id'; // The name of the primary key column
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // The value of the primary key column
    }

    public function getAuthPassword()
    {
        return $this->password; // The name of the password column
    }
}

