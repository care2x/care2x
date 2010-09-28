/*
 * LoaderThread.java -
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */
package src;

public class LoaderThread extends Thread {

    int debug_level = 3;
    Viewer parent;
    int start, end;
    boolean isInc;

    public LoaderThread(int start, int len, int start_old, Viewer applet) {
        parent = applet;
        this.start = start;
        this.end = start + len;
        this.isInc = (start - start_old >= 0);
    }

    public void run() {
//    synchronized (parent.dicomData_tmp) {
//    synchronized (parent.imageData_tmp) {
        if (isInc) {
            for (int i = start; i < end; i++) {

                if (parent.confirmStopRequest()) {

                    if (debug_level > 3) {
                        System.out.println(" Stoped!");
                    }
                    parent.changeStopRequest(false);
                    return;
                }


                if (debug_level > 3) {
                    System.out.print(i);
                }


                if (parent.index[i] == -1) {

                    parent.index[i] = -2;


                    if (debug_level > 3) {
                        System.out.print(")");
                    }


                    parent.postData(i, start, end);
                }

                if (debug_level > 3) {
                    System.out.print(" ");
                }
            }
        } else {
            for (int i = end - 1; i >= start; i--) {

                if (parent.confirmStopRequest()) {

                    if (debug_level > 3) {
                        System.out.println(" Stoped!");
                    }
                    parent.changeStopRequest(false);
                    return;
                }


                if (debug_level > 3) {
                    System.out.print(i);
                }


                if (parent.index[i] == -1) {

                    parent.index[i] = -2;


                    if (debug_level > 3) {
                        System.out.print(")");
                    }


                    parent.postData(i, start, end);
                }


                if (debug_level > 3) {
                    System.out.print(" ");
                }
            }
        }
        parent.showStatus("Dicom Data Load Done.");

        if (debug_level > 3) {
            System.out.println();
        }


        parent.changeStopRequest(false);
    }
}
