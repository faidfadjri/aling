<?php

namespace App\Models\Media;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Story extends Model
{
    use HasFactory;

    protected $table = 'media_story';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk mengambil story yang belum expired
     */
    public function scopeActive($query)
    {
        return $query->where('is_expired', false);
    }

    /**
     * Accessor untuk mendapatkan URL gambar
     */
    public function getImageUrlAttribute()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');
        return $this->content ? $disk->url($this->content) : null;
    }

    /**
     * Cek apakah story sudah expired (lebih dari 24 jam)
     */
    public function checkExpired()
    {
        $isExpired = $this->created_at->lt(now()->subHours(24));

        if ($isExpired && !$this->is_expired) {
            $this->update(['is_expired' => true]);
        }

        return $isExpired;
    }

    /**
     * Boot method untuk menambahkan lifecycle hooks
     */
    protected static function boot()
    {
        parent::boot();

        // Hook ketika model akan diupdate
        static::updating(function ($story) {
            // Cek apakah ada perubahan pada field 'content'
            if ($story->isDirty('content')) {
                $oldContent = $story->getOriginal('content');

                // Hapus file lama jika ada
                if ($oldContent && Storage::disk('public')->exists($oldContent)) {
                    Storage::disk('public')->delete($oldContent);
                }
            }
        });

        // Hook ketika model akan dihapus
        static::deleting(function ($story) {
            // Hapus file image ketika story dihapus
            if ($story->content && Storage::disk('public')->exists($story->content)) {
                Storage::disk('public')->delete($story->content);
            }
        });
    }
}
