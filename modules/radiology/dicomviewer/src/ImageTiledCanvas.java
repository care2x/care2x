/*
 * ImageTiledCanvas.java - 
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */
package src;

import java.awt.*;
import java.awt.event.*;
import java.awt.image.*;
import java.applet.*;

public class ImageTiledCanvas extends Canvas {

    Viewer parent;
    Image[] image;
    Dimension canvasSize;
    int width, height;
    int imgW, imgH;
    int px = 0, py = 0;
    int x0, y0, x1, y1, x2, y2;
    double zoom = 1.0;
    int zoomW, zoomH;
    boolean zoom_flag = false;
    boolean hand = true;
    boolean loupe = false;
    boolean mouseDown;
    boolean move = false;
    int tileR, tileC;
    int imageIndex;
    int activeNo = 0;
    boolean changeActive = false;
    int start = 0;
    boolean showStudyInfo = true;
    String[] patientID;
    String[] patientName;
    String[] patientAgeSex;
    String[] studyID;
    String[] studyDate;
    String[] studyTime;
    String[] imageNo;
    String[] ww_wl;
    Font font;
    FontMetrics fm;

    public ImageTiledCanvas(int w, int h, Viewer applet) {
        parent = applet;
        zoomH = height = imgH = h;
        zoomW = width = imgW = w;

        addMouseListener(new SetPoint());

        addMouseMotionListener(new SetPoint_move());

        font = new Font("Helvetica", Font.PLAIN, 12);
        fm = getFontMetrics(font);
    }

    public void setTileType(int r, int c) {
        int max = r * c;


        tileR = r;
        tileC = c;

        canvasSize = new Dimension(width * tileC, height * tileR);
        setSize(canvasSize);

        image = new Image[max];
        patientID = new String[max];
        patientName = new String[max];
        patientAgeSex = new String[max];
        studyID = new String[max];
        studyDate = new String[max];
        studyTime = new String[max];
        imageNo = new String[max];
        ww_wl = new String[max];
        imageIndex = 0;
    }

    public void addImage(Image argImage) {
        if (imageIndex < image.length) {
            image[imageIndex] = argImage;
            imageIndex++;
        } else {
            System.arraycopy(image, 1, image, 0, image.length - 1);
            image[imageIndex - 1] = argImage;
        }
        repaint();
    }

    public void addPreImage(Image argImage) {
        System.arraycopy(image, 0, image, 1, image.length - 1);
        image[0] = argImage;
        if (imageIndex < image.length) {
            imageIndex++;
        }
        repaint();
    }

    public void setImage(Image argImage, int index) {
        image[index] = argImage;
        imageIndex = index;
        repaint();
    }

    public void setStudyInfo_flag(boolean flag) {
        showStudyInfo = flag;
        repaint();
    }

    public void setStudyInfo(DicomData dicomData, int index) {
        String tag;


        if (dicomData == null) {
            patientID[index] = null;
            patientName[index] = null;
            patientAgeSex[index] = null;
            studyID[index] = null;
            studyDate[index] = null;
            studyTime[index] = null;
            imageNo[index] = null;
            ww_wl[index] = null;


        } else {
            tag = "(0010,0020)";
            if (dicomData.isContain(tag)) {
                patientID[index] = dicomData.getAnalyzedValue(tag);
            } else {
                patientID[index] = null;
            }

            tag = "(0010,0010)";
            if (dicomData.isContain(tag)) {
                patientName[index] = dicomData.getAnalyzedValue(tag);
            } else {
                patientName[index] = null;
            }

            tag = "(0010,1010)";
            if (dicomData.isContain(tag)) {
                patientAgeSex[index] = dicomData.getAnalyzedValue(tag);
                tag = "(0010,0040)";
                if (dicomData.isContain(tag)) {
                    patientAgeSex[index] += " " + dicomData.getAnalyzedValue(tag);
                }
            } else {
                tag = "(0010,0040)";
                if (dicomData.isContain(tag)) {
                    patientAgeSex[index] = dicomData.getAnalyzedValue(tag);
                } else {
                    patientAgeSex[index] = null;
                }
            }

            tag = "(0020,0010)";
            if (dicomData.isContain(tag)) {
                studyID[index] = dicomData.getAnalyzedValue(tag);
            } else {
                studyID[index] = null;
            }

            tag = "(0008,0020)";
            if (dicomData.isContain(tag)) {
                studyDate[index] = dicomData.getAnalyzedValue(tag);
            } else {
                studyDate[index] = null;
            }

            tag = "(0008,0030)";
            if (dicomData.isContain(tag)) {
                studyTime[index] = dicomData.getAnalyzedValue(tag);
            } else {
                studyTime[index] = null;
            }

            tag = "(0020,0013)";
            if (dicomData.isContain(tag)) {
                imageNo[index] = dicomData.getAnalyzedValue(tag);
            } else {
                imageNo[index] = null;
            }
        }
    }

