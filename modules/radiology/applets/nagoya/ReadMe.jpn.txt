===============================================================================
 [Program Name] DICOM AiViewer (Java Applet) Ver.1.0.0β
 [Archive Name] dicomaiviewer100.zip
 [Author] 加藤子 貴洋(かとうじ たかひろ)
          E-mail: katoco@mars.elcom.nitech.ac.jp or katoco@tomo.ne.jp
 [Edit By] E-mail: ta-naka@mars.elcom.nitech.ac.jp
 [Web site] http://mars.elcom.nitech.ac.jp/dicom/
 [Development Language] Sun SDK 1.4.2_06
===============================================================================

 *****************************************************************************

     この DICOM AiViewer は、InternetExplorerやNetscapeNavigatorなどといった
  汎用のWWWブラウザを使用して、 DICOMファイルの閲覧、処理を可能とするものです。


  !!! 警告 !!!
  以下のソフトウェアは、フリーウェアであり、商用・非商用に関わらず使用することができます。
  ただし、本ソフトウェアを使用して何らかの動作異常や法律上、ライセンス上の問題が生じても、
  当方は一切関知しません。
  なお、著作権については COPYRIGHT.txt を御覧下さい。 

 *****************************************************************************

[主な機能]
  * DICOMデータの閲覧
  * Java言語によるJavaAppletで開発しているため、
    Windows、MacOS、Unix等で動作可能
  * 8～16ビットグレースケールのサポート
  * 24ビットRGBカラーのサポート
  * 1000枚以上のマルチスライスの読み込み
  * リアルタイム WW/WL
  * 拡大・縮小
  * 虫眼鏡機能
  * スライス連続表示（シネモード）
  * タグ情報の表示
  * 画面分割
  * 画像の白黒反転、左右反転、上下反転、90°回転
  * New!:DICOM-Part10規格に対応
  * New!:JPEGの転送構文に対応

[使用方法]
  クラスファイルをダウンロードし、Webから参照できる以下の例のような
  ディレクトリに解凍してください。そして、HTMLの記述の仕方にそってHTMLファイル
  を用意します。あとは、 WWWブラウザから作成したHTMLファイルにアクセスすると、
  DICOM AiViewer が起動します。
  ※注意：WWWブラウザを起動しているマシン上にHTMLファイルが存在する場合も、
    アクセスには必ず http://localhost/sample.html のように記述し、http で
    アクセスするようにしてください。

  例:

  /public_html/など （Web表示するフォルダ）
       |
       | -- sample.html（ここに「HTMLの記述の仕方」を参照に作成した
       | -- など         HTMLファイルを置く）
       |
       | -- /dicomviewer/ （ここにダウンロードしたClassFileを展開する）
       |        |
       |        | -- Viewer.class
       |        | -- など
       |
       | -- /data/ （ここにDICOMファイルをおくとよいかも）
                |
                | -- sample.dcm
                | -- など

[Java の設定]
Sun SDK 1.4.2_06により開発を行ったため、SunのJRE 1.4.2_06以上をインストールしてください。
   -->http://java.sun.com/j2se/1.4.2/ja/download.html

JPEGによる転送構文がJPEG可逆圧縮等ではさらに設定が必要です。
Java Advanced Imaging Image I/O Tools を導入してください。
   -->http://java.sun.com/products/java-media/jai/index.jsp

さらに、.java.policy設定ファイルを設定しAppletでJAI ImageI/O Toolsが利用できるようにします。
JREをインストール後のフォルダを「C:\Program Files\java\jre」とした例で説明します。
「C:\Program Files\java\jre\lib\security」内にある.java.policyファイルを
Windows:「C:\Documents and Settings\User」
UNIX   :「/home/User/」
にコピーしてください。
その後.java.policyに下記を追記してください。
追記例:
   grant codeBase "http://hogehoge.ho.ge/" {                                   //Appletを置いてあるURL
      permission java.lang.RuntimePermission "loadLibrary.*";                  //固定
      permission java.util.PropertyPermission "*", "read";                     //固定
      permission java.io.FilePermission "C:\\Program Files\\java\\-", "read";  //JREを置いてあるローカルフォルダ
   };

