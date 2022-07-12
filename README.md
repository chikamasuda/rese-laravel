# 概要
WebアプリケーションReseのバックエンドリポジトリ。  
Webアプリ概要については、以下のReseのフロントエンドリポジトリに記載。  

フロントエンドリポジトリURL：  
https://github.com/chikamasuda/rese-nuxt


# 環境構築方法(Laravel Sail)

## 前提条件　　
・Laravel sailを用いて環境構築している。  
・Docker Desktopのデスクトップアプリをインストールし、Dockerの状態が「Docker Desktop is running」であること。  
・GitHub上でSSH Keyが設定されている。  


## 環境構築
①git cloneする
```
git clone git@github.com:Builwing-Inc/win6-laravel.git
```

②エディタ上の開くボタンでcloneしたファイルを開く。  

⓷.env.exampleファイルをコピー
```
cp .env.example .env
```

※Docker起動時にM1Macだとエラーが出るため、M1Mac使用時は以下でrosettaのバージョンアップをする。
```
/usr/sbin/softwareupdate --install-rosetta --agree-to-license
```

④Composer依存関係のインストール　　
```
docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v $(pwd):/var/www/html \
   -w /var/www/html \
   laravelsail/php81-composer:latest \
   composer install --ignore-platform-reqs
```
⑤sailのエイリアスを登録。

※シェルがbashの場合　　

vimを起動
```
vim ~/.bash_profile
```
vimで以下を追加
```
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```
vimで追加した後以下のコマンドで反映
```
source ~/.bash_profile
```

※シェルがzshの場合

vimを起動
```
vim ~/.zshrc
```
以下をvimで追加
```
alias sail='./vendor/bin/sail'
```
vimで追加した後以下のコマンドで反映
```
source ~/.zshrc
```

⑥Dockerのコンテナ起動
```
sail up -d
```

⑦APP_KEYを更新
```
sail artisan key:generate
```

⑧http://localhost で初期画面がみれる。  



## その他のよく使うコマンド

①Dockerのコンテナ停止
```
sail stop
```

②DockerのMysql起動
```
sail mysql
```