    public void setWW_WL(int ww, int wl, int index) {
        ww_wl[index] = "" + wl + "/" + ww;
    }

    public void changeImage(Image argImage, int index) {
        image[index] = argImage;
        repaint();
    }

    public void setActiveNo(int index) {
        this.activeNo = index;
    }

    public void setStartNo(int start_imgNo) {
        start = start_imgNo;
    }

    public void setCanvasSize(int w, int h) {
        canvasSize = new Dimension(w, h);
        setSize(canvasSize);
        repaint();
    }

    public void paint(Graphics g) {
        update(g);
    }

    public void update(Graphics g) {
        if (px + zoomW > imgW) {
            px = imgW - zoomW;
        }
        if (py + zoomH > imgH) {
            py = imgH - zoomH;
        }
        if (px < 0) {
            px = 0;
        }
        if (py < 0) {
            py = 0;
        }


        Graphics offg, loupeg;
        Image offImage, loupeImage;
        offImage = createImage(width, height);
        offg = offImage.getGraphics();
        loupeImage = createImage(200, 200);
        loupeg = loupeImage.getGraphics();

        int imgNo = 0;
        int tmp_x, tmp_y;


        for (int j = 0; j < tileR; j++) {
            if (imgNo > imageIndex) {
                break;
            }
            for (int i = 0; i < tileC; i++) {
                if (imgNo > imageIndex) {
                    break;
                }


                tmp_x = width * i;
                tmp_y = height * j;

                if (image[imgNo] == null) {

                    offg.setColor(Color.black);
                    offg.fillRect(0, 0, width, height);

                } else {
                    offg.drawImage(image[imgNo], 0, 0, width, height, px, py, px + zoomW, py + zoomH, this);
                }
                g.drawImage(offImage, tmp_x, tmp_y, this);

                if (showStudyInfo) {
                    int x, y;
                    int maxlength = 0;

                    g.setColor(Color.green);
                    g.setFont(font);

                    x = tmp_x + 2;
                    y = tmp_y + fm.getAscent() + 2;
                    if (patientID[imgNo] != null) {
                        g.drawString(patientID[imgNo], x, y);
                        y += fm.getHeight();
                    }
                    if (patientName[imgNo] != null) {
                        g.drawString(patientName[imgNo], x, y);
                        y += fm.getHeight();
                    }
                    if (patientAgeSex[imgNo] != null) {
                        g.drawString(patientAgeSex[imgNo], x, y);
                    }

                    y = tmp_y + height - fm.getDescent() - 2;
                    if (ww_wl[imgNo] != null) {
                        g.drawString(ww_wl[imgNo], x, y);
                    }
                    if (maxlength < fm.stringWidth(studyID[imgNo])) {
                        maxlength = fm.stringWidth(studyID[imgNo]);
                    }
                    if (maxlength < fm.stringWidth(studyDate[imgNo])) {
                        maxlength = fm.stringWidth(studyDate[imgNo]);
                    }
                    if (maxlength < fm.stringWidth(studyTime[imgNo])) {
                        maxlength = fm.stringWidth(studyTime[imgNo]);
                    }
                    x = tmp_x + width - maxlength - 2;
                    y = tmp_y + fm.getAscent() + 2;
                    if (studyID[imgNo] != null) {
                        g.drawString(studyID[imgNo], x, y);
                        y += fm.getHeight();
                    }
                    if (studyDate[imgNo] != null) {
                        g.drawString(studyDate[imgNo], x, y);
                        y += fm.getHeight();
                    }
                    if (studyTime[imgNo] != null) {
                        g.drawString(studyTime[imgNo], x, y);
                    }

                    x = tmp_x + width - fm.stringWidth(imageNo[imgNo]) - 2;
                    y = tmp_y + height - fm.getDescent() - 2;
                    if (imageNo[imgNo] != null) {
                        g.drawString(imageNo[imgNo], x, y);
                    }
                }

                if (changeActive) {

                    if ((tmp_x <= x1) && (x1 < tmp_x + width) && (tmp_y <= y1) && (y1 < tmp_y + height)) {

                        if (image[imgNo] == null) {
                            g.setColor(Color.white);
                            g.drawRect(tmp_x, tmp_y, width - 1, height - 1);

                        } else {

                            activeNo = imgNo;
                            parent.changeActive(activeNo + start);
                            g.setColor(Color.yellow);
                            g.drawRect(tmp_x, tmp_y, width - 1, height - 1);
                        }

                    } else {
                        g.setColor(Color.white);
                        g.drawRect(tmp_x, tmp_y, width - 1, height - 1);
                    }


                } else {

                    if (activeNo == imgNo) {
                        g.setColor(Color.yellow);
                        g.drawRect(tmp_x, tmp_y, width - 1, height - 1);

                    } else {
                        g.setColor(Color.white);
                        g.drawRect(tmp_x, tmp_y, width - 1, height - 1);
                    }
                }

                if (loupe && mouseDown) {

                    if ((tmp_x <= x1) && (x1 < tmp_x + width) && (tmp_y <= y1) && (y1 < tmp_y + height)) {
                        loupeg.drawImage(offImage, 0, 0, 200, 200, x1 - tmp_x - 50, y1 - tmp_y - 50, x1 - tmp_x + 50, y1 - tmp_y + 50, this);
                    }
                }
                imgNo++;
            }
        }

        changeActive = false;


        if (loupe && mouseDown) {

            g.drawImage(loupeImage, x1 - 100, y1 - 100, this);

            g.setColor(Color.white);
            g.drawRect(x1 - 100, y1 - 100, 200, 200);
        }
    }