また、JPEG画像等、対応している画像の種類については下記のURLで確認できます。
   -->http://mars.elcom.nitech.ac.jp/dicom/check-jpeg.html

その時、.java.policyに下記を追記してください。
追記例：
  grant codeBase "http://mars.elcom.nitech.ac.jp/dicom/"{                    //固定
    permission java.lang.RuntimePermission "loadLibrary.*";                  //固定
    permission java.util.PropertyPermission "*", "read";                     //固定
    permission java.io.FilePermission "C:\\Program Files\\java\\-", "read";  //JREを置いてあるローカルフォルダ
  };

設定が正しければ[JPEG 2000],[JPEG-LOSSLESS]等画像の種類がいくつか出ます。
出ない場合は設定を見直してください。

[HTMLの記述の仕方]
  * <APPLET>
    - CODE: "dicomviewer.Viewer.class"のまま記述してください。
    - NAME: "Viewer.java"のまま記述してください。
    - WIDTH: Viewerを表示する幅を指定します。
    - HEIGHT: Viewerを表示する高さです。
  * <PARAM>
    - tmpSize: 一度にメモリ上にロードする枚数（デフォルトは10）
    - NUM: 読み込む全体の枚数（デフォルトは1）
    - currentNo: 最初に見る画像番号（デフォルトは0）
    - dicURL: DICOM辞書のURL
    - imgURL??: 画像のURL

  ※詳しいHTMLの書き方については、HTMLの参考書を読んでください。

sample.html（サンプル）
-------------------------------------------------------------------------------
<HTML>
<HEAD>
<TITLE>
DICOM Viewer
</TITLE>
</HEAD>
<BODY>
<APPLET
  CODEBASE = "."
  CODE = "dicomviewer.Viewer.class"
  NAME = "Viewer.java"
  WIDTH = 100%
  HEIGHT = 100%
  HSPACE = 0
  VSPACE = 0
  ALIGN = middle >
<PARAM NAME = "tmpSize" VALUE = "10">
<PARAM NAME = "NUM" VALUE = "5">
<PARAM NAME = "currentNo" VALUE = "0">
<PARAM NAME = "dicURL" VALUE = "http://hoge.com/dicom/dicomviewer/Dicom.dic">
<PARAM NAME = "imgURL0" VALUE = "http://hoge.com/dicom/data/CT.531.1.dcm">
<PARAM NAME = "imgURL1" VALUE = "http://hoge.com/dicom/data/CT.531.2.dcm">
<PARAM NAME = "imgURL2" VALUE = "http://hoge.com/dicom/data/CT.531.3.dcm">
<PARAM NAME = "imgURL3" VALUE = "http://hoge.com/dicom/data/CT.531.4.dcm">
<PARAM NAME = "imgURL4" VALUE = "http://hoge.com/dicom/data/CT.531.5.dcm">
</APPLET> 
</BODY>
</HTML> 
-------------------------------------------------------------------------------

[著作権]
  Copyright(C) 2000,
  Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji

  本プログラムの全ての著作権は、名古屋工業大学電気情報工学科 岩田研究室
  および、加藤子 貴洋 が有します。

  本プログラムはフリー・ソフトウェアです。あなたは、Free Software Foundation 
  が公表したGNU 一般公有使用許諾の「バージョン２」或いはそれ以降の各バージョ
  ンの中からいずれかを選択し、そのバージョンが定める条項に従って本プログラム
  を再頒布または変更することができます。

  本プログラムは有用とは思いますが、頒布にあたっては、市場性及び特定目的適合
  性についての暗黙の保証を含めて、いかなる保証も行ないません。詳細については
  GNU 一般公有使用許諾書をお読みください。

[謝辞]
  本プログラムの作成に当たり、多くの御指導、御助言を頂きました藤田保健衛生大
  学医学部 江本 豊 講師、藤田保健衛生大学衛生学部 武藤 晃一 講師、藤田保健衛
  生大学総合医科学研究所 長嶋 宏和 助手に深く感謝致します。

  また、本プログラムは名古屋工業大学電気情報工学科 岩田 彰 教授を始めとして、
  岩田研究室の諸氏ならびに卒業生の皆様方無しには成立し得なかったことを改めて
  認知するとともに、皆様方に感謝致します。
