<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property integer id ID
 * @property string name 用户名
 * @property string email 邮箱
 * @property string password 密码
 * @property string introduction 个人简介
 * @property string avatar 头像
 * @property integer notification_count 未读消息数量
 * @property string email_verified_at 邮箱验证时间
 * @property string remember_token 记住我
 * @property string created_at 创建时间
 * @property string updated_at 更新时间
 * @property Topic topics 话题
 * @property Reply replies 回复
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasRoles;

    // 引入消息通知相关功能
    use Notifiable {
        notify as protected laravelNotify;
    }

    /**
     * 通知用户，这里我们对 notify 方法进行了重写
     *
     * @param mixed $instance
     * @return void
     */
    public function notify($instance): void
    {
        // 如果要通知的人是当前用户，且不是在验证邮箱，就不必通知了！
        if ($this->id == Auth::id() && get_class($instance) !== 'Illuminate\Auth\Notifications\VerifyEmail') {
            return;
        }

        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    /**
     * 标记消息通知为已读
     *
     * @return void
     */
    public function markAsRead(): void
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'introduction',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * 判断当前用户是否是话题或者回复的作者
     * 准确的说是判断当前用户是否是某个模型（$model）的作者
     *
     * @param $model
     * @return bool
     */
    public function isAuthorOf($model): bool
    {
        return $this->id == $model->user_id;
    }

    /**
     * 用户和回复的关联
     *
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
