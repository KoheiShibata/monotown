<p align="center">
<img width="400" alt="スクリーンショット 2023-01-28 9 39 02" src="https://user-images.githubusercontent.com/115211493/224543222-00cde67c-e250-4576-9aa9-8615d3ded752.png">
</p>

# MONOTOWN 〜Monotone Shop〜
https://monotown.kohei-techis.com/

## Demo
<div align="center">
 <video controls src="https://user-images.githubusercontent.com/115211493/226311884-21055d38-ac1e-4baf-a86f-c6bcae73a72a.mp4"></video>
</div>

## Description
WEB上でモノトーンファッションの商品を閲覧できる、WEBアプリケーションです。<br>
サイドメニューからブランドを選択することで、ブランドの商品、公式アカウントinstagram投稿を表示できます。<br>

## Features
- yahoo_apiの商品検索を利用してモノトーン商品を取得
- サイドメニューから絞り込み
- 商品と一緒に、公式アカウントinstagram投稿を閲覧できる
- cronの操作によって、1日に1回instagramのjsonファイルを更新する


## Requirement
- Laravel v9.46.0
- php v8.0.23
- apache

## Usage
1. サイドメニューからブランド、商品の状態、価格を選択する
2. 気になる商品の画像をクリックしてyahoo! ショッピングに遷移する
3. 気になるinstagram投稿の画像をクリックして投稿主のアカウントに遷移する
4. headerメニューからお問い合わせフォームに遷移し、お問い合わせをする


## How to install & Start-up
```
$ git clone https://github.com/KoheiShibata/monotown.git
$ cp .env.example .env
$ composer install
$ php artisan key:generate
$ php artisan migrate
$ php artisan storage:link
```

## Author
koheiShibata
