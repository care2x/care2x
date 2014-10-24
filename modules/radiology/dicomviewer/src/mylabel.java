/*
 * MyLabel.java
 *
 * イベントを取得できるラベル
 *
 * @see http://java-house.etl.go.jp/ml/archive/j-h-b/003638.html#body
 *
 * Modified by Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 */

package dicomviewer;

import java.applet.*;
import java.awt.*;
import java.awt.event.*;
import java.net.*;

public class MyLabel extends Canvas {
    public static final int LEFT   = Label.LEFT;
    public static final int CENTER = Label.CENTER;
    public static final int RIGHT  = Label.RIGHT;

    private String label;
    private int alignment;
    private static final int hgap = 5;
    private static final int vgap = 3;

    // ViewerのAppletContextを格納する
    AppletContext appletContext;

    // 文字の色(default: black)
    Color color = Color.black;

    public MyLabel() {
	    this("", LEFT);
    }

    public MyLabel(String label) {
	    this(label, LEFT);
    }

    public MyLabel(String label, int alignment) {
	    this.label = label;
	    this.alignment = alignment;

      // マウスイベントを取得するよう改変
      this.addMouseListener(new MyMouseListener());
    }

    public void setText(String text) {
	    label = text;
	    repaint();
    }

    public String getText() {
	    return label;
    }

    public void setAlignment(int alignment) {
	    this.alignment = alignment;
	    repaint();
    }

    public int getAlignment() {
	    return alignment;
    }

    public Dimension preferredSize() {
	    Font f = getFont();
	    int height = getFont().getSize();
	    int width = getFontMetrics(getFont()).stringWidth(label);
	    return new Dimension(width + hgap * 2, height + vgap * 2);
    }

    public Dimension minimumSize() {
	    Font f = getFont();
	    int height = getFont().getSize();
	    int width = getFontMetrics(getFont()).stringWidth(label);
	    return new Dimension(width, height);
    }

    public void paint(Graphics g) {
	    Dimension area = size();
	    Font f = g.getFont();
	    int w = g.getFontMetrics().stringWidth(label);
	    int h = f.getSize();
	    int x;
	    switch (alignment) {
	      // case LEFT:
	      default:
	        x = area.width - w > hgap ? hgap : 0;
	        break;
	      case CENTER:
	        x = (area.width - w) / 2;
	        break;
	      case RIGHT:
	        x = area.width - w - (area.width - w > hgap ? hgap : 0);
	        break;
	    }
	    int y = (area.height + h) / 2 - g.getFontMetrics(f).getMaxDescent();

      // 文字の色を決定する
      g.setColor(color);

	    g.drawString(label, x, y);
    }

    // AppletContextを受け取る
    public void setAppletContext(AppletContext appletContext) {
      this.appletContext = appletContext;
    }

  // マウス操作リスナー
  class MyMouseListener extends MouseAdapter {

    // マウスがCanvas内に入ったとき
    public void mouseEntered(MouseEvent e) {
      // カーソルの形を手にする
      setCursor(new Cursor(Cursor.HAND_CURSOR));
      // 文字の色を青くする
      color = Color.blue;
      repaint();
    }

    // マウスがCanvas外にでたとき
    public void mouseExited(MouseEvent e) {
      // カーソルの形を元に戻す
    	setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
      // 文字の色を黒くする
      color = Color.black;
      repaint();
    }

    // マウスを押したときの処理
    public void mousePressed(MouseEvent e) {
      try {
        URL url = new URL("http://mars.elcom.nitech.ac.jp/dicom/index-e.html");

        // DICOM Viewer (Java Applet)　のページを新しいウィンドウに表示する
        appletContext.showDocument(url, "_blank");
      }
      catch(Exception exception){
    	  System.out.println("Exception: " + exception.getMessage() );
      }
    }

    // マウスを離したときの処理
    public void mouseReleased(MouseEvent e) {
    }

  }

}