    public void changeZoom(double zoom) {
        this.zoom = zoom;
        int zoomW_old = zoomW;
        int zoomH_old = zoomH;
        int px_old = px;
        int py_old = py;


        zoomW = (int) (width * zoom);
        zoomH = (int) (height * zoom);

        px = (int) ((zoomW_old - zoomW) >> 1) + px_old;
        py = (int) ((zoomH_old - zoomH) >> 1) + py_old;

        repaint();
    }

    public void changeCanvasSize(double size) {
        width = (int) (imgW * size);
        height = (int) (imgH * size);
        canvasSize.setSize(width * tileC, height * tileR);
        setSize(canvasSize);
    }

    public void setPxPy(int x, int y) {
        this.px = x;
        this.py = y;
    }

    public int getPx() {
        return px;
    }

    public int getPy() {
        return py;
    }

    public void setLoupeState(boolean state) {
        this.loupe = state;
    }

    public void setMoveState(boolean state) {
        this.move = state;
    }

    public void setZoomState(boolean state) {
        this.zoom_flag = state;
    }

    private void changeCursor() {
        if (hand) {
            this.setCursor(new Cursor(Cursor.MOVE_CURSOR));
        } else {
            this.setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
        }
        hand = !hand;
    }

    class SetPoint extends MouseAdapter {

        public void mouseEntered(MouseEvent e) {
            if (loupe) {
                setCursor(new Cursor(Cursor.CROSSHAIR_CURSOR));
            } else if (move) {
                setCursor(new Cursor(Cursor.HAND_CURSOR));
            }
        }

        public void mouseExited(MouseEvent e) {
            setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
        }

        public void mousePressed(MouseEvent e) {
            x0 = x1 = e.getX();
            y0 = y1 = e.getY();
            if (loupe) {
                mouseDown = true;
            } else if (!move) {
                changeCursor(); // �J�[�\���̌`��ύX
            }
            changeActive = true;
            repaint();
        }

        public void mouseReleased(MouseEvent e) {
            x2 = e.getX();
            y2 = e.getY();
            if (loupe) {
                mouseDown = false;
                repaint();
            } else if (move) {
                px = px + x1 - x2;
                py = py + y1 - y2;
                repaint();
            } else if (zoom_flag) {
                changeCursor();
                parent.drag_changeZoom(y2 - y1);
            } else {
                changeCursor();
                parent.dragDone_changeWwWl(x2 - x1, x2 - x0, y2 - y1, y2 - y0);
            }
        }
    }

    class SetPoint_move extends MouseMotionAdapter {

        public void mouseDragged(MouseEvent e) {
            x2 = e.getX();
            y2 = e.getY();
            if (move) {
                px = px + x1 - x2;
                py = py + y1 - y2;
                x1 = x2;
                y1 = y2;
                repaint();

                // Zoom
            } else if (zoom_flag) {
                parent.drag_changeZoom(y2 - y1);
                x1 = x2;
                y1 = y2;

                // WW/WL
            } else if (!loupe) {
                parent.drag_changeWwWl(x2 - x1, y2 - y1);
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
