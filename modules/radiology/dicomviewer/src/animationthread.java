/*
 * AnimationThread.java - マルチスライスの画像をアニメーションさせるスレッド
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

public class AnimationThread extends Thread {

  // フィールド
  Viewer  parent;
  boolean isStop = false;   // 停止命令のフラグ
  boolean isNext = true;    // 再生か、巻き戻しか？(再生：true）
  int     interval = 1000;  // アニメーション間隔(ms)

  // コンストラクタ
  public AnimationThread(Viewer applet) {
    this.parent = applet;
  }

  // run()
  public void run() {
    while(!isStop) {
      // 次の画像を見る
      if(isNext) nextImage();
      // 前の画像を見る
      else prevImage();

      // Sleep
      try{ Thread.sleep(interval);
      }catch(InterruptedException e) {}
    }
  }

  // アニメーション間隔を変更する
  public void changeInterval(int intarval) {
    this.interval = intarval;
  }

  // 自然にストップするように
  public void requestStop() {
    isStop = true;
  }

  // 画像を次にするのか前のにするのか
  public void changeNext(boolean flag) {
    isNext = flag;
  }

  // 画像を次にめくる
  private void nextImage() {
    parent.imageNo_old = parent.imageNo;
    if(parent.imageNo < (parent.NUM -1)){
      parent.imageNo += 1;
    }else {
      parent.imageNo = 0;
    }
    parent.imageNo_S.setValue(parent.imageNo +1);
    parent.imageNo_F.setText(String.valueOf(parent.imageNo +1));
    parent.changeImageNo();
  }

  // 画像を前のにする
  private void prevImage() {
    parent.imageNo_old = parent.imageNo;
    if(parent.imageNo > 0) {
      parent.imageNo -= 1;
    }else {
      parent.imageNo = parent.NUM -1;
    }
    parent.imageNo_S.setValue(parent.imageNo +1);
    parent.imageNo_F.setText(String.valueOf(parent.imageNo +1));
    parent.changeImageNo();
  }
}