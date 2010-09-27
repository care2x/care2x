/*
 * ImageData.java - 
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
import java.awt.image.*;

public class ImageData {

    int debug_level = 3;
    boolean blackANDwhite = true;
    boolean rgbMode = false;
    boolean inv = false;
    int pixel[];
    int orgPixel[];
    int pixLength;
    int pixelMin;
    int pixelMax;
    int width;
    int height;
    int histogram[] = new int[256];
    int histMax;
    int ww, wl;
    int defaultPixel[];
    int defaultWidth;
    int defaultHeight;
    int defaultWW, defaultWL;
    Image image;
    Toolkit toolkit;
    MemoryImageSource source;

    public void setData(DicomData dicomData) {
        if (debug_level > 3) {
            System.out.println("Now set width and height....");
        }
        width = Integer.parseInt(dicomData.getAnalyzedValue("(0028,0011)"));
        height = Integer.parseInt(dicomData.getAnalyzedValue("(0028,0010)"));
        defaultWidth = width;
        defaultHeight = height;

        if (debug_level > 3) {
            System.out.println("Image width  : " + width);
        }
        if (debug_level > 3) {
            System.out.println("Image heigth : " + height);
        }

        if (debug_level > 3) {
            System.out.print("Now set byte[] to int[]....");
        }

        orgPixel = new int[width * height];
        pixLength = orgPixel.length;
        pixel = new int[pixLength];
        defaultPixel = new int[pixLength];
        byte[] tmpValue = new byte[dicomData.getValue("(7fe0,0010)").length];
        System.arraycopy(dicomData.getValue("(7fe0,0010)"), 0, tmpValue, 0, tmpValue.length);
        if (debug_level > 3) {
            System.out.println(" OK!");
        }

        if (dicomData.isContain("(0028,0004)")
                && dicomData.getAnalyzedValue("(0028,0004)").trim().equals("RGB")) {
            rgbMode = true;
            for (int i = 0; i < pixLength; i++) {
                orgPixel[i] = ((255 << 24)
                        | (0xff & tmpValue[3 * i]) << 16
                        | (0xff & tmpValue[(3 * i) + 1]) << 8
                        | (0xff & tmpValue[(3 * i) + 2]));
            }

        } else {

            if (dicomData.getAnalyzedValue("(0028,0100)").trim().equals("16")) {
                short shValue = 0;
                for (int i = 0; i < pixLength; i++) {
                    shValue = (short) ((0xff & tmpValue[(2 * i) + 1]) << 8
                            | (0xff & tmpValue[2 * i]));
                    orgPixel[i] = (int) shValue;
                }

            } else {
                for (int i = 0; i < pixLength; i++) {
                    orgPixel[i] = (int) (0xff & tmpValue[i]);
                }
            }

            int bit_stored = Integer.parseInt(dicomData.getAnalyzedValue("(0028,0101)"));
            int bit_hight = Integer.parseInt(dicomData.getAnalyzedValue("(0028,0102)"));
            int bit_gap = bit_hight - bit_stored + 1;
            if (bit_gap > 0) {
                for (int i = 0; i < pixLength; i++) {
                    orgPixel[i] = (orgPixel[i] >> bit_gap);
                }
            }
        }


        System.arraycopy(orgPixel, 0, defaultPixel, 0, pixLength);

        tmpValue = null;


        if (debug_level > 3) {
            System.out.print("Now set pixelMin and pixelMax....");
        }

        pixelMin = 0;
        pixelMax = 0;
        for (int i = 0; i < pixLength; i++) {
            if (pixelMin > orgPixel[i]) {
                pixelMin = orgPixel[i];
            }
            if (pixelMax < orgPixel[i]) {
                pixelMax = orgPixel[i];
            }
        }

        if (debug_level > 3) {
            System.out.println(" OK!");
        }


        if (debug_level > 3) {
            System.out.print("Now set WW/WL....");
        }
        if (dicomData.isContain("(0028,1051)")) {
            try {
                ww = Integer.parseInt(dicomData.getAnalyzedValue("(0028,1051)").replace('+', ' ').trim());
            } catch (NumberFormatException e) {

                ww = pixelMax - pixelMin;
            }
        } else {
            ww = pixelMax - pixelMin;
        }
        if (dicomData.isContain("(0028,1050)")) {
            try {
                wl = Integer.parseInt(dicomData.getAnalyzedValue("(0028,1050)").replace('+', ' ').trim());
            } catch (NumberFormatException e) {

                wl = (ww >> 1) + pixelMin;
            }
        } else {
            wl = (ww >> 1) + pixelMin;
        }
        defaultWW = ww;
        defaultWL = wl;

        if (debug_level > 3) {
            System.out.println(" OK!");
        }
        if (debug_level > 3) {
            System.out.println("WW :" + ww + " WL :" + wl);
        }


        for (int i = 0; i < pixel.length; i++) {
            pixel[i] = 0xff000000;
        }
        source = new MemoryImageSource(width, height, pixel, 0, width);
        source.setAnimated(true);
        toolkit = Toolkit.getDefaultToolkit();
        image = toolkit.createImage(source);
    }

    private void contrast() {


        if (!rgbMode) {
            //int tmp = (int)(ww * 0.5);
            int tmp = ww >> 1;
            int contrastMin = wl - tmp;
            int contrastMax = wl + tmp;

            if (blackANDwhite) {

                double invWW = 255d / (double) ww;
                int pix;

                for (int i = 0; i < pixLength; i++) {
                    pix = orgPixel[i];
                    if (pix <= contrastMin) {
                        pix = 0;
                    } else if (pix >= contrastMax) {
                        pix = 255;
                    } else // pix = (int)Math.round((255*(pix - contrastMin))/ww);
                    {
                        pix = (int) ((pix - contrastMin) * invWW);
                    }
                    pixel[i] = (0xff000000 | (pix << 16) | (pix << 8) | pix);

                    if (inv) {
                        pixel[i] = ((~pixel[i] & 0x00ffffff) | (pixel[i] & 0xff000000));
                    }
                }
            } else {

                float invWW = 0.67f / (float) ww;
                int pminWW = ww + contrastMin;
                int pix;
                float hue;

                for (int i = 0; i < pixLength; i++) {
                    pix = orgPixel[i];
                    if (pix <= contrastMin) {
                        hue = 0.67f;
                    } else if (pix >= contrastMax) {
                        hue = 0.0f;
                    } else // hue = (1.0f - (pix - contrastMin)/ww) * 0.67f;
                    {
                        hue = (float) (pminWW - pix) * invWW;
                    }
                    pixel[i] = hue2RGB(hue);

                    if (inv) {
                        pixel[i] = ((~pixel[i] & 0x00ffffff) | (pixel[i] & 0xff000000));
                    }
                }
            }
        } else {

            System.arraycopy(orgPixel, 0, pixel, 0, pixel.length);
        }
    }

    private int hue2RGB(float hue) {
        int r = 0, g = 0, b = 0;

        float h = (hue - (float) Math.floor(hue)) * 6.0f;
        float f = h - (float) java.lang.Math.floor(h);
        float q = 1.0f - f;

        switch ((int) h) {
            case 0:
                r = 255;
                g = (int) (f * 255.0f + 0.5f);
                b = 0;
                break;
            case 1:
                r = (int) (q * 255.0f + 0.5f);
                g = 255;
                b = 0;
                break;
            case 2:
                r = 0;
                g = 255;
                b = (int) (f * 255.0f + 0.5f);
                break;
            case 3:
                r = 0;
                g = (int) (q * 255.0f + 0.5f);
                b = 255;
                break;
            case 4:
                r = (int) (f * 255.0f + 0.5f);
                g = 0;
                b = 255;
                break;
            case 5:
                r = 255;
                g = 0;
                b = (int) (q * 255.0f + 0.5f);
                break;
        }
        return 0xff000000 | (r << 16) | (g << 8) | (b << 0);
    }

    private Image getImage() {

        source.newPixels();
        return image;
    }

    public Image getDefaultImage() {
        contrast();
        return getImage();
    }

    public boolean color() {
        return rgbMode;
    }

    public Image wwANDwl(int argWW, int argWL) {
        ww = argWW;
        wl = argWL;
        contrast();
        return getImage();
    }

    public void setWwWl(int argWW, int argWL) {
        ww = argWW;
        wl = argWL;
    }

    public Image getImageWWWL2Current(int argWW, int argWL) {
        ww = defaultWW + argWW;
        wl = defaultWL + argWL;
        contrast();
        return getImage();
    }

    public int getWW() {
        return ww;
    }

    public int getWL() {
        return wl;
    }

    public int getDefaultWW() {
        return defaultWW;
    }

    public int getDefaultWL() {
        return defaultWL;
    }

    public int getWidth() {
        return width;
    }

    public int getHeight() {
        return height;
    }

    public int getPixelMin() {
        return pixelMin;
    }

    public int getPixelMax() {
        return pixelMax;
    }

    public void inverse() {
        inv = !inv;
    }

    public void setInverse(boolean flag) {
        inv = flag;
    }

    public void setColor(boolean flag) {
        blackANDwhite = !flag;
    }

    public void changeColor() {
        blackANDwhite = !blackANDwhite;
    }

    public void setDefaultPixel() {
        System.arraycopy(defaultPixel, 0, orgPixel, 0, pixLength);
        width = defaultWidth;
        height = defaultHeight;

        blackANDwhite = true;
        inv = false;
    }

    public void rotateL() {
        int[] tmpPixel = new int[orgPixel.length];
        int temp;

        System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
        for (int i = 0; i < height; i++) {
            for (int j = 0; j < width; j++) {
                orgPixel[(width - j - 1) * height + i] = tmpPixel[i * width + j];
            }
        }
        temp = width;
        width = height;
        height = temp;
    }

    public void rotateR() {
        int[] tmpPixel = new int[orgPixel.length];
        int temp;

        System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
        for (int i = 0; i < height; i++) {
            for (int j = 0; j < width; j++) {
                orgPixel[j * height + (height - i - 1)] = tmpPixel[i * width + j];
            }
        }
        temp = width;
        width = height;
        height = temp;
    }

    public void flipLR() {
        int[] tmpPixel = new int[orgPixel.length];
        int temp1, temp2;

        System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
        for (int i = 0; i < height; i++) {
            temp1 = i * width;
            temp2 = temp1 + width - 1;
            for (int j = 0; j < width; j++) {
                orgPixel[temp2 - j] = tmpPixel[temp1 + j];
            }
        }
    }

    public void flipUD() {
        int[] tmpPixel = new int[orgPixel.length];
        int temp1, temp2;

        System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
        for (int i = 0; i < height; i++) {
            temp1 = (height - i - 1) * width;
            temp2 = i * width;
            for (int j = 0; j < width; j++) {
                orgPixel[temp1 + j] = tmpPixel[temp2 + j];
            }
        }
    }

    private void makeHistogram() {
        for (int i = 0; i < 256; i++) {
            histogram[i] = 0;
        }
        histMax = 0;

        for (int i = 0; i < pixel.length; i++) {
            int data = (0x000000ff & pixel[i]);
            histogram[data]++;
        }

        for (int i = 0; i < 256; i++) {
            if (histMax < histogram[i]) {
                histMax = histogram[i];
            }
        }
    }

    public int[] getHistogram() {
        return histogram;
    }

    public int getHistMax() {
        return histMax;
    }

    public Image reviseHistogram() {
        calcRevisedHistogram();
        return getImage();
    }

    private void calcRevisedHistogram() {
        double[] aFreq = new double[256];
        int sum = 0;
        double allPixelsInv;
        double vmin;
        double vminInv;
        int[] fixed = new int[256];


        makeHistogram();

        for (int i = 0; i < pixel.length; i++) {
            pixel[i] = (0x000000ff & pixel[i]);
        }

        allPixelsInv = 1. / (height * width);
        for (int i = 0; i < 256; i++) {
            sum += histogram[i];
            aFreq[i] = (double) sum * allPixelsInv;
        }

        vmin = aFreq[0];
        vminInv = (double) 255. / (1. - vmin);
        for (int i = 0; i < 256; i++) {
            fixed[i] = (int) ((aFreq[i] - vmin) * vminInv);
        }
        for (int i = 0; i < pixel.length; i++) {
            pixel[i] = ((255 << 24)
                    | (fixed[pixel[i]] << 16)
                    | (fixed[pixel[i]] << 8)
                    | fixed[pixel[i]]);
        }
    }
}
