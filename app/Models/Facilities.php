<?php

namespace App\Models;

// use App\Traits\hasRating;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Facilities extends Model
{
    use HasFactory;
    // use hasRating;
    use MediaAlly;

    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = env("FILESYSTEM_DISK");
        $destination_path = "/img/facility";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function getImageAttribute($value)
    {
        return Storage::disk('cloudinary')->url($value);
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    public function courts()
    {
        return $this->hasMany(Courts::class);
    }
}