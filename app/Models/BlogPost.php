<?php
// ════════════════════════════════════════════════════════════════════════════
//  app/Models/BlogPost.php
// ════════════════════════════════════════════════════════════════════════════
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'content', 'image', 'views_count'];

    protected static function booted(): void
    {
        static::creating(function (BlogPost $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title).'-'.uniqid();
            }
        });
    }

    public function getRouteKeyName(): string { return 'slug'; }

    public function author()   { return $this->belongsTo(User::class, 'user_id'); }
    public function comments() { return $this->hasMany(BlogComment::class, 'post_id'); }
    public function approvedComments() { return $this->comments()->where('status', 'approved'); }
}
