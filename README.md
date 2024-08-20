# bbs

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
