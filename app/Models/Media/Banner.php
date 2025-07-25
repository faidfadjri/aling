<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Banner extends Model
{
    use HasFactory;
    protected $table    = 'media_banner';
    protected $guarded  = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'is_active' => 'boolean',
        'image_width' => 'integer',
        'image_height' => 'integer',
    ];

    /**
     * Boot method untuk menambahkan event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // Event saat record akan di-update
        static::updating(function ($banner) {
            // Jika content berubah, hapus file lama
            if ($banner->isDirty('content') && $banner->getOriginal('content')) {
                $oldFile = $banner->getOriginal('content');
                if (Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
        });

        // Event saat record akan di-delete
        static::deleting(function ($banner) {
            if ($banner->content && Storage::disk('public')->exists($banner->content)) {
                Storage::disk('public')->delete($banner->content);
            }
        });
    }

    /**
     * Get full URL for the banner image
     */
    public function getImageUrlAttribute(): string
    {
        return $this->content ? url('storage/' . $this->content) : '';
    }

    /**
     * Get image dimensions as formatted string
     */
    public function getImageDimensionsAttribute(): string
    {
        return $this->image_width && $this->image_height
            ? "{$this->image_width}x{$this->image_height}"
            : '';
    }
}
