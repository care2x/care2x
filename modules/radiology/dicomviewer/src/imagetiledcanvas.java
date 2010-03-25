/*
 * ImageTiledCanvas.java - イメージを並べて表示
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

import java.awt.*;
import java.awt.event.*;
import java.awt.image.*;
import java.applet.*;

public class ImageTiledCanvas extends Canvas {

  Viewer    parent;

  Image[]   image;                  // 描画するDICOMイメージ
  Dimension canvasSize;             // これのサイズ
  int       width, height;          // 元画像のサイズ
  int       imgW, imgH;             // 1枚の画像の描画サイズ
  int       px = 0, py = 0;         // 元画像のこの座標からを表示する
  int       x0, y0, x1, y1, x2, y2; // マウスのポイント座標（マウスプレス、ドラッグ、リリース）
  double    zoom = 1.0;             // 拡大縮小率
  int       zoomW, zoomH;           // 元画像のこの幅を表示する
  boolean   zoom_flag = false;      // マウスでZOOMを変更するかどうか？
  boolean   hand = true; 		        // カーソルの形
  boolean   loupe = false;          // ルーペを描画するかどうか？
  boolean   mouseDown;              // マウスが押されている常態かどうか？
  boolean   move = false;           // 画像の描画位置を移動させる。

  int       tileR, tileC;           // 分割数（行、列）
  int       imageIndex;             // セットされている画像枚数

  int       activeNo = 0;           // 注目画像番号
  boolean   changeActive = false;   // 注目画像がマウスのクリックによって変化したか？
  int       start =0;               // 描画する画像のスタート番号

  // 検査情報の表示関連
  boolean   showStudyInfo = true;   // 検査情報を表示するかどうか？
  String[]  patientID;              // (0010,0020)
  String[]  patientName;            // (0010,0010)
  String[]  patientAgeSex;          // (0010,1010) (0010,0040)
  String[]  studyID;                // (0020,0010)
  String[]  studyDate;              // (0008,0020)
  String[]  studyTime;              // (0008,0030)
  String[]  imageNo;                // (0020,0013)
  String[]  ww_wl;                  // 現在のWW/WL

  Font      font;                   // 検査情報表示用のフォント
  FontMetrics fm;                   // そのFontMetrics

  // コンストラクタ
  public ImageTiledCanvas(int w, int h, Viewer applet){
    parent = applet;
    zoomH = height = imgH = h;
    zoomW = width  = imgW = w;
    // マウスプレス、リリース時のイベントを設定
    addMouseListener(new SetPoint());
    // マウスドラッグ時のイベントを設定
    addMouseMotionListener(new SetPoint_move());
    // フォントの作成
    font = new Font("Helvetica", Font.PLAIN, 12);
    fm = getFontMetrics(font);
  }

  // ならべる数を設定する。
  // このメソッドの呼び出し後でないと、画像はaddできない。
  public void setTileType(int r, int c) {
    int max = r * c;

    // 分割数の取得
    tileR = r;
    tileC = c;
    // 分割数に応じてこれ自身の大きさを変化させる
    canvasSize = new Dimension(width * tileC, height * tileR);
    setSize(canvasSize);
    // 分割数に応じて変数の確保
    image           = new Image[max];
    patientID       = new String[max];
    patientName     = new String[max];
    patientAgeSex   = new String[max];
    studyID         = new String[max];
    studyDate       = new String[max];
    studyTime       = new String[max];
    imageNo         = new String[max];
    ww_wl           = new String[max];
    imageIndex = 0;
  }

  // イメージを最後に追加する。
  // すでに表示できるかずだけ表示している場合は、
  // 先頭を削除して追加する。
  public void addImage(Image argImage) {
    if(imageIndex < image.length) {
      image[imageIndex] = argImage;
      imageIndex++;
    } else {
      System.arraycopy(image, 1, image, 0, image.length -1);
      image[imageIndex -1] = argImage;
    }
    repaint();
  }

  // イメージを先頭に追加する。
  // すでに最大数表示している場合は、最後を削除する。
  public void addPreImage(Image argImage) {
    System.arraycopy(image, 0, image, 1, image.length -1);
    image[0] = argImage;
    if(imageIndex < image.length) imageIndex++;
    repaint();
  }

  // イメージをindexにセットする。
  public void setImage(Image argImage, int index) {
    image[index] = argImage;
    imageIndex = index;
    repaint();
  }

  // 検査情報を表示するかしないかをセットする
  public void setStudyInfo_flag(boolean flag){
    showStudyInfo = flag;
    repaint();
  }

  // 検査情報をindexにセットする
  public void setStudyInfo(DicomData dicomData, int index) {
    String tag;

    // 検査の情報がなければNullを代入
    if(dicomData == null) {
      patientID[index] = null;
      patientName[index] = null;
      patientAgeSex[index] = null;
      studyID[index] = null;
      studyDate[index] = null;
      studyTime[index] = null;
      imageNo[index] = null;
      ww_wl[index] = null;

    // 検査情報が存在する場合、それぞれのタグを調べて値をセット
    }else {
      tag = "(0010,0020)";
      if(dicomData.isContain(tag))
        patientID[index] = dicomData.getAnalyzedValue(tag);
      else
        patientID[index] = null;

      tag = "(0010,0010)";
      if(dicomData.isContain(tag))
        patientName[index] = dicomData.getAnalyzedValue(tag);
      else
        patientName[index] = null;

      tag = "(0010,1010)";
      if(dicomData.isContain(tag)) {
        patientAgeSex[index] = dicomData.getAnalyzedValue(tag);
        tag = "(0010,0040)";
        if(dicomData.isContain(tag))
          patientAgeSex[index] += " " + dicomData.getAnalyzedValue(tag);
      }else {
        tag = "(0010,0040)";
        if(dicomData.isContain(tag))
          patientAgeSex[index] = dicomData.getAnalyzedValue(tag);
        else
          patientAgeSex[index] = null;
      }

      tag = "(0020,0010)";
      if(dicomData.isContain(tag))
        studyID[index] = dicomData.getAnalyzedValue(tag);
      else
        studyID[index] = null;

      tag = "(0008,0020)";
      if(dicomData.isContain(tag))
        studyDate[index] = dicomData.getAnalyzedValue(tag);
      else
        studyDate[index] = null;

      tag = "(0008,0030)";
      if(dicomData.isContain(tag))
        studyTime[index] = dicomData.getAnalyzedValue(tag);
      else
        studyTime[index] = null;

      tag = "(0020,0013)";
      if(dicomData.isContain(tag))
        imageNo[index] = dicomData.getAnalyzedValue(tag);
      else
        imageNo[index] = null;
    }
  }

  // 表示用のWW/WLの値をセットする
  public void setWW_WL(int ww, int wl, int index) {
    ww_wl[index] = "" + wl + "/" + ww;
  }

  // index番のイメージを交換する。
  public void changeImage(Image argImage, int index) {
    image[index] = argImage;
    repaint();
  }

  // 注目画像番号をセットする
  public void setActiveNo(int index) {
    this.activeNo = index;
  }

  // 最初に表示する画像の画像番号
  public void setStartNo(int start_imgNo) {
    start = start_imgNo;
  }

  // キャンバスサイズを変更する
  public void setCanvasSize(int w, int h) {
    canvasSize = new Dimension(w, h);
    setSize(canvasSize);
    repaint();
  }

  public void paint(Graphics g) {
    update(g);
  }

  public void update(Graphics g)
  {
    // マウスを押して離した分だけイメージを移動させる。
    // 但し、はじっこ以上動かないようにする
    if(px+zoomW > imgW) px = imgW - zoomW;
    if(py+zoomH > imgH) py = imgH - zoomH;
    if(px < 0) px = 0;
    if(py < 0) py = 0;

    // オフスクリーンの準備(画像一枚分、Loupe用)
    Graphics  offg, loupeg;
    Image     offImage, loupeImage;
    offImage = createImage(width, height);
    offg = offImage.getGraphics();
    loupeImage = createImage(200, 200);
    loupeg = loupeImage.getGraphics();

    int imgNo = 0;
    int tmp_x, tmp_y;

    // イメージを描く
    for (int j=0; j < tileR; j++) {
      if(imgNo > imageIndex) break;
      for (int i=0; i < tileC; i++) {
        if(imgNo > imageIndex) break;

        // 画像を描く座標を求める
        tmp_x = width * i;
        tmp_y = height * j;

        // イメージを描く
        // まず、画像1枚をオフスクリーンに描画
        // 画像が存在しない場合
        if(image[imgNo] == null){
          // 黒く塗りつぶす
          offg.setColor(Color.black);
          offg.fillRect(0, 0, width, height);
        // 画像が存在する場合
        }else {
          // 元画像の(px,py)座標から幅zoomW、高さzoomH分のイメージを取得してきて、
          // (0,0)座標から、オフスクリーンいっぱいに画像を描画
          offg.drawImage(image[imgNo], 0, 0, width, height, px, py, px+zoomW, py+zoomH, this);
        }
        // 完成したオフスクリーンを(tmp_x,tmp_y)座標に描画
        g.drawImage(offImage, tmp_x, tmp_y, this);

        // 検査情報を描く
        if(showStudyInfo) {
          int x, y;           // 検査情報を書く座標
          int maxlength = 0;  // 文字列の長さ

          // 検査情報はグリーンで描画
          g.setColor(Color.green);
          g.setFont(font);
          // 左上
          x = tmp_x +2;
          y = tmp_y + fm.getAscent() +2;
          if(patientID[imgNo] != null) {
            g.drawString(patientID[imgNo], x, y);
            y += fm.getHeight();
          }
          if(patientName[imgNo] != null) {
            g.drawString(patientName[imgNo], x, y);
            y += fm.getHeight();
          }
          if(patientAgeSex[imgNo] != null) {
            g.drawString(patientAgeSex[imgNo], x, y);
          }
          // 左下
          y = tmp_y + height - fm.getDescent() -2;
          if(ww_wl[imgNo] != null) {
            g.drawString(ww_wl[imgNo], x, y);
          }
          // 右上
          // 文字列の長さがもっとも長いものを探す
          if(maxlength < fm.stringWidth(studyID[imgNo])) maxlength = fm.stringWidth(studyID[imgNo]);
          if(maxlength < fm.stringWidth(studyDate[imgNo])) maxlength = fm.stringWidth(studyDate[imgNo]);
          if(maxlength < fm.stringWidth(studyTime[imgNo])) maxlength = fm.stringWidth(studyTime[imgNo]);
          x = tmp_x + width - maxlength -2;
          y = tmp_y + fm.getAscent() +2;
          if(studyID[imgNo] != null) {
            g.drawString(studyID[imgNo], x, y);
            y += fm.getHeight();
          }
          if(studyDate[imgNo] != null) {
            g.drawString(studyDate[imgNo], x, y);
            y += fm.getHeight();
          }
          if(studyTime[imgNo] != null) {
            g.drawString(studyTime[imgNo], x, y);
          }
          // 右下
          x = tmp_x + width - fm.stringWidth(imageNo[imgNo]) -2;
          y = tmp_y + height - fm.getDescent() -2;
          if(imageNo[imgNo] != null) {
            g.drawString(imageNo[imgNo], x, y);
          }
        }

        // イメージの輪郭を描く
        // 選択画像が変化した場合
        if(changeActive) {
          // マウスのクリックした座標が今描画する画像上の場合
          if((tmp_x <= x1) && (x1 < tmp_x+width) && (tmp_y <= y1) && (y1 < tmp_y+height))  {
            // 画像が存在しない場所のクリックの場合は白枠（選択画像変化なし）
            if(image[imgNo] == null){
              g.setColor(Color.white);
              g.drawRect(tmp_x, tmp_y, width -1, height -1);
            // 画像が存在する場合は、選択画像を今の画像にして、黄色枠を引く
            }else {
              // activeNoの変更
              activeNo = imgNo;
              parent.changeActive(activeNo + start);
              g.setColor(Color.yellow);
              g.drawRect(tmp_x, tmp_y, width -1, height -1);
            }
          // マウスのクリックがこの画像上でない場合、白枠を引く
          }else {
            g.setColor(Color.white);
            g.drawRect(tmp_x, tmp_y, width -1, height -1);
          }

        // 選択画像が変化しない場合
        }else {
          // 選択画像なら黄色枠
          if(activeNo == imgNo) {
            g.setColor(Color.yellow);
            g.drawRect(tmp_x, tmp_y, width -1, height -1);
          // 選択画像でないならば、白枠
          }else {
            g.setColor(Color.white);
            g.drawRect(tmp_x, tmp_y, width -1, height -1);
          }
        }
        // ルーペを作る
        if(loupe && mouseDown) {
          // クリックした座標が今描画している画像上の場合ルーペを作る
          if((tmp_x <= x1) && (x1 < tmp_x+width) && (tmp_y <= y1) && (y1 < tmp_y+height))  {
            // クリックした座標の前後50ピクセルずつ合計縦横100ピクセル取得し、
            // 縦横200ピクセルのオフスクリーンに描画する（つまり、2倍に表示される）
            loupeg.drawImage(offImage, 0, 0, 200, 200, x1-tmp_x-50, y1-tmp_y-50, x1-tmp_x+50, y1-tmp_y+50,this);
          }
        }
        imgNo++;
      }
    } // for文の終わり

    changeActive = false;

    // ルーペを描く
    if(loupe && mouseDown) {
      // クリックした座標の真中になるようにルーペオフスクリーンを描画
      g.drawImage(loupeImage, x1-100, y1-100, this);
      // ルーペ画像の周りに白枠を描画
      g.setColor(Color.white);
      g.drawRect(x1-100, y1-100, 200, 200);
    }
  }

  // ズーム率を変更するメソッド
  public void changeZoom(double zoom){
    this.zoom = zoom;
    int zoomW_old = zoomW;
    int zoomH_old = zoomH;
    int px_old = px;
    int py_old = py;

    // ズームの設定
    zoomW = (int)(width * zoom);
    zoomH = (int)(height * zoom);

    // 画像の中心を表示するように拡大縮小するようにする
    px = (int)((zoomW_old - zoomW) >> 1) + px_old;
    py = (int)((zoomH_old - zoomH) >> 1) + py_old;

    repaint();
  }

  // CanvasSizeを変更するメソッド
  public void changeCanvasSize(double size) {
    width = (int)(imgW * size);
    height = (int)(imgH * size);
    canvasSize.setSize(width * tileC, height * tileR);
    setSize(canvasSize);
  }

  // 見ている視点（座標）を変更する
  public void setPxPy(int x, int y) {
    this.px = x;
    this.py = y;
  }

  // 見ている視点（座標）を得る
  public int getPx() {
    return px;
  }
  public int getPy() {
    return py;
  }

  // ルーペを描画するかどうかセットする
  public void setLoupeState(boolean state) {
    this.loupe = state;
  }

  // 画像をマウスで移動するかどうかセットする
  public void setMoveState(boolean state) {
    this.move = state;
  }

  // 画像をマウスで拡大縮小するかどうかセットする
  public void setZoomState(boolean state) {
    this.zoom_flag = state;
  }

  // マウスカーソルの形を変更するメソッド
  private void changeCursor(){
    if(hand)
    	this.setCursor(new Cursor(Cursor.MOVE_CURSOR));
    else
    	this.setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
    hand = !hand;
  }

  // マウス操作リスナー
  class SetPoint extends MouseAdapter {

    // マウスがCanvas内に入ったとき
    public void mouseEntered(MouseEvent e) {
      if(loupe) {
    	  setCursor(new Cursor(Cursor.CROSSHAIR_CURSOR));
      }else if(move) {
    	  setCursor(new Cursor(Cursor.HAND_CURSOR));
      }
    }

    // マウスがCanvas外にでたとき
    public void mouseExited(MouseEvent e) {
    	setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
    }

    // マウスを押したときの処理
    public void mousePressed(MouseEvent e) {
      x0 = x1 = e.getX();
      y0 = y1 = e.getY();
      if(loupe) {
        mouseDown = true;
      }else if(!move) {
        changeCursor(); // カーソルの形を変更
      }
      changeActive = true;
      repaint();
    }

    // マウスを離したときの処理
    public void mouseReleased(MouseEvent e) {
      x2 = e.getX();
      y2 = e.getY();
      if(loupe) {
        mouseDown = false;
        repaint();
      }else if(move) {
        px = px + x1 - x2;
        py = py + y1 - y2;
        repaint();
      }else if(zoom_flag) {
        changeCursor(); // カーソルの形を戻す
        parent.drag_changeZoom(y2-y1);
      }else {
        changeCursor(); // カーソルの形を戻す
        parent.dragDone_changeWwWl(x2-x1, x2-x0, y2-y1, y2-y0);
      }
    }
  }

  class SetPoint_move extends MouseMotionAdapter {

    // マウスがドラッグされたとき
    public void mouseDragged(MouseEvent e) {
      x2 = e.getX();
      y2 = e.getY();
      if(move) {
        px = px + x1 - x2;
        py = py + y1 - y2;
        x1 = x2;
        y1 = y2;
        repaint();

      // Zoom
      }else if(zoom_flag) {
        parent.drag_changeZoom(y2-y1);
        x1 = x2;
        y1 = y2;

      // WW/WL
      }else if(!loupe) {
        parent.drag_changeWwWl(x2-x1, y2-y1);
        x1 = x2;
        y1 = y2;
/*
      // Loupe
      }else {
        x1 = x2;
        y1 = y2;
        repaint();
*/
      }
    }

    public void mouseMoved(MouseEvent e) {
    }
  }
}

