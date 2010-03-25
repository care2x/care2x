/*
 * ImageData.java - 画像の情報を保持しているオブジェクト
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
import java.awt.image.*;

public class ImageData {

  int     debug_level = 3;

  boolean	blackANDwhite = true;				// 白黒画像の時true
  boolean rgbMode = false;            // Dicom RGB -> true
  boolean	inv = false;								// ネガポジ反転
  int			pixel[];										// 画像の各ピクセル
  int			orgPixel[];									// オリジナルの画素値
  int     pixLength;                  // オリジナルピクセルの長さ
  int			pixelMin;										// 画像最小値
  int			pixelMax;										// 画像最大値
  int			width;											// イメージ幅
  int			height;											// イメージ高さ
  int			histogram[] = new int[256];	// ヒストグラム
  int			histMax;										// ヒストグラムの最大数
  int			ww,wl;          						// WW/WL

  // 初期時の状態
  int			defaultPixel[];							// 初期時の画素値
  int			defaultWidth;								// 初期時のイメージ幅
  int			defaultHeight;							// 初期時のイメージ高さ
  int     defaultWW, defaultWL;       // 初期時のWW/WL

  Image   image;
  Toolkit toolkit;
  MemoryImageSource source;

  // DicomDataから各変数に値をセットする
  public void setData(DicomData dicomData) {
    // デバッグ用
    if (debug_level > 3) System.out.println("Now set width and height....");
    // DicomDataからイメージの幅と高さを求める
    // String型をint型にキャストしている
    width		= Integer.parseInt(dicomData.getAnalyzedValue("(0028,0011)"));
    height	= Integer.parseInt(dicomData.getAnalyzedValue("(0028,0010)"));
    defaultWidth = width;
    defaultHeight = height;
    // デバッグ用
    if (debug_level > 3) System.out.println("Image width  : " + width);
    if (debug_level > 3) System.out.println("Image heigth : " + height);

    // デバッグ用
    if (debug_level > 3) System.out.print("Now set byte[] to int[]....");
    // DicomDataの画素値のbyte[]をint[]に変換する
    orgPixel        = new int[width * height];
    pixLength       = orgPixel.length;
    pixel           = new int[pixLength];
    defaultPixel    = new int[pixLength];
    byte[] tmpValue = new byte[dicomData.getValue("(7fe0,0010)").length];
    System.arraycopy(dicomData.getValue("(7fe0,0010)"), 0, tmpValue, 0, tmpValue.length);
    // デバッグ用
    if (debug_level > 3) System.out.println(" OK!");

    // 現在サポートしているのは,
    // (0028,0004)Photometric Interpretation がRGB
    if(dicomData.isContain("(0028,0004)") &&
        dicomData.getAnalyzedValue("(0028,0004)").trim().equals("RGB")) {
      rgbMode = true;
      for(int i=0; i<pixLength; i++){
        orgPixel[i] = ((255 << 24) |
                       (0xff & tmpValue[3*i]) << 16 |
                       (0xff & tmpValue[(3*i)+1]) << 8 |
                       (0xff & tmpValue[(3*i)+2]) );
      }
    // もしくは、MONOCHROME2のとき。
    } else {
      // 割り当てビットが16bitの時
      if(dicomData.getAnalyzedValue("(0028,0100)").trim().equals("16")) {
        short shValue = 0;
        for(int i=0; i<pixLength; i++){
          shValue = (short)((0xff & tmpValue[(2*i)+1]) << 8 |
                            (0xff & tmpValue[2*i]) );
          orgPixel[i] = (int)shValue;
        }
      // 割り当てビットが8bitの時
      }else {
        for(int i=0; i<pixLength; i++)
          orgPixel[i] = (int)(0xff & tmpValue[i]);
      }
      // 格納ビット、高位ビットの補正
      int bit_stored = Integer.parseInt(dicomData.getAnalyzedValue("(0028,0101)"));
      int bit_hight  = Integer.parseInt(dicomData.getAnalyzedValue("(0028,0102)"));
      int bit_gap    = bit_hight - bit_stored +1;
      if(bit_gap > 0) {
        for(int i=0; i<pixLength; i++) orgPixel[i] = (orgPixel[i] >> bit_gap);
      }
    }

    // 初期状態の保存
    System.arraycopy(orgPixel, 0, defaultPixel, 0, pixLength);
    
    tmpValue = null;

    // デバッグ用
    if (debug_level > 3) System.out.print("Now set pixelMin and pixelMax....");
    // 画像の最大値と最小値を求める。
    pixelMin = 0;
    pixelMax = 0;
    for(int i=0; i<pixLength; i++){
      if(pixelMin > orgPixel[i])
      	pixelMin = orgPixel[i];
      if(pixelMax < orgPixel[i])
      	pixelMax = orgPixel[i];
    }
    // デバッグ用
    if (debug_level > 3) System.out.println(" OK!");

    // デバッグ用
    if (debug_level > 3) System.out.print("Now set WW/WL....");
    // デフォルトWW／WLの設定
    // DICOMデータの中にWW/WLがあるときは、その値を使う。
    if(dicomData.isContain("(0028,1051)")) {
      try {
        ww = Integer.parseInt(dicomData.getAnalyzedValue("(0028,1051)").replace('+', ' ').trim());
      }catch(NumberFormatException e) {
        // うまく値を取り出せないときは、計算で求める。
        ww = pixelMax - pixelMin;
      }
    } else {
      ww = pixelMax - pixelMin;
    }
    if(dicomData.isContain("(0028,1050)")) {
      try {
        wl = Integer.parseInt(dicomData.getAnalyzedValue("(0028,1050)").replace('+', ' ').trim());
      }catch(NumberFormatException e) {
        // うまく値を取り出せないときは、計算で求める。
        wl = (ww >> 1) + pixelMin;
      }
    } else {
      wl = (ww >> 1) + pixelMin;
    }
    defaultWW = ww;
    defaultWL = wl;
    // デバッグ用
    if (debug_level > 3) System.out.println(" OK!");
    if (debug_level > 3) System.out.println("WW :" + ww + " WL :" + wl);

    // 空のイメージを作っておく。
    for(int i=0; i < pixel.length; i++) pixel[i] = 0xff000000;
    source = new MemoryImageSource(width, height, pixel, 0, width);
    source.setAnimated(true);
    toolkit = Toolkit.getDefaultToolkit();
    image = toolkit.createImage(source);
  }

  // WW/WLの計算,カラーの設定,ネガポジ反転
  private void contrast() {

    // コントラスト変化およびカラー変化。
    if(!rgbMode){
      //int tmp = (int)(ww * 0.5);
      int tmp = ww >> 1;
      int contrastMin = wl - tmp;
      int contrastMax = wl + tmp;

      if(blackANDwhite) {
    	  // 白黒画像
        double invWW = 255d / (double)ww;
        int pix;

        for(int i=0; i<pixLength; i++){
          pix = orgPixel[i];
          if(pix <= contrastMin) pix = 0;
          else if(pix >= contrastMax) pix = 255;
          else
            // これが正しい式
            // pix = (int)Math.round((255*(pix - contrastMin))/ww);
        	  pix = (int)((pix - contrastMin) * invWW);
          pixel[i] = (0xff000000 | (pix << 16) | (pix << 8) | pix);
          // ネガポジ反転
          if(inv) pixel[i] = ((~pixel[i] & 0x00ffffff) | (pixel[i] & 0xff000000));
        }
      }else {
        // 擬似カラー
        float invWW = 0.67f / (float)ww;
        int pminWW = ww + contrastMin;
        int pix;
        float hue;

        for(int i=0; i<pixLength; i++){
          pix = orgPixel[i];
          if(pix <= contrastMin) hue = 0.67f;     // 青(色相:4/6)から
          else if(pix >= contrastMax) hue = 0.0f; // 赤まで
          else
            // これが正しい式
            // hue = (1.0f - (pix - contrastMin)/ww) * 0.67f;
            hue = (float)(pminWW - pix) * invWW;
          pixel[i] = hue2RGB(hue);
          // ネガポジ反転
          if(inv) pixel[i] = ((~pixel[i] & 0x00ffffff) | (pixel[i] & 0xff000000));
        }
      }
    }else {
      // Dicom RGB Modeのとき
      System.arraycopy(orgPixel, 0, pixel, 0, pixel.length);
    }
  }

  /**
   * HSB(彩度と明度は1.0とする)からRGBカラーを作るメソッド
   *
   * HSB
   *      0     1/6     2/6     3/6     4/6     5/6     1
   * 色相 |------|-------|-------|-------|-------|------|
   *      赤     黄      緑    シアン    青   マゼンタ
   *      0                                             1
   * 彩度 |---------------------------------------------|
   *      グレー    淡い←          →純粋な色
   *      0                                             1
   * 明度 |---------------------------------------------|
   *      黒        暗い←          →明るい
   *
   * @param hue - 色相
   * @see   java.awt.Color#HSBtoRGB(float, float, float)
   */
  private int hue2RGB(float hue) {
	  int r = 0, g = 0, b = 0;

    float h = (hue - (float)Math.floor(hue)) * 6.0f;
    float f = h - (float)java.lang.Math.floor(h);
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
    // ピクセル値を変更して、Imageを返す。
    source.newPixels();
    return image;
/*
    // イメージを作り返す。
    Toolkit toolkit = Toolkit.getDefaultToolkit();
    return toolkit.createImage(new MemoryImageSource(width, height, pixel, 0, width));
*/
  }

  // 現在のデフォルト状態のイメージを返す
  public Image getDefaultImage() {
    contrast();
    return getImage();
  }

  // 白黒,カラーの状態を返す(カラーのときtrue)
  public boolean color() {
    return rgbMode;
  }

  // WW/WLをイメージに反映させる
  public Image wwANDwl(int argWW, int argWL) {
    ww = argWW;
    wl = argWL;
    contrast();
    return getImage();
  }

  // WW/WLの値をセットする
  public void setWwWl(int argWW, int argWL) {
    ww = argWW;
    wl = argWL;
  }

  // Defaultからの差を得て、WW/WLをイメージに反映させる
  public Image getImageWWWL2Current(int argWW, int argWL) {
    ww = defaultWW + argWW;
    wl = defaultWL + argWL;
    contrast();
    return getImage();
  }

  // WW／WLを返す
  public int getWW() {
    return ww;
  }
  public int getWL() {
    return wl;
  }

  // デフォルトのWW／WLを返す
  public int getDefaultWW() {
    return defaultWW;
  }
  public int getDefaultWL() {
    return defaultWL;
  }

  // イメージ幅,高さを返す
  public int getWidth() {
    return width;
  }
  public int getHeight() {
    return height;
  }

  // Pixel値の最大値、最小値を返す
  public int getPixelMin() {
    return pixelMin;
  }
  public int getPixelMax() {
    return pixelMax;
  }

  // ネガポジ反転
  public void inverse() {
    inv = !inv;
  }
  public void setInverse(boolean flag) {
    inv = flag;
  }
