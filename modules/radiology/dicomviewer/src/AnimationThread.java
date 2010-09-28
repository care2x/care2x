/*
 * AnimationThread.java - 
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */
package src;

public class AnimationThread extends Thread {

    Viewer parent;
    boolean isStop = false;
    boolean isNext = true;
    int interval = 1000;

    public AnimationThread(Viewer applet) {
        this.parent = applet;
    }

    // run()
    public void run() {
        while (!isStop) {
            if (isNext) {
                nextImage();
            } else {
                prevImage();
            }

            // Sleep
            try {
                Thread.sleep(interval);
            } catch (InterruptedException e) {
            }
        }
    }

    public void changeInterval(int intarval) {
        this.interval = intarval;
    }

    public void requestStop() {
        isStop = true;
    }

    public void changeNext(boolean flag) {
        isNext = flag;
    }

    private void nextImage() {
        parent.imageNo_old = parent.imageNo;
        if (parent.imageNo < (parent.NUM - 1)) {
            parent.imageNo += 1;
        } else {
            parent.imageNo = 0;
        }
        parent.imageNo_S.setValue(parent.imageNo + 1);
        parent.imageNo_F.setText(String.valueOf(parent.imageNo + 1));
        parent.changeImageNo();
    }

    private void prevImage() {
        parent.imageNo_old = parent.imageNo;
        if (parent.imageNo > 0) {
            parent.imageNo -= 1;
        } else {
            parent.imageNo = parent.NUM - 1;
        }
        parent.imageNo_S.setValue(parent.imageNo + 1);
        parent.imageNo_F.setText(String.valueOf(parent.imageNo + 1));
        parent.changeImageNo();
    }
}
