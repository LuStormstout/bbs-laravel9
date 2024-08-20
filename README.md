# bbs-laravel9

---

## 项目简介

基于 laravel 9.1.* 开发的 BBS 论坛系统

## 2024-08-20 干了什么

- [x] `touch app/helpers.php` 创建 helpers.php 文件
- [x] composer.json autoload 配置, 加载 helpers.php, `composer dump-autoload`
- [x] `php artisan make:controller PagesController` 创建 PagesController 控制器
- [x] `rm resources/views/welcome.blade.php` 删除默认视图文件
- [x] `composer require laravel/ui:3.4.5 --dev` 安装 laravel/ui
- [x] `php artisan ui bootstrap` 安装 bootstrap
- [x] `yarn add resolve-url-loader@^5.0.0 --dev` 安装 resolve-url-loader
- [x] `yarn run watch-poll` 编译前端资源
- [x] `yarn cache clean` 清除 yarn 缓存，解决 yarn add @fortawesome/fontawesome-free 安装失败问题
- [x] `yarn add @fortawesome/fontawesome-free --dev` 安装 fontawesome
- [x] `php artisan ui:auth` 安装 laravel auth
- [x] 删除 Laravel auth 生成的我们不需要的文件
    - [x] `rm app/Http/Controllers/HomeController.php`
    - [x] `rm resources/views/home.blade.php`
