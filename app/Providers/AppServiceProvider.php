<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
		\App\Models\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
		\App\Models\Topic::observe(\App\Observers\TopicObserver::class);
		\App\Models\Link::observe(\App\Observers\LinkObserver::class);
		\App\Models\Category::observe(\App\Observers\CategoryObserver::class);
        \Carbon\Carbon::setLocale('zh');
        // 此处注册的验证规则,可以这样使用 'required|spam|min:2',但是在rule中的message方法不会生效,错误提示消息为第三个参数
        // 如果用artisan生成rule,可以不用在此处注册,但要这样使用['required','min:2',new SpamDetector]
        Validator::extend('spam','App\Rules\SpamDetector@passes','内容不符合要求!');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(app()->isLocal()){
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }
}
