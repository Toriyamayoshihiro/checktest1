# お問い合わせフォーム
##環境構築
dockerビルド
 1.
 2.docker-compose up -d -build
 *MySQLは、OSによって起動しない場合があるのでそれぞれのＰＣに合わせてdocker-compose.ymlファイルを編集してください。
 Laravel環境構築

 1.docker-compose exec php bash
 2.composer install
 3..env.exampleファイルから.envを作成し、環境構築を変更
 4.php artisan key:generate
 5.php artisan migrate
 6.php artisan db:seed
 ##使用技術
 ・PHP8.0
 ・Laravel0.0
 ・MySQL8.0
 ##URL
 ・開発環境：http://localhost/
 ・phpMyAdmin:http//localhost:8080/