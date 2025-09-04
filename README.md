# 確認テスト　お問い合わせフォーム

## 環境構築
リポジトリの設定

    ・　公開されているクローン元のリンク（SSH）をCodeボタンから取得
    
    ・　git clone リンク
            （コマンド実行後、lsで確認）
    
    ・　mv　クローン元リポジトリ名　自分のローカルリポジトリ名
    
    ・　cd 自分のローカルリポジトリ名　
            （要移動）
    
    ・　git remote -v で現在のリモートリポジトリのURLを確認
    
    ・　新規リモートリポジトリを作成
    
    ・　git remote set-url origin 自分のリモートリポジトリ名
            （クローンしたローカルリポジトリの紐付け先を、他人のURLから、自分のリモートリポジトリURLに変更）
    
    ・　git add .
    
    ・　git commit -m "コミットメッセージ"
    
    ・　git push origin main

    
Dockerの設定

    ・　docker-compose up -d --build
    
    ・　code .
    
    ・　docker-compose.yml の修正
            (1行目のversionをコメントアウト⇒修正後はコンテナ再構築)
    
    

Laravelのパッケージのインストール

    ・　docker-compose exec php bash
    
    ・　composer install
            （composer -vでインストールの確認）


.envファイルの作成

    ・　cp .env.example .env
    
    ・　.envファイルの編集
            （Laravelのプロジェクトとデータベースを接続⇒修正後はキャッシュクリア）


viewファイルの作成

    ・　viewファイルの作成

    ・　php artisan make:controller
    
    ・　web.phpの修正

    ・　php artisan key:generate


マイグレーションの実行

    ・　php artisan make:model [モデル名] -m
            (マイグレーションテーブルとモデルを同時作成)

    ・　マイグレーションファイルの編集

    ・　php artisan migrate
    

ダミーデータの作成

    ・　php artisan make:factory

    ・　php artisan make:seeder

    ・　作成したシーダーファイルをDatabaseSeeder.phpに登録
    
    ・　php artisan db:seed

    

## 使用技術
バージョン情報

    ・　ubuntu 24.04.2 LTS (GNU/Linux 6.6.87.1-microsoft-standard-WSL2 x86_64)
    
    ・　Docker Desktop 4.44.2
    
    ・　php:8.1-fpm
    
    ・　Laravel 8.83.29

    ・　Composer 2.8.10
            PHP version 8.1.33 (/usr/local/bin/php)
    
    ・　MySQL 11.8.2-MariaDB, client 15.2 for debian-linux-gnu (x86_64)
    

開発言語

    ・　HTML5・CSS
    
    ・　Laravel PHP
    
    ・　Command Line
    
    ・　MySQL
    
    ・　JavaScript（モーダル画面）
    

## ER図

    
    /home/sugamr/coachtech/laravel/test-contact-form/er-diagram.drawio

## URL

開発環境     http://localhost/

phpMyAdmin  http://localhost:8080/
