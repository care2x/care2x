/*
 * Viewer.java - This is MAIN. (Applet)
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

import java.awt.*;
import java.awt.event.*;
import java.applet.*;

public class Viewer extends Applet {

  int           debug_level = 3;

  // パラメータ関係のフィールド
  boolean           isLtlEndian;
  boolean           vrType;
  boolean           privacy;
  int               NUM;
  String            dicURL;
  String[]          imgURL;

  // DICOM関係のフィールド
  DicomFile         dicomFile;
  DicomData         dicomData;            // 現在見ているカレントデータ
  ImageData         imageData;            // 現在見ているカレントデータ
  DicomData[]       dicomData_tmp;        // テンポラリのデータ
  ImageData[]       imageData_tmp;        // テンポラリのデータ
  int[]             index;                // テンポラリを見ている場合はその配列の添え字
  int               TMPSIZE;              // テンポラリ配列の大きさ（偶数）
  int[]             arrayIndex;           // テンポラリに入っている画像番号
  int               start;                // 現在テンポラリに入っている先頭の画像番号
  int               start_old;
  int[]             ww, wl;               // 全ての画像分のWWとWLのデフォルト値からの差を持つ
  double            zoom = 1.0;           // 拡大縮小倍率
  int               canvasSize = 100;
  boolean           inv_flag = false;     // ネガポジ反転
  // boolean           color_flag = false;   // 擬似カラー
  boolean           rotateL_flag = false; // 90度画像回転フラグ
  boolean           rotateR_flag = false; // 90度画像回転フラグ
  boolean           flipLR_flag = false;  // 左右画像反転フラグ
  boolean           flipUD_flag = false;  // 上下画像反転フラグ
  boolean           reset_flag = false;   // 初期化フラグ
  int               imageNo;              // Stackの時の今見ているイメージNO(0-?)
  boolean           synchro_flag = true;  // 全ての画像を変化させるかどうか？
  int               imageNo_old;
  LoaderThread      loader;               // スレッド
  boolean           isThreadStarted;      // Appletのstartを一度実行したかどうか？
  boolean           requestStop = false;  // スレッドに止まってもらうようにするためのフラグ

  // 表示関係のフィールド
  ImageTiledCanvas  imageTiledCanvas;     // 並べて表示の時のキャンパス
  int               row =1;               // 分割数。行。
  int               column =1;            // 分割数。列。
  TagInfoFrame      tagInfoFrame;         // タグを表示するフレーム
  int               tile_start;           // タイル表示するときのスタート画像番号
  int               width, height;        // イメージオリジナルな幅と高さ
  AnimationThread   animationThread;      // シネモードのスレッド
  boolean           notCine = true;       // CineModeでないときtrue

  // GUI関係のフィールド
  // EventListener
  MyCheckBoxListener  myCheckBoxListener  = new MyCheckBoxListener();
  MyKeyListener       myKeyListener       = new MyKeyListener();
  // Font
  Font  bold  = new Font("Dialog", Font.BOLD, 12);
  Font  plain = new Font("Dialog", Font.PLAIN, 12);
  // Layout
  BorderLayout        borderLayout1       = new BorderLayout();
  GridBagLayout       gridBagLayout1      = new GridBagLayout();
  GridBagLayout       gridBagLayout2      = new GridBagLayout();
  GridBagConstraints  gridBagConstraints1 = new GridBagConstraints();
  GridBagConstraints  gridBagConstraints2 = new GridBagConstraints();
  // Panel
  ScrollPane  scrollPane1   = new ScrollPane();
  Panel       panel1        = new Panel();
  Panel       controlPanel  = new Panel();
  BorderPanel borderPanel1  = new BorderPanel("Mouse Manupilation");
  Panel       mousePanel    = new Panel();
  InfoPanel   infoPanel     = new InfoPanel();
  Panel       buttonPanel   = new Panel();
  Panel       copyrightPanel= new Panel();
  // Label
  Label label1        = new Label();
  Label label2        = new Label("ImageNo");
  MyLabel copyright_L   = new MyLabel("Copyright (C) 2000 Nagoya Institute of Technology, Iwata lab. & KtC");
  //MyLabel copyright_L   = new MyLabel("@see http://mars.elcom.nitech.ac.jp/dicom/index-e.html");
  // TextField
  TextField imageNo_F = new TextField(3);
  // Scrollbar
  Scrollbar imageNo_S = new Scrollbar(Scrollbar.HORIZONTAL);
  // Checkbox
  CheckboxGroup checkboxGroup1  = new CheckboxGroup();
  Checkbox      wwwlSingle_C    = new Checkbox("WL/WW(Single)", false, checkboxGroup1);
  Checkbox      wwwlALL_C       = new Checkbox("WL/WW(All images)", true, checkboxGroup1);
  Checkbox      move_C          = new Checkbox("Move" , false, checkboxGroup1);
  Checkbox      zoom_C          = new Checkbox("Zoom", false, checkboxGroup1);
  Checkbox      loupe_C         = new Checkbox("Loupe", false, checkboxGroup1);
  Checkbox      studyInfo_C     = new Checkbox("Annotation", true);
  // Button
  Button fit_B      = new Button("Reset Move/Zoom");
  Button default_B  = new Button("Default WL/WW");
  Button less_B     = new Button("LessFrame");
  Button more_B     = new Button("MoreFrame");
  Button tag_B      = new Button("Show Tag Info");
  Button inv_B      = new Button("Reverse");
  Button rotateL_B  = new Button("Rotate L");
  Button rotateR_B  = new Button("Rotate R");
  Button flipLR_B   = new Button("Flip RL");
  Button flipUD_B   = new Button("Flip UD");
  Button reset_B    = new Button("Reset Angle");
  Button cine_B     = new Button("Cine Mode");
  Button cineNext1_B= new Button("->");
  Button cinePrev1_B= new Button("<-");
  Button cineNext2_B= new Button(">>");
  Button cinePrev2_B= new Button("<<");

  //引数値の取得
  public String getParameter(String key, String def) {
    String paramString;
    paramString = getParameter(key) != null ? getParameter(key) : def;

    // デバッグ用
    if (debug_level > 3) System.out.println("Parameter " + key + " is " + paramString);

    return paramString;
  }

  //引数情報の取得
  public String[][] getParameterInfo() {
    String[][] pinfo =
    {
      {"isLtlEndian", "boolean", "転送構文。LittleEndianならtrue"},
      {"vrType", "boolean", "VRの種類。明示的VRならtrue"},
      {"patientPrivacy", "boolean", "患者プライバシー保護のため患者名変換するときtrue"},
      {"tmpSize", "int", "キャッシュされる最大画像枚数(偶数)"},
      {"NUM", "int", "画像枚数"},
      {"currentNo", "int", "最初に見る画像番号 (0-?)"},
      {"dicURL", "String", "辞書URL"},
      {"imgURL", "String", "画像URL"},
    };
    return pinfo;
  }

  //アプレットの構築（コンストラクタ）
  public Viewer() {
  }

  //アプレットの初期化
  public void init() {
    // デバッグ用
    if (debug_level > 3) System.out.println("Now Loading Parameter....");
    try {
      // 各パラメータを読み出す
      isLtlEndian = Boolean.valueOf(this.getParameter("isLtlEndian", "true")).booleanValue();
      vrType = Boolean.valueOf(this.getParameter("vrType", "false")).booleanValue();
      privacy = Boolean.valueOf(this.getParameter("patientPrivacy", "false")).booleanValue();
      TMPSIZE = Integer.parseInt(this.getParameter("tmpSize", "10"));
      NUM = Integer.parseInt(this.getParameter("NUM", "1"));
      imageNo = Integer.parseInt(this.getParameter("currentNo", "0"));
      dicURL = this.getParameter("dicURL", "none");
      imgURL = new String[NUM];
      for (int i=0; i<NUM ; i++) imgURL[i] = this.getParameter("imgURL"+i, "");

      // コンポーネントの初期化を行う
      jbInit();
    }
    catch(Exception e)  {
      // 全てのExceptionをキャッチする
      e.printStackTrace();
    }
  }

  //コンポーネントの初期化
  private void jbInit() throws Exception {

    isThreadStarted = false;

    // this.setSize(new Dimension(700,500));
    this.setLayout(borderLayout1);
    controlPanel.setLayout(gridBagLayout1);
    mousePanel.setLayout(gridBagLayout2);

    // TextFiledの設定
    imageNo_F.setText(String.valueOf(imageNo +1));

    // Scrollbarの設定
    imageNo_S.setValues(imageNo +1, 0, 1, NUM +1);

    // ボタンの設定
    less_B.setEnabled(false);
    cineNext1_B.setFont(bold);
    cineNext2_B.setFont(plain);
    cinePrev1_B.setFont(plain);
    cinePrev2_B.setFont(plain);
    cineNext1_B.setEnabled(false);
    cineNext2_B.setEnabled(false);
    cinePrev1_B.setEnabled(false);
    cinePrev2_B.setEnabled(false);

    // 各コンポーネントを貼り付ける
    panel1.setLayout(new BorderLayout());
    this.add(scrollPane1, BorderLayout.CENTER);
    this.add(panel1, BorderLayout.WEST);
    this.add(copyrightPanel, BorderLayout.SOUTH);

    // CopyrightPanel関係
    copyright_L.setAppletContext(this.getAppletContext());
    copyrightPanel.setLayout(new FlowLayout(FlowLayout.RIGHT, 5, 0));
    copyrightPanel.add(copyright_L);

    // buttonPanel関係
    buttonPanel.setLayout(new GridLayout(2,1));
    buttonPanel.add(studyInfo_C);
    buttonPanel.add(tag_B);
    panel1.add(buttonPanel, BorderLayout.SOUTH);

    // InfoPanel関係
    panel1.add(infoPanel, BorderLayout.CENTER);

    // mousePanel関係
    gridBagConstraints2.fill = GridBagConstraints.BOTH;   // 可能な限りコンポーネントを大きくする

    add2mousePanel(0, 0, 6, wwwlALL_C);
    add2mousePanel(0, 1, 6, wwwlSingle_C);
    add2mousePanel(0, 2, 1, label1);
    add2mousePanel(1, 2, 5, default_B);
    add2mousePanel(0, 3, 1, label1);
    add2mousePanel(1, 3, 5, inv_B);
    add2mousePanel(0, 4, 6, move_C);
    add2mousePanel(0, 5, 6, zoom_C);
    add2mousePanel(0, 6, 1, label1);
    add2mousePanel(1, 6, 5, fit_B);
    add2mousePanel(0, 7, 6, loupe_C);

    borderPanel1.add(mousePanel);

    // controlPanel関係
    panel1.add(controlPanel, BorderLayout.NORTH);
    gridBagConstraints1.fill = GridBagConstraints.BOTH;   // 可能な限りコンポーネントを大きくする

    gridBagConstraints1.gridx = 0;
    gridBagConstraints1.gridy = 0;
    gridBagConstraints1.gridwidth = 4;
    gridBagConstraints1.gridheight = 9;
    gridBagConstraints1.insets = new Insets(3,3,0,3); // 余白を与える
    gridBagLayout1.setConstraints(borderPanel1, gridBagConstraints1);
    controlPanel.add(borderPanel1);
    gridBagConstraints1.insets = new Insets(0,0,0,0); // 余白0に戻す
    gridBagConstraints1.gridheight = 1;

    int line = 9; // 行数のカウント
    add2controlPanel(0, line, 4, reset_B);
    line++;
    add2controlPanel(0, line, 2, rotateL_B);
    add2controlPanel(2, line, 2, rotateR_B);
    line++;
    add2controlPanel(0, line, 2, flipLR_B);
    add2controlPanel(2, line, 2, flipUD_B);
    line++;
    gridBagConstraints1.insets = new Insets(5,0,0,0); // コンポーネントの上に5ピクセルの余白を与える
    add2controlPanel(0, line, 4, cine_B);
    line++;
    gridBagConstraints1.insets = new Insets(0,0,0,0); // 余白0に戻す
    add2controlPanel(0, line, 1, cinePrev2_B);
    add2controlPanel(1, line, 1, cinePrev1_B);
    add2controlPanel(2, line, 1, cineNext1_B);
    add2controlPanel(3, line, 1, cineNext2_B);
    line++;
    gridBagConstraints1.insets = new Insets(5,0,0,0); // コンポーネントの上に5ピクセルの余白を与える
    add2controlPanel(0, line, 2, label2);
    add2controlPanel(2, line, 2, imageNo_F);
    line++;
    gridBagConstraints1.insets = new Insets(0,0,0,0); // 余白0に戻す
    add2controlPanel(0, line, 4, imageNo_S);
    line++;
    add2controlPanel(0, line, 2, less_B);
    add2controlPanel(2, line, 2, more_B);
    line++;

    // scrollPane1関係
    scrollPane1.setBackground(Color.black);
    // addはstart()で行う

    // TagInfoFrameの設定
    tagInfoFrame = new TagInfoFrame();
    tagInfoFrame.setSize(500, 400);
    tagInfoFrame.setResizable(true);

    // イベントの処理
    // imageNo関係
    imageNo_F.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        imageNo_S.setValue((int)getFieldValue(imageNo_F));
        imageNo_old = imageNo;
        imageNo = imageNo_S.getValue() - 1;
        changeImageNo();
      }
    });
    imageNo_F.addKeyListener(myKeyListener);
    imageNo_S.addAdjustmentListener(new AdjustmentListener () {
      public void adjustmentValueChanged(AdjustmentEvent e) {
        imageNo_F.setText(String.valueOf(imageNo_S.getValue()));
        imageNo_old = imageNo;
        imageNo = imageNo_S.getValue() - 1;
        changeImageNo();
      }
    });
    imageNo_S.addKeyListener(myKeyListener);
    // チェックボックス関係
    wwwlSingle_C.addItemListener(myCheckBoxListener);
    wwwlSingle_C.addKeyListener(myKeyListener);
    wwwlALL_C.addItemListener(myCheckBoxListener);
    wwwlALL_C.addKeyListener(myKeyListener);
    move_C.addItemListener(myCheckBoxListener);
    move_C.addKeyListener(myKeyListener);
    zoom_C.addItemListener(myCheckBoxListener);
    zoom_C.addKeyListener(myKeyListener);
    loupe_C.addItemListener(myCheckBoxListener);
    loupe_C.addKeyListener(myKeyListener);
    studyInfo_C.addItemListener(new ItemListener() {
      public void itemStateChanged(ItemEvent e) {
        imageTiledCanvas.setStudyInfo_flag(studyInfo_C.getState());
      }
    });
    studyInfo_C.addKeyListener(myKeyListener);
    // CanvasSizeをScrollPaneのサイズにFitするようにする
    fit_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        getCanvasSize();
      }
    });
    fit_B.addKeyListener(myKeyListener);
    // デフォルトWW/WLボタン関係
    default_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        defaultWwWl();
      }
    });
    default_B.addKeyListener(myKeyListener);
    // 分割数を増やす
    more_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        moreFrame();
      }
    });
    more_B.addKeyListener(myKeyListener);
    // 分割数を減らす
    less_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        lessFrame();
      }
    });
    less_B.addKeyListener(myKeyListener);
    // シネ関係
    // Cineスタートとストップ
    cine_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        cineMode();
      }
    });
    cine_B.addKeyListener(myKeyListener);
    // Cine再生
    cineNext1_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        cineNext1_B.setFont(bold);
        cineNext2_B.setFont(plain);
        cinePrev1_B.setFont(plain);
        cinePrev2_B.setFont(plain);
        animationThread.changeInterval(1000);
        animationThread.changeNext(true);
      }
    });
    cineNext1_B.addKeyListener(myKeyListener);
    // Cine巻き戻し（遅い）
    cinePrev1_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        cineNext1_B.setFont(plain);
        cineNext2_B.setFont(plain);
        cinePrev1_B.setFont(bold);
        cinePrev2_B.setFont(plain);
        animationThread.changeInterval(1000);
        animationThread.changeNext(false);
      }
    });
    cinePrev1_B.addKeyListener(myKeyListener);
    // Cine早送り
    cineNext2_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        cineNext1_B.setFont(plain);
        cineNext2_B.setFont(bold);
        cinePrev1_B.setFont(plain);
        cinePrev2_B.setFont(plain);
        animationThread.changeInterval(300);
        animationThread.changeNext(true);
      }
    });
    cineNext2_B.addKeyListener(myKeyListener);
    // Cine巻き戻し（速い）
    cinePrev2_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        cineNext1_B.setFont(plain);
        cineNext2_B.setFont(plain);
        cinePrev1_B.setFont(plain);
        cinePrev2_B.setFont(bold);
        animationThread.changeInterval(300);
        animationThread.changeNext(false);
      }
    });
    cinePrev2_B.addKeyListener(myKeyListener);
    // 白黒反転ボタン関係
    inv_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        inv_flag = true;
        showTile();
        inv_flag = false;
      }
    });
    inv_B.addKeyListener(myKeyListener);
    // 90度画像回転ボタン関係
    rotateL_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        rotateL_flag = true;
        showTile();
        rotateL_flag = false;
      }
    });
    rotateL_B.addKeyListener(myKeyListener);
    rotateR_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        rotateR_flag = true;
        showTile();
        rotateR_flag = false;
      }
    });
    rotateR_B.addKeyListener(myKeyListener);
    // 左右画像反転ボタン関係
    flipLR_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        flipLR_flag = true;
        showTile();
        flipLR_flag = false;
      }
    });
    flipLR_B.addKeyListener(myKeyListener);
    // 上下画像反転ボタン関係
    flipUD_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        flipUD_flag = true;
        showTile();
        flipUD_flag = false;
      }
    });
    flipUD_B.addKeyListener(myKeyListener);
    // 初期化ボタン関係
    reset_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        reset_flag = true;
        showTile();
        reset_flag = false;
      }
    });
    reset_B.addKeyListener(myKeyListener);
    // タグボタン関係
    tag_B.addActionListener(new ActionListener () {
      public void actionPerformed(ActionEvent e) {
        if(!tagInfoFrame.isShowing()) {
          tag_B.setLabel("Hide  Tag Info");
          tagInfoFrame.setImageNo(imageNo);
          tagInfoFrame.setVisible(true);
        } else {
          tag_B.setLabel("Show  Tag Info");
          tagInfoFrame.setVisible(false);
        }
      }
    });
    tag_B.addKeyListener(myKeyListener);
    // タグフレームのWindowイベント関係
    tagInfoFrame.addWindowListener(new WindowListener() {
      public void windowClosing(WindowEvent e)
      {
        tag_B.setLabel("Show  Tag Info");
        // ウィンドーを閉じたとき捨てる
        tagInfoFrame.setVisible(false);
      }
      public void windowOpened(WindowEvent e){}
      public void windowClosed(WindowEvent e){}
      public void windowIconified(WindowEvent e){}
      public void windowDeiconified(WindowEvent e){}
      public void windowActivated(WindowEvent e){}
      public void windowDeactivated(WindowEvent e){}
    });
    // アプレット本体関係
    scrollPane1.addKeyListener(myKeyListener);
    panel1.addKeyListener(myKeyListener);
    controlPanel.addKeyListener(myKeyListener);
    buttonPanel.addKeyListener(myKeyListener);
    mousePanel.addKeyListener(myKeyListener);
    borderPanel1.addKeyListener(myKeyListener);
    infoPanel.addKeyListener(myKeyListener);
    copyrightPanel.addKeyListener(myKeyListener);
    this.addKeyListener(myKeyListener);
    this.requestFocus();
  }

  // controlPanelにGridBagLayoutを使用してコンポーネントを追加する
  private void add2controlPanel(int grid_x, int grid_y, int grid_width, Component addComp) {
    // 配置する座標をセットする
    gridBagConstraints1.gridx = grid_x;
    gridBagConstraints1.gridy = grid_y;

    // コンポーネントの幅をセットする
    gridBagConstraints1.gridwidth = grid_width;

    // コンポーネントの追加
    gridBagLayout1.setConstraints(addComp, gridBagConstraints1);
    controlPanel.add(addComp);
  }

  // mousePanelにGridBagLayoutを使用してコンポーネントを追加する
  private void add2mousePanel(int grid_x, int grid_y, int grid_width, Component addComp) {
    // 配置する座標をセットする
    gridBagConstraints2.gridx = grid_x;
    gridBagConstraints2.gridy = grid_y;

    // コンポーネントの幅をセットする
    gridBagConstraints2.gridwidth = grid_width;

    // コンポーネントの追加
    gridBagLayout2.setConstraints(addComp, gridBagConstraints2);
    mousePanel.add(addComp);
  }

  // アプレットの起動
  public void start() {
    // 一度実行していたら以下は実行しない
    if(isThreadStarted) {
      //System.out.println("isTreadStarted -> Done");
      return;
    }
    //System.out.println("Viewer.start()");

    dicomData = new DicomData();
    imageData = new ImageData();
    if(NUM > TMPSIZE) {
      // 画像総枚数がテンポラリーよりも多いときはテンポラリの大きさで確保
      arrayIndex = new int[TMPSIZE];
      dicomData_tmp = new DicomData[TMPSIZE];
      imageData_tmp = new ImageData[TMPSIZE];
      tagInfoFrame.setTagInfoFrame(TMPSIZE);
    }else {
      // 画像総枚数がテンポラリーよりも少ないときは画像総枚数の大きさで確保
      arrayIndex = new int[NUM];
      dicomData_tmp = new DicomData[NUM];
      imageData_tmp = new ImageData[NUM];
      tagInfoFrame.setTagInfoFrame(NUM);
    }
    // 画像分の確保と、値の初期化
    index = new int[NUM];
    ww = new int[NUM];
    wl = new int[NUM];
    for(int i=0; i<NUM; i++) index[i] = -1;
    for(int i=0; i<arrayIndex.length; i++) arrayIndex[i] = -1;
    for(int i=0; i<NUM; i++) ww[i] = 0;
    for(int i=0; i<NUM; i++) wl[i] = 0;

    // Dicom辞書のロード
    this.showStatus("Now Loading Dicom Dictionary....");
    DicomDic dicomDic = new DicomDic(dicURL);

    // DicomFileクラスの構築
    dicomFile = new DicomFile(isLtlEndian, vrType, privacy, dicomDic);

    // もう使わないので破棄。
    dicomDic = null;

    // スレッドスタート（dicomData, imageDataをロードする）
    // imageNoの前後配列の長さ分だけとってくる。
    int len = dicomData_tmp.length;

    if(imageNo - (len >> 1) <= 0) start =0;
    else start = imageNo - (len >> 1);
    if(start + len > NUM) start = NUM - len;

    loader = new LoaderThread(start, len, 0, this);
    start_old = start;
    loader.start();

    // 最初のデータが準備できるまで待つ
    takeData(imageNo);

    // イメージキャンバスの作成
    this.width = imageData.getWidth();
    this.height = imageData.getHeight();
    imageTiledCanvas = new ImageTiledCanvas(width, height, this);

    // キーボードのイベントを取得できるようにセットする
    imageTiledCanvas.addKeyListener(myKeyListener);

    // 画像の表示
    showTile();

    // Exceptionを吐く。よって、コメントアウト。
    // なぜならば、ScrollPane1のサイズが決定していないにも関わらずそれを計算に用いているため。
    // getCanvasSize();

    // 親に貼り付ける
    scrollPane1.add(imageTiledCanvas, null);

    // 不要なコンポーネントをdisebleにする
    if(imageData.color()) setRGBEnabled(false);
    if(NUM == 1) {
      wwwlALL_C.setEnabled(false);
      cine_B.setEnabled(false);
      more_B.setEnabled(false);
      // wwwlSingle_Cを選択状態にする
      checkboxGroup1.setSelectedCheckbox(wwwlSingle_C);
      synchro_flag = false;
    }

    isThreadStarted = true;
  }

  // アプレットの停止
  public void stop() {
    if(loader != null) {
      // もしスレッドが停止していなければ、停止要求をだす。
      if(loader.isAlive()) changeStopRequest(true);
      // 停止要求がでている間まつ
      while(requestStop) {
        try{
          //this.wait();
          // デッドロックを避けるために200msでいったんwaitをやめる
          this.wait(200);
          // スレッドが停止済みなら停止要求を解除
          if(!loader.isAlive()) changeStopRequest(false);
        }catch(InterruptedException e) {}
      }
      loader = null;
    }
    if(animationThread != null) {
      animationThread.requestStop();
      animationThread = null;
    }
  }

  // アプレットの破棄
  public void destroy() {
    stop();
  }

  // スレッドからのデータを受け取る。
  public synchronized void postData(int indexNo, int start, int end) {
    int len = dicomData_tmp.length;
    int arrayNo =0;
    int remove_index =0;
    DicomData tmpdicomData = new DicomData();
    ImageData tmpimageData = new ImageData();

    // Dicomファイルをメモリにロードする。
    showStatus("Now Loading Dicom File....  (" + (indexNo+1) + ")");
    tmpdicomData = dicomFile.load(imgURL[indexNo]);
    // Dicomイメージを生成する。
    showStatus("Now Creating Dicom Image....  (" + (indexNo+1) + ")");
    tmpimageData.setData(tmpdicomData);

    // キャッシュ範囲にないImageNoとその添え字を得る
    for(int i=0; i<arrayIndex.length; i++) {
      if((start > arrayIndex[i]) || (end <= arrayIndex[i])) {
        remove_index = arrayIndex[i];
        arrayNo = i;
      }
    }

    if(remove_index > -1) index[remove_index] = -1;
    index[indexNo] = arrayNo;
    arrayIndex[arrayNo] = indexNo;
    dicomData_tmp[arrayNo] = null;
    imageData_tmp[arrayNo] = null;
    dicomData_tmp[arrayNo] = tmpdicomData;
    imageData_tmp[arrayNo] = tmpimageData;
    tagInfoFrame.setDicomData(tmpdicomData, arrayNo, indexNo);
    this.notifyAll();
    tmpdicomData = null;
    tmpimageData = null;
  }

  // スレッドからのデータを読めるまで待つ
  public synchronized void takeData(int i) {
    while(index[i] < 0)
      try{ this.wait(); }catch(InterruptedException e) {}
    int j = index[i];
    dicomData = null;
    imageData = null;
    dicomData = dicomData_tmp[j];
    imageData = imageData_tmp[j];
    infoPanel.setDicomData(dicomData);
    this.notifyAll();
  }

  // スレッドからのデータを読めるまで待つ
  public synchronized ImageData takeImageData(int i) {
    while(index[i] < 0)
      try{ this.wait(); }catch(InterruptedException e) {}
    int j = index[i];
    this.notifyAll();
    return imageData_tmp[j];
  }

  // スレッドを止めても良いかどうか確認する
  public synchronized boolean confirmStopRequest() {
    return requestStop;
  }

  // 止めてよいかのフラグを変更する
  public synchronized void changeStopRequest(boolean flag) {
    requestStop = flag;
    this.notifyAll();
  }

  // スレッドが停止したら停止し新しいスレッドを開始する。
  public synchronized void startLoaderThread(int start, int len, int oldstart) {
    // もしスレッドが停止していなければ、停止要求をだす。
    if(loader.isAlive()) changeStopRequest(true);
    // 停止要求がでている間まつ
    while(requestStop) {
      try{
        //this.wait();
        // デッドロックを避けるために200msでいったんwaitをやめる
        this.wait(200);
        // スレッドが停止済みなら停止要求を解除
        if(!loader.isAlive()) changeStopRequest(false);
      }catch(InterruptedException e) {}
    }
    loader = null;
    // 新しいスレッドの開始
    loader = new LoaderThread(start, len, oldstart, this);
    loader.start();
    this.notifyAll();
  }

  //TextFieldの入力値を実数として得る
  private double getFieldValue(TextField textF) {
    double tmp;
    try {
      // 実数として正しい値なら、その値をfに代入
      tmp = Double.valueOf(textF.getText()).doubleValue();
    } catch(java.lang.NumberFormatException e) {
      // 数値を取得できない場合は、0.0を代入
      tmp = 0.0;
    }
    return tmp;
  }

  // ImageTiledCanvas内のドラッグによりWW/WLを変更する。
  public void drag_changeZoom(int draggedZoom) {
    // Zoomの取得
    zoom -= 0.005 * (double)draggedZoom;
    // 範囲外の検出
    if(zoom < 0.25) zoom = 0.25;
    else if(zoom > 2.0) zoom = 2.0;
    // イメージに反映させる
    imageTiledCanvas.changeZoom(zoom);
  }

  // Canvasのサイズを変更する
  private void changeCanvasSize() {
    double tmpZoom;

    // Canvasのサイズに応じて画像が全体が表示できるようにZoomの値を調整する
    tmpZoom = 100.0 / canvasSize;
    // 0.25 <= zoom <= 2.0 の範囲内に入るようにする
    if(tmpZoom > 2.0) zoom = 2.0;
    else if(tmpZoom < 0.25) zoom = 0.25;
    else zoom = tmpZoom;

    // 求めたcanvasSizeとzoomをimageTiledCanvasに通知する
    imageTiledCanvas.changeCanvasSize(canvasSize * 0.01);
    imageTiledCanvas.changeZoom(zoom);
  }

  // 最適なCanvasSizeを求める
  private void getCanvasSize() {
    int w_size, h_size, tmpSize;
    Dimension paneSize;
    paneSize = scrollPane1.getSize();

    // ScrollPaneの大きさを測って、それにちょうど入る大きさを求める
    w_size = (int)((double)paneSize.width / (double)(width * column) * 100d);
    h_size = (int)((double)paneSize.height / (double)(height * row) * 100d);
    // 縦横で小さいほうに合わせる（ScrollPaneからはみ出さないようにするため）
    if(h_size < w_size) tmpSize = h_size;
    else tmpSize = w_size;
    if(tmpSize > 100) tmpSize = 100;
    canvasSize = tmpSize;

    // 求めた大きさでCanvasの大きさを変更する
    changeCanvasSize();
  }

  // ImageCanvas ImageTiledCanvas内のドラッグによりWW/WLを変更する
  // ドラッグ中
  public void drag_changeWwWl(int draggedWW, int draggedWL) {
    int tmp_ww, tmp_wl;

    // ドラッグ中は常に1枚の画像だけ変化させる
    // WW を取得する
    tmp_ww = imageData.getWW() + draggedWW;
    // 範囲外の検出
    if(tmp_ww < 0) tmp_ww = 0;
    else if(tmp_ww > imageData.getPixelMax() - imageData.getPixelMin())
      tmp_ww = imageData.getPixelMax() - imageData.getPixelMin();

    // WL を取得する
    tmp_wl = imageData.getWL() + draggedWL;
    // 範囲外の検出
    if(tmp_wl < imageData.getPixelMin()) tmp_wl = imageData.getPixelMin();
    else if(tmp_wl > imageData.getPixelMax()) tmp_wl = imageData.getPixelMax();

    // WW/WLをセットし、画像を表示
    imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, imageNo - tile_start);
    imageTiledCanvas.changeImage(imageData.wwANDwl(tmp_ww, tmp_wl), imageNo - tile_start);
  }
  // ドラッグ終了時
  public void dragDone_changeWwWl(int draggedWW, int draggedAllWW, int draggedWL, int draggedAllWL) {
    int tmp_ww, tmp_wl;

    // シンクロしていない時は1枚の画像だけ変化させる
    if(!synchro_flag){
      // WW を取得する
      tmp_ww = imageData.getWW() + draggedWW;
      // 範囲外の検出
      if(tmp_ww < 0) tmp_ww = 0;
      else if(tmp_ww > imageData.getPixelMax() - imageData.getPixelMin())
        tmp_ww = imageData.getPixelMax() - imageData.getPixelMin();

      // WL を取得する
      tmp_wl = imageData.getWL() + draggedWL;
      // 範囲外の検出
      if(tmp_wl < imageData.getPixelMin()) tmp_wl = imageData.getPixelMin();
      else if(tmp_wl > imageData.getPixelMax()) tmp_wl = imageData.getPixelMax();

      // WW/WLをセットし、画像を表示
      imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, imageNo - tile_start);
      imageTiledCanvas.changeImage(imageData.wwANDwl(tmp_ww, tmp_wl), imageNo - tile_start);

      // WW/WLの変化量を記録する
      ww[imageNo] += draggedAllWW;
      wl[imageNo] += draggedAllWL;

    // 全ての画像を変化させる場合。
    }else {
      int max;
      int tmpNo =0;
      ImageData tmpImageData;
      max = row * column;

      for(int i = tile_start; i < tile_start + max; i++) {
        if (tmpNo >= dicomData_tmp.length) break;

        // ImageDataを取得する
        tmpImageData = takeImageData(i);

        // ドラッグ中に変化させていた画像(注目画像)の場合
        if(i == imageNo) {
          // WW を取得する
          tmp_ww = tmpImageData.getWW() + draggedWW;
          // 範囲外の検出
          if(tmp_ww < 0) tmp_ww = 0;
          else if(tmp_ww > tmpImageData.getPixelMax() - tmpImageData.getPixelMin())
            tmp_ww = tmpImageData.getPixelMax() - tmpImageData.getPixelMin();

          // WL を取得する
          tmp_wl = tmpImageData.getWL() + draggedWL;
          // 範囲外の検出
          if(tmp_wl < tmpImageData.getPixelMin()) tmp_wl = tmpImageData.getPixelMin();
          else if(tmp_wl > tmpImageData.getPixelMax()) tmp_wl = tmpImageData.getPixelMax();

        // 注目画像以外
        }else {
          // WW を取得する
          tmp_ww = tmpImageData.getWW() + draggedAllWW;
          // 範囲外の検出
          if(tmp_ww < 0) tmp_ww = 0;
          else if(tmp_ww > tmpImageData.getPixelMax() - tmpImageData.getPixelMin())
            tmp_ww = tmpImageData.getPixelMax() - tmpImageData.getPixelMin();

          // WL を取得する
          tmp_wl = tmpImageData.getWL() + draggedAllWL;
          // 範囲外の検出
          if(tmp_wl < tmpImageData.getPixelMin()) tmp_wl = tmpImageData.getPixelMin();
          else if(tmp_wl > tmpImageData.getPixelMax()) tmp_wl = tmpImageData.getPixelMax();
        }

        // WW/WLをセットし、画像を表示
        imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, tmpNo);
        imageTiledCanvas.setImage(tmpImageData.wwANDwl(tmp_ww, tmp_wl), tmpNo);
        tmpNo++;
      }
      for(int i = tmpNo; i < max; i++) {
        imageTiledCanvas.setImage(null, i);
      }
      // 全てのWW/WLのデフォルト値との差を保存する
      for(int i=0; i<NUM; i++) ww[i] += draggedAllWW;
      for(int i=0; i<NUM; i++) wl[i] += draggedAllWL;
    }
  }

  // WW/WLをデフォルト値に戻す
  private void defaultWwWl() {
    int tmp_ww, tmp_wl;

    if(!synchro_flag){
      tmp_ww = imageData.getDefaultWW();
      tmp_wl = imageData.getDefaultWL();

      // 注目画像のWW/WLのみをデフォルト値にし、イメージを交換する
      imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, imageNo - tile_start);
      imageTiledCanvas.changeImage(imageData.wwANDwl(tmp_ww, tmp_wl), imageNo - tile_start);

      // 注目画像のWW/WLのデフォルト値からの差を0とする
      ww[imageNo] =0;
      wl[imageNo] =0;

    }else {
      int max;
      int tmpNo =0;
      ImageData tmpImageData;
      max = row * column;

      // WW/WLをデフォルトにして全ての画像を表示しなおす。
      for(int i = tile_start; i < tile_start + max; i++) {
        if (tmpNo >= dicomData_tmp.length) break;

        tmpImageData = takeImageData(i);
        tmp_ww = tmpImageData.getDefaultWW();
        tmp_wl = tmpImageData.getDefaultWL();

        imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, tmpNo);
        imageTiledCanvas.setImage(tmpImageData.wwANDwl(tmp_ww, tmp_wl), tmpNo);
        tmpNo++;
      }
      for(int i = tmpNo; i < max; i++) {
        imageTiledCanvas.setImage(null, i);
      }
      // 全てのWW/WLのデフォルト値との差を0とする
      for(int i=0; i<NUM; i++) ww[i] = 0;
      for(int i=0; i<NUM; i++) wl[i] = 0;
    }
  }

  // シネモード
  private void cineMode() {
    // Cineスタートさせる
    if(animationThread == null) {
      notCine = false;
      cine_B.setLabel("Stop");
      cineNext1_B.setFont(bold);
      cineNext2_B.setFont(plain);
      cinePrev1_B.setFont(plain);
      cinePrev2_B.setFont(plain);
      cineNext1_B.setEnabled(true);
      cinePrev1_B.setEnabled(true);
      cineNext2_B.setEnabled(true);
      cinePrev2_B.setEnabled(true);
      animationThread = new AnimationThread(this);
      animationThread.start();

    // すでにスタートしている場合はストップする
    }else {
      notCine = true;
      cine_B.setLabel("Cine Mode");
      cineNext1_B.setEnabled(false);
      cineNext2_B.setEnabled(false);
      cinePrev1_B.setEnabled(false);
      cinePrev2_B.setEnabled(false);
      animationThread.requestStop();
      animationThread = null;
    }
  }

  // imageNoを変更する
  public void changeImageNo() {
    // スレッドスタート（dicomData, imageDataをロードする）
    int len = dicomData_tmp.length;

    if(imageNo - (len >> 1) <= 0) start =0;
    else start = imageNo - (len >> 1);
    if(start + len > NUM) start = NUM - len;

    startLoaderThread(start, len, start_old);
    //loader = new LoaderThread(start, len, start_old, this);
    start_old = start;
    //loader.start();

    showTile();
    //scrollPane1.doLayout();
    //scrollPane1.validate();
  }

  // 画像分割数を増やす
  private void moreFrame() {
    double    height_space, width_space;
    double    tmpSize = canvasSize * 0.01;
    Dimension paneSize = scrollPane1.getSize();

    if(!less_B.isEnabled()) less_B.setEnabled(true);

    // 多くスペースが空いている方に分割数を増やす
    height_space = (double)paneSize.height - (double)(height * tmpSize * row);
    width_space = (double)paneSize.width - (double)(width * tmpSize * column);
    if(height_space > width_space) row = row +1;
    else column = column +1;
    if(row >9) row =9;
    if(column >9) column =9;
    getCanvasSize();

    if(row * column >= arrayIndex.length) more_B.setEnabled(false);
    showTile();
    // ScrollPaneの背景を再描画してもらう
    scrollPane1.setVisible(false);
    scrollPane1.setBackground(Color.black);
    scrollPane1.setVisible(true);
  }

  // 画像分割数を減らす
  private void lessFrame() {
    double    height_space, width_space;
    double    tmpSize = canvasSize * 0.01;
    Dimension paneSize = scrollPane1.getSize();

    if(!more_B.isEnabled()) more_B.setEnabled(true);

    // スペースの少ないほうの分割数を減らす
    height_space = (double)paneSize.height - (double)(height * tmpSize * row);
    width_space = (double)paneSize.width - (double)(width * tmpSize * column);
    if(height_space < width_space) {
      if(row == 1) column = column -1;
        else row = row -1;
      }else {
        if(column == 1) row = row -1;
        else column = column -1;
      }
    if(row < 1) row =1;
    if(column < 1) column =1;
    getCanvasSize();

    if(row * column == 1) less_B.setEnabled(false);
    showTile();
    // ScrollPaneの背景を再描画してもらう
    scrollPane1.setVisible(false);
    scrollPane1.setBackground(Color.black);
    scrollPane1.setVisible(true);
  }

  // 注目画像の変更
  public void changeActive(int i) {
    //カレントのDicomData ImageDataを入れ替える
    int j = index[i];
    if(j == -1) return; // 画像が無い場合はなにもしない。
    dicomData = null;
    imageData = null;
    dicomData = dicomData_tmp[j];
    imageData = imageData_tmp[j];
    infoPanel.setDicomData(dicomData);

    // 各種表示の変更
    imageNo = i;
    imageNo_F.setText(String.valueOf(i +1));
    imageNo_S.setValue(i +1);
    if(imageData.color()) setRGBEnabled(false);
    else setRGBEnabled(true);
  }

  // Tile表示のメソッド
  private void showTile() {
    int max = row * column;
    int len = dicomData_tmp.length;
    imageTiledCanvas.setTileType(row, column);
    int tmpNo = 0;

    // すでに読み込んでいる画像のスタート番号を得る
    if(imageNo - (max >> 1) <= 0) tile_start =0;
    else tile_start = imageNo - (max >> 1);
    if(tile_start + max > start + len) tile_start = start + len - max;
    if(tile_start < start) tile_start = start;
    imageTiledCanvas.setStartNo(tile_start);

    ImageData tmpImageData;

    for(int i = tile_start; i < tile_start + max; i++) {
      if (tmpNo >= len) break;

      // 画像が準備できるまで待つ
      tmpImageData = takeImageData(i);

      // フラグがたっている場合はそれぞれ画像処理
      if(inv_flag) tmpImageData.inverse();
      // if(color_flag) tmpImageData.changeColor();
      if(rotateL_flag) tmpImageData.rotateL();
      if(rotateR_flag) tmpImageData.rotateR();
      if(flipLR_flag) tmpImageData.flipLR();
      if(flipUD_flag) tmpImageData.flipUD();
      if(reset_flag) tmpImageData.setDefaultPixel();

      // 選択画像のセット
      if(i == imageNo) imageTiledCanvas.setActiveNo(tmpNo);

      // WW/WLのデフォルトからの差を使ってイメージを作成する
      imageTiledCanvas.setImage(tmpImageData.getImageWWWL2Current(ww[i], wl[i]), tmpNo);
      // imageTiledCanvasにもそのときのWW/WLと検査情報を通知する
      imageTiledCanvas.setWW_WL(tmpImageData.getWW(), tmpImageData.getWL(), tmpNo);
      imageTiledCanvas.setStudyInfo(dicomData_tmp[index[i]], tmpNo);
      tmpNo++;
    }
    for(int i = tmpNo; i < max; i++) {
      imageTiledCanvas.setImage(null, i);
      imageTiledCanvas.setStudyInfo(null, tmpNo);
    }

    // データの準備ができるまで待つ
    takeData(imageNo);

    // 画像がRGBカラーだった場合、コンポーネントをFalseにする
    if(imageData.color()) setRGBEnabled(false);
    else setRGBEnabled(true);
  }

  // DICOM RGB の時に不要になるコンポーネントたち。
  private void setRGBEnabled(boolean flag) {
    default_B.setEnabled(flag);
    // color_B.setEnabled(flag);
    inv_B.setEnabled(flag);
    wwwlSingle_C.setEnabled(flag);
    if(NUM == 1) wwwlALL_C.setEnabled(false);
    else wwwlALL_C.setEnabled(flag);
    if(!flag && (wwwlSingle_C.getState() || wwwlALL_C.getState())) {
      move_C.setState(true);
      imageTiledCanvas.setMoveState(true);
    }
  }

  // このアプレットがキーボードイベントを受けれるように設定する
  public boolean isFocusTraversable() { return true; }

  //アプレット情報の取得
  public String getAppletInfo() {
    return "Applet Information";
  }

  // static initializer for setting look & feel
  static {
    try {
      //UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
      //UIManager.setLookAndFeel(UIManager.getCrossPlatformLookAndFeelClassName());
    }
    catch (Exception e) {}
  }

  // チェックボックス用のイベントリスナー
  class MyCheckBoxListener implements ItemListener {
    public void itemStateChanged(ItemEvent e) {

      // WW/WL関係のチェックボックスが変化した場合は、synchro_flagも変化させる
      if(wwwlSingle_C.getState()) synchro_flag = false;
      else if(wwwlALL_C.getState()) synchro_flag = true;

      // 現在のチェックボックスの状態をimageTiledCanvasにも知らせる
      imageTiledCanvas.setMoveState(move_C.getState());
      imageTiledCanvas.setZoomState(zoom_C.getState());
      imageTiledCanvas.setLoupeState(loupe_C.getState());
    }
  }

  // 選択されているチェックボックスを変更する
  private void changeSelectCheckBox(Checkbox checkbox) {

    // 引数のチェックボックスを選択状態にする
    checkboxGroup1.setSelectedCheckbox(checkbox);

    // WW/WL関係のチェックボックスが変化した場合は、synchro_flagも変化させる
    if(checkbox == wwwlSingle_C) synchro_flag = false;
    else if(checkbox == wwwlALL_C) synchro_flag = true;
    
    // 現在のチェックボックスの状態をimageTiledCanvasにも知らせる
    imageTiledCanvas.setMoveState(move_C.getState());
    imageTiledCanvas.setZoomState(zoom_C.getState());
    imageTiledCanvas.setLoupeState(loupe_C.getState());
  }

  // キーボードにより、Zoom を変化させる。
  private void key_changeZoom(double value) {
    double tmpZoom;

    // Canvasのサイズに応じて画像が全体が表示できるようにZoomの値を調整する
    tmpZoom = 100.0 / canvasSize;
    // 0.25 <= zoom <= 2.0 の範囲内に入るようにする
    if(tmpZoom > 2.0) tmpZoom = 2.0;
    else if(tmpZoom < 0.25) tmpZoom = 0.25;

    // Zoomの取得
    zoom = tmpZoom * value;
    // 範囲外の検出
    if(zoom < 0.25) zoom = 0.25;
    else if(zoom > 2.0) zoom = 2.0;

    // イメージに反映させる
    imageTiledCanvas.changeZoom(zoom);
  }

  // キーボードにより、WL/WW を変化させる。
  private void key_changeWwWl(double key_ww, double key_wl) {
    int tmp_ww, tmp_wl, tmp_wwwl;

    // シンクロしていない時は1枚の画像だけ変化させる
    if(!synchro_flag){
      // PixelMax - PixelMinを求める
      tmp_wwwl = imageData.getPixelMax() - imageData.getPixelMin();

      // WW を取得する
      tmp_ww = imageData.getDefaultWW() + ww[imageNo] + (int)(tmp_wwwl * key_ww);

      // 範囲外の検出
      if(tmp_ww < 0) tmp_ww = 0;
      else if(tmp_ww > tmp_wwwl) tmp_ww = tmp_wwwl;

      // WL を取得する
      tmp_wl = imageData.getDefaultWL() + wl[imageNo] + (int)(tmp_ww * key_wl);
      // 範囲外の検出
      if(tmp_wl < imageData.getPixelMin()) tmp_wl = imageData.getPixelMin();
      else if(tmp_wl > imageData.getPixelMax()) tmp_wl = imageData.getPixelMax();

      // WW/WLをセットし、画像を表示
      imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, imageNo - tile_start);
      imageTiledCanvas.changeImage(imageData.wwANDwl(tmp_ww, tmp_wl), imageNo - tile_start);

    // 全ての画像を変化させる場合。
    }else {
      int max;
      int tmpNo =0;
      ImageData tmpImageData;
      max = row * column;

      for(int i = tile_start; i < tile_start + max; i++) {
        if (tmpNo >= dicomData_tmp.length) break;

        // ImageDataを取得する
        tmpImageData = takeImageData(i);

        // PixelMax - PixelMinを求める
        tmp_wwwl = tmpImageData.getPixelMax() - tmpImageData.getPixelMin();

        // WW を取得する
        tmp_ww = tmpImageData.getDefaultWW() + ww[i] + (int)(tmp_wwwl * key_ww);
        // 範囲外の検出
        if(tmp_ww < 0) tmp_ww = 0;
        else if(tmp_ww > tmp_wwwl) tmp_ww = tmp_wwwl;

        // WL を取得する
        tmp_wl = tmpImageData.getDefaultWL() + wl[i] + (int)(tmp_ww * key_wl);
        // 範囲外の検出
        if(tmp_wl < tmpImageData.getPixelMin()) tmp_wl = tmpImageData.getPixelMin();
        else if(tmp_wl > tmpImageData.getPixelMax()) tmp_wl = tmpImageData.getPixelMax();

        // WW/WLをセットし、画像を表示
        imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, tmpNo);
        imageTiledCanvas.setImage(tmpImageData.wwANDwl(tmp_ww, tmp_wl), tmpNo);
        tmpNo++;
      }
      for(int i = tmpNo; i < max; i++) {
        imageTiledCanvas.setImage(null, i);
      }
    }
  }

  // キーボードイベント用のリスナークラス
  class MyKeyListener implements KeyListener {
    boolean isWW = false; // WLの操作を行うときfalse, WWの操作を行うときtrue;

    // キーをタイプしたとき
    public void keyTyped(KeyEvent e) {
      // char keyChar = e.getKeyChar();
        // デバック
        // System.out.println(keyChar);
    }

    // キーを押したとき
    public void keyPressed(KeyEvent e) {
      int keyCode = e.getKeyCode();

      // コントロール＋何かのキーが押されたときの処理
      if(e.isControlDown()) {
        // Ctrl+W
        if(keyCode == KeyEvent.VK_W) {
          // WL
          isWW = false;
          if(e.isShiftDown()) {
            // + Shift
            // WL/WW Single
            changeSelectCheckBox(wwwlSingle_C);
          }else {
            // WL/WW ALL
            changeSelectCheckBox(wwwlALL_C);
          }
        // Ctrl+Q
        }else if(keyCode == KeyEvent.VK_Q) {
          // WW
          isWW = true;
          if(e.isShiftDown()) {
            // + Shift
            // WL/WW Single
            changeSelectCheckBox(wwwlSingle_C);
          }else {
            // WL/WW ALL
            changeSelectCheckBox(wwwlALL_C);
          }
        // Ctrl+O
        }else if(keyCode == KeyEvent.VK_O) {
          // Move mode
          changeSelectCheckBox(move_C);
        // Ctrl+Z
        }else if(keyCode == KeyEvent.VK_Z) {
          // Zooming mode
          changeSelectCheckBox(zoom_C);
        // Ctrl+U
        }else if(keyCode == KeyEvent.VK_U) {
          // Loupe mode
          changeSelectCheckBox(loupe_C);
        // Ctrl+D
        }else if(keyCode == KeyEvent.VK_D) {
          // Default WL/WW
          defaultWwWl();
        // Ctrl+I
        }else if(keyCode == KeyEvent.VK_I) {
          if(e.isShiftDown()) {
            // + Shift
            // アノテーション
            studyInfo_C.setState(!studyInfo_C.getState());
            imageTiledCanvas.setStudyInfo_flag(studyInfo_C.getState());
          }else {
            if(notCine) {
              // 画像白黒反転
              inv_flag = true;
              showTile();
              inv_flag = false;
            }else {
              // 遅い巻き戻し
              cineNext1_B.setFont(plain);
              cineNext2_B.setFont(plain);
              cinePrev1_B.setFont(bold);
              cinePrev2_B.setFont(plain);
              animationThread.changeInterval(1000);
              animationThread.changeNext(false);
            }
          }
        // Ctrl+T
        }else if(keyCode == KeyEvent.VK_T) {
          if(e.isShiftDown()) {
            // + Shift
            // タグ表示
            if(!tagInfoFrame.isShowing()) {
              tag_B.setLabel("Hide  Tag Info");
              tagInfoFrame.setImageNo(imageNo);
              tagInfoFrame.setVisible(true);
            }else {
              tag_B.setLabel("Show  Tag Info");
              tagInfoFrame.setVisible(false);
            }
          }else {
            if(notCine) {
              // Rest Zoom/Move
              getCanvasSize();
            }else {
              // 遅い再生
              cineNext1_B.setFont(bold);
              cineNext2_B.setFont(plain);
              cinePrev1_B.setFont(plain);
              cinePrev2_B.setFont(plain);
              animationThread.changeInterval(1000);
              animationThread.changeNext(true);
            }
          }
        // Ctrl+R
        }else if(keyCode == KeyEvent.VK_R) {
          if(e.isShiftDown()) {
            // + Shift
            // RotateR
            rotateR_flag = true;
            showTile();
            rotateR_flag = false;
          }else {
            if(notCine) {
              // RotateL
              rotateL_flag = true;
              showTile();
              rotateL_flag = false;
            }else {
              // 速い巻き戻し
              cineNext1_B.setFont(plain);
              cineNext2_B.setFont(plain);
              cinePrev1_B.setFont(plain);
              cinePrev2_B.setFont(bold);
              animationThread.changeInterval(300);
              animationThread.changeNext(false);
            }
          }
        // Ctrl+F
        }else if(keyCode == KeyEvent.VK_F) {
          if(e.isShiftDown()) {
            // + Shift
            // FlipLR
            flipLR_flag = true;
            showTile();
            flipLR_flag = false;
          }else {
            if(notCine) {
              // FlipUD
              flipUD_flag = true;
              showTile();
              flipUD_flag = false;
            }else {
              // 早送り
              cineNext1_B.setFont(plain);
              cineNext2_B.setFont(bold);
              cinePrev1_B.setFont(plain);
              cinePrev2_B.setFont(plain);
              animationThread.changeInterval(300);
              animationThread.changeNext(true);
            }
          }
        // Ctrl+C
        }else if(keyCode == KeyEvent.VK_C) {
          if(e.isShiftDown()) {
            // + Shift
            // Cine start/stop
            cineMode();
          }else {
            if(notCine) {
              // Rest Angle
              reset_flag = true;
              showTile();
              reset_flag = false;
            }else {
              // Cine stop
              cineMode();
            }
          }
        // Ctrl+M
        }else if(keyCode == KeyEvent.VK_M) {
          // 画面分割を増やす
          if(more_B.isEnabled()) moreFrame();
        // Ctrl+L
        }else if(keyCode == KeyEvent.VK_L) {
          // 画面分割を減らす
          if(less_B.isEnabled()) lessFrame();
        // Ctrl+1
        }else if(keyCode == KeyEvent.VK_1) {
          if(zoom_C.getState()) {
            // zoomのとき
            if(e.isShiftDown()) {
              key_changeZoom(1.0);
            }else {
              key_changeZoom(1.0);
            }
          }else {
            if(!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {
              // 選択をWL/WW ALLにして、WL/WWを変化させる
              changeSelectCheckBox(wwwlALL_C);
            }
            if(isWW) {
              // WW
              if(e.isShiftDown()) {
                key_changeWwWl(0, 0);
              }else {
                key_changeWwWl(0, 0);
              }
            }else {
              // WL
              if(e.isShiftDown()) {
                key_changeWwWl(0, 0);
              }else {
                key_changeWwWl(0, 0);
              }
            }
          }
        // Ctrl+2
        }else if(keyCode == KeyEvent.VK_2) {
          if(zoom_C.getState()) {
            // zoomのとき
            if(e.isShiftDown()) {
              key_changeZoom(0.9);
            }else {
              key_changeZoom(1.2);
            }
          }else {
            if(!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {
              // 選択をWL/WW ALLにして、WL/WWを変化させる
              changeSelectCheckBox(wwwlALL_C);
            }
            if(isWW) {
              // WW
              if(e.isShiftDown()) {
                key_changeWwWl(-0.01, 0);
              }else {
                key_changeWwWl(0.01, 0);
              }
            }else {
              // WL
              if(e.isShiftDown()) {
                key_changeWwWl(0, -0.01);
              }else {
                key_changeWwWl(0, 0.01);
              }
            }
          }
        // Ctrl+3
        }else if(keyCode == KeyEvent.VK_3) {
          if(zoom_C.getState()) {
            // zoomのとき
            if(e.isShiftDown()) {
              key_changeZoom(0.8);
            }else {
              key_changeZoom(1.4);
            }
          }else {
            if(!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {
              // 選択をWL/WW ALLにして、WL/WWを変化させる
              changeSelectCheckBox(wwwlALL_C);
            }
            if(isWW) {
              // WW
              if(e.isShiftDown()) {
                key_changeWwWl(-0.02, 0);
              }else {
                key_changeWwWl(0.02, 0);
              }
            }else {
              // WL
              if(e.isShiftDown()) {
                key_changeWwWl(0, -0.02);
              }else {
                key_changeWwWl(0, 0.02);
              }
            }
          }
        // Ctrl+4
        }else if(keyCode == KeyEvent.VK_4) {
          if(zoom_C.getState()) {
            // zoomのとき
            if(e.isShiftDown()) {
              key_changeZoom(0.7);
            }else {
              key_changeZoom(1.6);
            }
          }else {
            if(!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {
              // 選択をWL/WW ALLにして、WL/WWを変化させる
              changeSelectCheckBox(wwwlALL_C);
            }
            if(isWW) {
              // WW
              if(e.isShiftDown()) {
                key_changeWwWl(-0.03, 0);
              }else {
                key_changeWwWl(0.03, 0);
              }
            }else {
              // WL
              if(e.isShiftDown()) {
                key_changeWwWl(0, -0.03);
              }else {
                key_changeWwWl(0, 0.03);
              }
            }
          }
        // Ctrl+5
        }else if(keyCode == KeyEvent.VK_5) {
          if(zoom_C.getState()) {
            // zoomのとき
            if(e.isShiftDown()) {
              key_changeZoom(0.6);
            }else {
              key_changeZoom(1.8);
            }
          }else {
            if(!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {
              // 選択をWL/WW ALLにして、WL/WWを変化させる
              changeSelectCheckBox(wwwlALL_C);
            }
            if(isWW) {
              // WW
              if(e.isShiftDown()) {
                key_changeWwWl(-0.05, 0);
              }else {
                key_changeWwWl(0.05, 0);
              }
            }else {
              // WL
              if(e.isShiftDown()) {
                key_changeWwWl(0, -0.05);
              }else {
                key_changeWwWl(0, 0.05);
              }
            }
          }
        // Ctrl+6
        }else if(keyCode == KeyEvent.VK_6) {
          if(zoom_C.getState()) {
            // zoomのとき
            if(e.isShiftDown()) {
              key_changeZoom(0.5);
            }else {
              key_changeZoom(2.0);
            }
          }else {
            if(!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {
              // 選択をWL/WW ALLにして、WL/WWを変化させる
              changeSelectCheckBox(wwwlALL_C);
            }
            if(isWW) {
              // WW
              if(e.isShiftDown()) {
                key_changeWwWl(-0.1, 0);
              }else {
                key_changeWwWl(0.1, 0);
              }
            }else {
              // WL
              if(e.isShiftDown()) {
                key_changeWwWl(0, -0.1);
              }else {
                key_changeWwWl(0, 0.1);
              }
            }
          }
        // Ctrl+7
        }else if(keyCode == KeyEvent.VK_7) {
          if(zoom_C.getState()) {
            // zoomのとき
            if(e.isShiftDown()) {
              key_changeZoom(0.4);
            }else {
              key_changeZoom(2.2);
            }
          }else {
            if(!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {
              // 選択をWL/WW ALLにして、WL/WWを変化させる
              changeSelectCheckBox(wwwlALL_C);
            }
            if(isWW) {
              // WW
              if(e.isShiftDown()) {
                key_changeWwWl(-0.2, 0);
              }else {
                key_changeWwWl(0.2, 0);
              }
            }else {
              // WL
              if(e.isShiftDown()) {
                key_changeWwWl(0, -0.2);
              }else {
                key_changeWwWl(0, 0.2);
              }
            }
          }
        // Ctrl+8
        }else if(keyCode == KeyEvent.VK_8) {
          if(zoom_C.getState()) {
            // zoomのとき
            if(e.isShiftDown()) {
              key_changeZoom(0.3);
            }else {
              key_changeZoom(2.4);
            }
          }else {
            if(!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {
              // 選択をWL/WW ALLにして、WL/WWを変化させる
              changeSelectCheckBox(wwwlALL_C);
            }
            if(isWW) {
              // WW
              if(e.isShiftDown()) {
                key_changeWwWl(-0.4, 0);
              }else {
                key_changeWwWl(0.4, 0);
              }
            }else {
              // WL
              if(e.isShiftDown()) {
                key_changeWwWl(0, -0.4);
              }else {
                key_changeWwWl(0, 0.4);
              }
            }
          }
        // Ctrl+9
        }else if(keyCode == KeyEvent.VK_9) {
          // イメージ番号を減らす
          if(imageNo > 0) {
            imageNo_old = imageNo;
            imageNo -= 1;
            imageNo_S.setValue(imageNo +1);
            imageNo_F.setText(String.valueOf(imageNo +1));
            changeImageNo();
          }
        // Ctrl+0
        }else if(keyCode == KeyEvent.VK_0) {
          // イメージ番号を増やす
          if(imageNo < (NUM -1)){
            imageNo_old = imageNo;
            imageNo += 1;
            imageNo_S.setValue(imageNo +1);
            imageNo_F.setText(String.valueOf(imageNo +1));
            changeImageNo();
          }
        }
      }
    }

    // キーを放したとき
    public void keyReleased(KeyEvent e) {
      int keyCode = e.getKeyCode();
    }
  }

}

