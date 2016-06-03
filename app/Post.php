<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	protected  $dates = ['created_at', 'update_at'];

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function likes() {
		return $this->belongsToMany(User::class, 'likes');
	}

	public function isLiked() {
		return (boolean) $this->likes()->where('user_id', auth()->user()->id)->count();
	}

	public function comments() {
		return $this->hasMany('App\Comment');
	}

	public function isFollowed()
	{
		return (boolean) $this->followers()
			->where('follower_id', auth()->user()->id)->count();
	}
	public function getDashboardPostIds()
	{
		return $this->followings()->get()->pluck('id')->push($this->id);
	}
	public function followings()
	{
		return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id');
	}
	public function followers()
	{
		return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
	}

	function created_at()
	{
		$create = $this->created_at;
		$time = time() - $create->timestamp; // to get the time since that moment
		$time = ($time < 1) ? 1 : $time;
		$tokens = array(
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			if ($time < 604800)
				return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's ago' : ' ago');
			else
				return $this->tanggal($create);
		}
	}
}