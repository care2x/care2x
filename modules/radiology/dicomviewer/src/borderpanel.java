/**
 * BorderPanel.java
 *
 * ラベルと立体的な枠線が表示されるパネル。
 * ラベル付きの場合、パネルの下に少し余白ができる。
 * レイアウトは FlowLayout のみに対応。
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

public class BorderPanel extends Panel {
  boolean isLabelNull = true; // ラベル付きかどうか？(ラベルなし:true)
  Color color;                // 元となる色
  Color upLeft, downRight;    // 元の色の少し濃い色と薄い色
  String label;               // ラベル
  Font font;                  // ラベルを表示するフォント
  FontMetrics fm;

  // コンストラクタ
  // ラベルなし
  public BorderPanel() {
    // フォントの設定
    font = new Font("Dialog", Font.PLAIN, 12);
    fm = getFontMetrics(font);
    // レイアウトの設定
    super.setLayout(new FlowLayout(FlowLayout.LEFT, 5, 5));
  }
  // ラベル付き
  public BorderPanel(String label) {
    isLabelNull = false;
    // フォントの設定
    font = new Font("Dialog", Font.PLAIN, 12);
    fm = getFontMetrics(font);
    // ラベルの取得
    this.label = label;
    // レイアウトの設定
    super.setLayout(new FlowLayout(FlowLayout.CENTER, 5, fm.getHeight()));
  }

  // setLayoutのオーバーライド
  public void setLayout(LayoutManager mgr) {
    // 何もしない。つまりレイアウトの変更を許さない。
  }

  // ラベル、枠線の描画
  public void paint(Graphics g){
    // 色の設定
    color = Color.gray;
	upLeft = color.darker();
    downRight = color.brighter();
    // 描画のための大きさ
    int width, height, fmHeightHalf, stringWidth;

    // 立体的な枠線とラベルを描く
    // ラベルなしの場合
    if(isLabelNull) {
      // 大きさの所得
      width = (int)this.getSize().width;
      height = (int)this.getSize().height;
      fmHeightHalf = 0;

      // 上の線
      g.setColor(upLeft);
      g.drawLine(0, 0, width -1, 0);
      g.setColor(downRight);
      g.drawLine(1, 1, width -2, 1);

    // ラベル付きの場合
    }else {
      // 大きさの所得
      width = (int)this.getSize().width;
      height = (int)this.getSize().height - fm.getHeight() +5;
      fmHeightHalf = fm.getAscent() >> 1;
      stringWidth = fm.stringWidth(label);

      // ラベルの描画
      g.setFont(font);
      g.setColor(Color.black);
      g.drawString(label, fm.getAscent(), 10);

      // 上の線
      g.setColor(upLeft);
      g.drawLine(0, fmHeightHalf, 7, fmHeightHalf);
      g.drawLine(stringWidth +16, fmHeightHalf, width -1, fmHeightHalf);
      g.setColor(downRight);
      g.drawLine(1, fmHeightHalf +1, 7, fmHeightHalf +1);
      g.drawLine(stringWidth +16, fmHeightHalf +1, width -2, fmHeightHalf +1);
    }

    // ラベルなし、ラベル付きとも共通
    // 左の線
    g.setColor(upLeft);
    g.drawLine(0, fmHeightHalf, 0, height -1);
    g.setColor(downRight);
    g.drawLine(1, fmHeightHalf +1, 1, height -2);
    // 下の線
    g.setColor(upLeft);
    g.drawLine(1, height -2, width -2, height -2);
    g.setColor(downRight);
    g.drawLine(0, height -1, width -1, height -1);
    // 右の線
    g.setColor(upLeft);
    g.drawLine(width -2, fmHeightHalf +1, width -2, height -2);
    g.setColor(downRight);
    g.drawLine(width -1, fmHeightHalf, width -1, height -1);
  }

  // updataメソッドのオーバーライド（描画の効率化のために）
  public void updata(Graphics g){
    paint(g);
  }

}

