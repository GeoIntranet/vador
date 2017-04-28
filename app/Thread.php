<?php
namespace App;

use App\Http\Controllers\Lib\Feature\Favoritable;
use App\Http\Controllers\Lib\Filter\ThreadFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
class Thread extends Model
{

    use Favoritable;
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $fillable = ['user_id','channel_id','active','title','body'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];



    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
    }
    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }
    /**
     * A thread belongs to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * A thread is assigned a channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    /**
     * A thread may have many replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class)->where('active',1);
    }
    /**
     * Add a reply to the thread.
     *
     * @param $reply
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, ThreadFilter $filters)
    {
        return $filters->apply($query);
    }

    public function ScopeActive($query)
    {
        return $query->where('active',1);
    }

    public function createur()
    {
        return $this->hasOne('App\User','USER_id','user_id');
    }

    public function favoris()
    {
        return $this->morphMany('App\Favoris', 'favorited');
    }

}