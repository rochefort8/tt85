■概要
ソフト名「顧客管理L03」

PHPで動作するフリー・オープンソースの顧客管理システムです。
データベースはMySQL、SQLiteに対応しています。
利用規約の範囲内に限り、無料で利用できます。

■セットアップ
1.アプリケーションの設置
ダウンロードした圧縮ファイルを解凍し、Webサーバーの任意のディレクトリにアップロードしてください。

2.パーミションの変更
アップロードしたファイルのパーミションを変更します。
(サーバーのOSがWindowsの場合、またはサーバーの環境によってはこの手順は必要ありません。)
「customer/application/config.php」を 「606」または「666」に変更します。
データベースがSQLiteの場合は
「customer/application/database/database.sqlite2」を 「606」または「666」に変更します。

3.セットアップの実行
セットアップページ「customer/setup.php」にブラウザでアクセスしてください。
(ドメインが「http://example.com/」、設置した顧客管理のディレクトリ名が「customer」の場合は「http://example.com/customer/setup.php」にアクセスします。)
サーバー情報と管理者情報を入力し、「実行」をクリックします。
セットアップが開始されます。

4.パーミションの変更とセットアップファイルの削除
設定ファイルのパーミションを戻します。
「application/config.php」のパーミションを「604」または「644」に変更します。
setup.phpをサーバーから削除してください。
これでセットアップは終了です。
「customer/」にアクセスし、ログインしてください。 

■アンインストール
インストールしたフォルダごと削除し、データベースのテーブルを削除してください。

■動作環境
Webサーバが稼動し、PHPがインストールされている環境
PHP　…　PHP4.4以降、mbstringが有効でshort_open_tag=Onの環境
データベース　…　MySQL4.0以降、SQLite2
ブラウザ　…　Firefox3以降、GoogleChrome、Safari4以降、IE7以降
文字コード　…　UTF-8
基本的にWebサーバでPHPが動作し、データベースが使用できる環境なら利用可能です。
InternetExplorerはブラウザ自体にバグが多いため他のブラウザをお勧めします。

■利用規約
1．著作権
顧客管理L03（以下「本ソフトウェア」とする）はオープンソースのソフトウェアです。
本ソフトウェアの著作権は、株式会社リミットリンクが保有します。
画面、ソース等に記載されている著作権表示および各プログラム中に記載された「Copyright」に関する記述のいずれも削除・移動できません。
2．使用法
本ソフトウェアをコンピュータにインストールして使用することができます。
本ソフトウェアのソースコードを改変して利用することもできますが、再配布はできません。
本ソフトウェアのソースコードを改変して作成したプログラムにも本利用規約が適用されます。
3．免責
本ソフトウェアをご利用される方は自らの責任と負担にて使用することを確認し、同意するものとします。
本ソフトウェアの使用または使用不能によって生じたいかなる損害の責任も負いません。
また、本ソフトウェアが支障なく若しくは誤作動なく作動することも保証いたしません。
バグの改善やサポートの義務は一切ないものとします。
4．再配布等の禁止
有償、無償に関わらず本ソフトウェアを再配布することはできません。
有償、無償に関わらず本ソフトウェアを使用したサービスを提供することはできません。
有償、無償に関わらず本ソフトウェアをレンタルすることはできません。
有償、無償に関わらず本ソフトウェアを第三者に設置することはできません。
その他本ソフトウェアを使用することで利益を生じる使い方をすることはできません。
5．セキュリティについて
セキュリティの確保には配慮しておりますが、アプリケーションのみのセキュリティ対策には限界があります。
認証プログラムはユーザーを判別するためのもので、データを保護するものではありません。
htaccess等でのアクセス制限、SSLでの通信など、サーバー側で必ずセキュリティ対策を行ってください。
6．その他
本ソフトウェアは、予告なくバージョンアップする場合があります。
対応するプラットホームの変更や追加、新規機能の追加、ソフトウェアの不具合の改良等につきましても同様です。
また、本規約は予告なく変更することがあります。