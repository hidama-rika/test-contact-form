# 確認テスト　お問い合わせフォーム

## 環境構築
リポジトリの設定

    ・　公開されているクローン元のリンク（SSH）をCodeボタンから取得
    
    ・　git clone リンク
            （コマンド実行後、lsで確認）
    
    ・　mv　他人のリポジトリ名　自分のローカルリポジトリ名
    
    ・　cd 自分のローカルリポジトリ名　
            （要移動）
    
    ・　git remote -v で現在のリモートリポジトリのURLを確認
    
    ・　新規リモートリポジトリを作成
    
    ・　git remote set-url origin 自分のリモートリポジトリ名
            （クローンしたローカルリポジトリの紐付け先を、他人のリモートリポジトリURLから、自分のリモートリポジトリURLに変更する）
    
    ・　git add .
    
    ・　git commit -m "リモートリポジトリの変更"
    
    ・　git push origin main

    
Dockerの設定

    ・　docker-compose up -d --build
    ・　code .
    ・　docker-compose.yml の修正

Laravelのパッケージのインストール

    ・　docker-compose exec php bash
    ・　composer install

    

## 使用技術
バージョン情報

    ・　ubuntu
    ・　Docker Desktop
    ・　php:8.1-fpm
    ・　Laravel 8
    ・　MySQL 8.0.26

開発言語

    ・　HTML・CSS
    ・　Laravel PHP
    ・　Command Line
    ・　MySQL
    ・　JavaScript（モーダル画面）

## ER図

## URL
開発環境     http://localhost/
phpMyAdmin  http://localhost:8080/
