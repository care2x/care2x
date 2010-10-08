===============================================================================
 [Program Name] DICOM Viewer (Java Applet) Ver.0.5.4α
 [Archive Name] dicomviewer054.zip
 [Author] 加藤子 貴洋(かとうじ たかひろ)
          E-mail: katoco@mars.elcom.nitech.ac.jp or katoco@tomo.ne.jp
 [Web site] http://mars.elcom.nitech.ac.jp/dicom/
 [Development Language] Sun JDK 1.1.5
===============================================================================

 *****************************************************************************

     この DICOM Viewer は、InternetExplorerやNetscapeNavigatorなどといった
  汎用のWWWブラウザを使用して、 DICOMファイルの閲覧、処理を可能とするものです。

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

[使用方法]
  クラスファイルをダウンロードし、Webから参照できる以下の例のような
  ディレクトリに解凍してください。そして、HTMLの記述の仕方にそってHTMLファイル
  を用意します。あとは、 WWWブラウザから作成したHTMLファイルにアクセスすると、
  DICOM Viewer が起動します。
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
