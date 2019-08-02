# VRChat Cloud Slide
* VRChat VRC_Panoramaで見るためのスライドURL管理API

## 仕様
* フロントエンドはNuxtで作成
* PDFをPNGに変換し、それをFirestorageにアップロード
* ダウンロードURLを返しそのURLをAPI側でDBに格納

* TwitterAuthに対応
* ログイン後、APIでユーザ認証
* 1ユーザあたり10件のスライド管理を上限とする(Storageが無料版のため..)
* 
