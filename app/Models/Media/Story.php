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
