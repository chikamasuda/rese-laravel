# Rese
## 概要
WebアプリケーションReseのバックエンドリポジトリ。  
Webアプリ概要については、以下のReseのフロントエンドリポジトリに記載。  

フロントエンドリポジトリURL：  
https://github.com/chikamasuda/rese-nuxt


## 環境構築方法(Docker)

### 前提条件　　
・Laravel sailを用いて環境構築している。  
・Docker Desktopのデスクトップアプリをインストールし、Dockerの状態が「Docker Desktop is running」であること。  


### 環境構築
①git cloneする
```
git clone https://github.com/chikamasuda/rese-laravel.git
```

②エディタ上の開くボタンでcloneしたファイルを開く。  

⓷.env.exampleファイルをコピー
```
cp .env.example .env
```
④.envファイルのDB_HOSTをmysqlに変更する  

<img width="792" alt="スクリーンショット 2022-08-04 23 12 40" src="https://user-images.githubusercontent.com/66733811/182868852-4d1bddf0-546f-47d1-b76f-b2487681e2e5.png">


④Composer依存関係のインストール　　
```
docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v $(pwd):/var/www/html \
   -w /var/www/html \
   laravelsail/php81-composer:latest \
   composer install --ignore-platform-reqs
```

⑤Dockerのコンテナ起動
```
./vendor/bin/sail up
```

⑦APP_KEYを更新
```
./vendor/bin/sail artisan key:generate
```

⑧http://localhost で初期画面がみれる。  

⑨マイグレーションとシーダーのデータをセット  
```
./vendor/bin/sail artisan migrate --seed
```



## その他のよく使うコマンド

①Dockerのコンテナ停止
```
./vendor/bin/sail stop
```

②DockerのMysql起動
```
./vendor/bin/sail mysql
```