/*
  public Image inverse() {
    inv = !inv;
    contrast();
    return getImage();
  }
*/

  // 擬似カラー化
  public void setColor(boolean flag) {
    blackANDwhite = !flag;
  }
  public void changeColor() {
    blackANDwhite = !blackANDwhite;
  }

  // 初期状態に戻す。(WW/WL以外)
  public void setDefaultPixel() {
    System.arraycopy(defaultPixel, 0, orgPixel, 0, pixLength);
    width =  defaultWidth;
    height = defaultHeight;

    blackANDwhite = true;				// 白黒画像の時true
    inv = false;								// ネガポジ反転
  }

  // 90度画像回転
  public void rotateL() {
    int[] tmpPixel = new int[orgPixel.length];
    int temp;

    System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
    for(int i=0; i < height; i++) {
      for(int j=0; j < width; j++) {
        orgPixel[(width - j -1) * height + i] = tmpPixel[i * width + j];
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
    for(int i=0; i < height; i++) {
      for(int j=0; j < width; j++) {
        orgPixel[j * height + (height - i -1)] = tmpPixel[i * width + j];
      }
    }
    temp = width;
    width = height;
    height = temp;
  }

  // 左右画像反転
  public void flipLR() {
    int[] tmpPixel = new int[orgPixel.length];
    int temp1, temp2;

    System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
    for(int i=0; i < height; i++) {
      temp1 = i * width;
      temp2 = temp1 + width -1;
      for(int j=0; j < width; j++) {
        orgPixel[temp2 - j] = tmpPixel[temp1 + j];
      }
    }
  }

  // 上下画像反転
  public void flipUD() {
    int[] tmpPixel = new int[orgPixel.length];
    int temp1, temp2;

    System.arraycopy(orgPixel, 0, tmpPixel, 0, tmpPixel.length);
    for(int i=0; i < height; i++) {
      temp1 = (height - i -1) * width;
      temp2 = i * width;
      for(int j=0; j < width; j++) {
        orgPixel[temp1 + j] = tmpPixel[temp2 + j];
      }
    }
  }

  // ヒストグラムの作成
  private void makeHistogram()
  {
    // 初期化
    for(int i=0; i<256; i++)
    	histogram[i] = 0;
    histMax = 0;

    // ヒストグラムの作成
    for(int i=0; i<pixel.length; i++){
      int data = (0x000000ff & pixel[i]);
      histogram[data]++;
    }

    // ヒストグラムの最大数を求める
    for(int i=0; i<256; i++){
      if(histMax < histogram[i])
      	histMax = histogram[i];
    }
  }

  // ヒストグラム,ヒストグラムの最大値を返す
  public int[] getHistogram()
  {
    return histogram;
  }

  public int getHistMax()
  {
    return histMax;
  }

  // ヒストグラムの補正をする
  public Image reviseHistogram()
  {
    calcRevisedHistogram();
    return getImage();
  }

  // ヒストグラムの補正を計算する
  private void calcRevisedHistogram(){
    double[]	aFreq 				= new double[256];        // 累積度数
    int				sum   				= 0;                      // ヒストグラムの和
    double		allPixelsInv; 				                  // 1./全画素数
    double		vmin;                 				          // 累積度数の最小値
    double		vminInv;
    int[]			fixed 				= new int[256];           // 補正されたヒストグラム

    // ヒストグラムを作る
    makeHistogram();

    for(int i=0; i<pixel.length; i++){
      pixel[i] = (0x000000ff & pixel[i]); 						// とりあえず白黒だけ考える
    }

    // 累積度数の計算
    allPixelsInv = 1. / (height * width);
    for(int i=0; i<256; i++){
      sum += histogram[i];
      aFreq[i] = (double)sum * allPixelsInv;
    }

    // ヒストグラムの補正
    vmin = aFreq[0];
    vminInv = (double)255. / (1.- vmin);
    for(int i=0; i<256; i++){
      fixed[i] = (int)((aFreq[i] - vmin) * vminInv);
    }
    for(int i=0; i<pixel.length; i++){
      pixel[i] = ((255 << 24)
      				  | (fixed[pixel[i]] << 16)
                | (fixed[pixel[i]] << 8)
                | fixed[pixel[i]]);
    }
  }
}
