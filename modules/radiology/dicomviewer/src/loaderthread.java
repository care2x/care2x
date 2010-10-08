/*
 * LoaderThread.java - DICOMファイルをロードするスレッド
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

public class LoaderThread extends Thread{

  int       debug_level = 3;

  Viewer    parent;
  int       start, end;
  boolean   isInc;        // 画像番号は増えたのか？減ったのか？

  // コンストラクタ
  public LoaderThread(int start, int len, int start_old, Viewer applet) {
    parent = applet;
    this.start = start;
    this.end = start + len;
    this.isInc = (start - start_old >=0);
  }

  public void run() {
//    synchronized (parent.dicomData_tmp) {
//    synchronized (parent.imageData_tmp) {
      if(isInc) {
        for (int i=start; i < end; i++){
          // 停止要求がでていれば、停止する
          if(parent.confirmStopRequest()) {
            // デバッグ用
            if (debug_level > 3) System.out.println(" Stoped!");
            parent.changeStopRequest(false);
            return;
          }

          // デバッグ用
          if (debug_level > 3) System.out.print(i);

          // 必要なデータが、_tmpに入っているかどうか？
          if(parent.index[i] == -1) {
            // 作業中のフラグ。
            parent.index[i] = -2;

            // デバッグ用
            if (debug_level > 3) System.out.print(")");

            // データを読み出す
            parent.postData(i, start, end);
          }
          // 他に走行可能なスレッドがあれば、そちらに制御を移す
          //Thread.yield();

          // デバッグ用
          if (debug_level > 3) System.out.print(" ");
        }
      }else {
        for (int i= end -1; i >= start; i--){
          // 停止要求がでていれば、停止する
          if(parent.confirmStopRequest()) {
            // デバッグ用
            if (debug_level > 3) System.out.println(" Stoped!");
            parent.changeStopRequest(false);
            return;
          }

          // デバッグ用
          if (debug_level > 3) System.out.print(i);

          // 必要なデータが、_tmpに入っているかどうか？
          if(parent.index[i] == -1) {
            // 作業中のフラグ。
            parent.index[i] = -2;

            // デバッグ用
            if (debug_level > 3) System.out.print(")");

            // データを読み出す
            parent.postData(i, start, end);
          }
          // 他に走行可能なスレッドがあれば、そちらに制御を移す
          //Thread.yield();

          // デバッグ用
          if (debug_level > 3) System.out.print(" ");
        }
      }
      parent.showStatus("Dicom Data Load Done.");
      // デバッグ用
      if (debug_level > 3) System.out.println();

      // スレッドは停止するので、停止命令を解除
      parent.changeStopRequest(false);
//    }
//    }
  }
}
