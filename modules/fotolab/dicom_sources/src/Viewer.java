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
package src;

import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import java.util.Locale;
import java.util.ResourceBundle;

public class Viewer extends Applet {

    int debug_level = 3;
    boolean isLtlEndian;
    boolean vrType;
    boolean privacy;
    int NUM;
    String dicURL;
    String[] imgURL;
    DicomFile dicomFile;
    DicomData dicomData;
    ImageData imageData;
    DicomData[] dicomData_tmp;
    ImageData[] imageData_tmp;
    int[] index;
    int TMPSIZE;
    int[] arrayIndex;
    int start;
    int start_old;
    int[] ww, wl;
    double zoom = 1.0;
    int canvasSize = 100;
    boolean inv_flag = false;
    // boolean           color_flag = false;
    boolean rotateL_flag = false;
    boolean rotateR_flag = false;
    boolean flipLR_flag = false;
    boolean flipUD_flag = false;
    boolean reset_flag = false;
    int imageNo;
    boolean synchro_flag = true;
    int imageNo_old;
    LoaderThread loader;
    boolean isThreadStarted;
    boolean requestStop = false;
    ImageTiledCanvas imageTiledCanvas;
    int row = 1;
    int column = 1;
    TagInfoFrame tagInfoFrame;
    int tile_start;
    int width, height;
    AnimationThread animationThread;
    boolean notCine = true;
    // EventListener
    MyCheckBoxListener myCheckBoxListener = new MyCheckBoxListener();
    MyKeyListener myKeyListener = new MyKeyListener();
    // Font
    Font bold = new Font("Dialog", Font.BOLD, 12);
    Font plain = new Font("Dialog", Font.PLAIN, 12);
    // Layout
    BorderLayout borderLayout1 = new BorderLayout();
    GridBagLayout gridBagLayout1 = new GridBagLayout();
    GridBagLayout gridBagLayout2 = new GridBagLayout();
    GridBagConstraints gridBagConstraints1 = new GridBagConstraints();
    GridBagConstraints gridBagConstraints2 = new GridBagConstraints();
    //resource boundle
    ResourceBundle _resbundle = ResourceBundle.getBundle("locale/dicom", Locale.getDefault());
    // Panel
    ScrollPane scrollPane1 = new ScrollPane();
    Panel panel1 = new Panel();
    Panel controlPanel = new Panel();
    BorderPanel borderPanel1 = new BorderPanel(_resbundle.getString("MOUSE_MANUPILATION"));
    Panel mousePanel = new Panel();
    InfoPanel infoPanel = new InfoPanel();
    Panel buttonPanel = new Panel();
    Panel copyrightPanel = new Panel();
    // Label
    Label label1 = new Label();
    Label label2 = new Label(_resbundle.getString("IMAGENO"));
    MyLabel copyright_L = new MyLabel("Copyright (C) 2000 Nagoya Institute of Technology, Iwata lab. & KtC");
    //MyLabel copyright_L   = new MyLabel("@see http://mars.elcom.nitech.ac.jp/dicom/index-e.html");
    // TextField
    TextField imageNo_F = new TextField(3);
    // Scrollbar
    Scrollbar imageNo_S = new Scrollbar(Scrollbar.HORIZONTAL);
    // Checkbox
    CheckboxGroup checkboxGroup1 = new CheckboxGroup();
    Checkbox wwwlSingle_C = new Checkbox(_resbundle.getString("MOVE"), false, checkboxGroup1);
    Checkbox wwwlALL_C = new Checkbox(_resbundle.getString("WL_WW_ALL_IMAGES"), true, checkboxGroup1);
    Checkbox move_C = new Checkbox(_resbundle.getString("MOVE"), false, checkboxGroup1);
    Checkbox zoom_C = new Checkbox(_resbundle.getString("ZOOM"), false, checkboxGroup1);
    Checkbox loupe_C = new Checkbox(_resbundle.getString("LOUPE"), false, checkboxGroup1);
    Checkbox studyInfo_C = new Checkbox(_resbundle.getString("ANNOTATION"), true);
    // Button
    Button fit_B = new Button(_resbundle.getString("RESET_MOVE_ZOOM"));
    Button default_B = new Button(_resbundle.getString("DEFAULT_WL_WW"));
    Button less_B = new Button(_resbundle.getString("LESSFRAME"));
    Button more_B = new Button(_resbundle.getString("MOREFRAME"));
    Button tag_B = new Button(_resbundle.getString("SHOW_TAG_INFO"));
    Button inv_B = new Button(_resbundle.getString("REVERSE"));
    Button rotateL_B = new Button(_resbundle.getString("ROTATE_L"));
    Button rotateR_B = new Button(_resbundle.getString("ROTATE_R"));
    Button flipLR_B = new Button(_resbundle.getString("FLIP_RL"));
    Button flipUD_B = new Button(_resbundle.getString("FLIP_UD"));
    Button reset_B = new Button(_resbundle.getString("RESET_ANGLE"));
    Button cine_B = new Button(_resbundle.getString("CINE_MODE"));
    Button cineNext1_B = new Button(_resbundle.getString("NEXT"));
    Button cinePrev1_B = new Button(_resbundle.getString("PREV"));
    Button cineNext2_B = new Button(_resbundle.getString("FF"));
    Button cinePrev2_B = new Button(_resbundle.getString("REW"));

    public String getParameter(String key, String def) {
        String paramString;
        paramString = getParameter(key) != null ? getParameter(key) : def;


        if (debug_level > 3) {
            System.out.println(_resbundle.getString("PARAMETER") + key + _resbundle.getString("IS") + paramString);
        }

        return paramString;
    }

    public String[][] getParameterInfo() {
        String[][] pinfo = {
            {"isLtlEndian", "boolean", ""},
            {"vrType", "boolean", ""},
            {"patientPrivacy", "boolean", ""},
            {"tmpSize", "int", ""},
            {"NUM", "int", ""},
            {"currentNo", "int", ""},
            {"dicURL", "String", ""},
            {"imgURL", "String", ""},};
        return pinfo;
    }

    public Viewer() {
    }

    public void init() {

        if (debug_level > 3) {
            System.out.println(_resbundle.getString("NOW_LOADING_PARAMETER"));
        }
        try {

            isLtlEndian = Boolean.valueOf(this.getParameter("isLtlEndian", "true")).booleanValue();
            vrType = Boolean.valueOf(this.getParameter("vrType", "false")).booleanValue();
            privacy = Boolean.valueOf(this.getParameter("patientPrivacy", "false")).booleanValue();
            TMPSIZE = Integer.parseInt(this.getParameter("tmpSize", "10"));
            NUM = Integer.parseInt(this.getParameter("NUM", "1"));
            imageNo = Integer.parseInt(this.getParameter("currentNo", "0"));
            dicURL = this.getParameter("dicURL", "none");
            imgURL = new String[NUM];
            for (int i = 0; i < NUM; i++) {
                imgURL[i] = this.getParameter("imgURL" + i, "");
            }


            jbInit();
        } catch (Exception e) {

            e.printStackTrace();
        }
    }

    private void jbInit() throws Exception {

        isThreadStarted = false;

        // this.setSize(new Dimension(700,500));
        this.setLayout(borderLayout1);
        controlPanel.setLayout(gridBagLayout1);
        mousePanel.setLayout(gridBagLayout2);


        imageNo_F.setText(String.valueOf(imageNo + 1));


        imageNo_S.setValues(imageNo + 1, 0, 1, NUM + 1);


        less_B.setEnabled(false);
        cineNext1_B.setFont(bold);
        cineNext2_B.setFont(plain);
        cinePrev1_B.setFont(plain);
        cinePrev2_B.setFont(plain);
        cineNext1_B.setEnabled(false);
        cineNext2_B.setEnabled(false);
        cinePrev1_B.setEnabled(false);
        cinePrev2_B.setEnabled(false);

        panel1.setLayout(new BorderLayout());
        this.add(scrollPane1, BorderLayout.CENTER);
        this.add(panel1, BorderLayout.WEST);
        this.add(copyrightPanel, BorderLayout.SOUTH);


        copyright_L.setAppletContext(this.getAppletContext());
        copyrightPanel.setLayout(new FlowLayout(FlowLayout.RIGHT, 5, 0));
        copyrightPanel.add(copyright_L);


        buttonPanel.setLayout(new GridLayout(2, 1));
        buttonPanel.add(studyInfo_C);
        buttonPanel.add(tag_B);
        panel1.add(buttonPanel, BorderLayout.SOUTH);


        panel1.add(infoPanel, BorderLayout.CENTER);


        gridBagConstraints2.fill = GridBagConstraints.BOTH;

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


        panel1.add(controlPanel, BorderLayout.NORTH);
        gridBagConstraints1.fill = GridBagConstraints.BOTH;

        gridBagConstraints1.gridx = 0;
        gridBagConstraints1.gridy = 0;
        gridBagConstraints1.gridwidth = 4;
        gridBagConstraints1.gridheight = 9;
        gridBagConstraints1.insets = new Insets(3, 3, 0, 3);
        gridBagLayout1.setConstraints(borderPanel1, gridBagConstraints1);
        controlPanel.add(borderPanel1);
        gridBagConstraints1.insets = new Insets(0, 0, 0, 0);
        gridBagConstraints1.gridheight = 1;

        int line = 9;
        add2controlPanel(0, line, 4, reset_B);
        line++;
        add2controlPanel(0, line, 2, rotateL_B);
        add2controlPanel(2, line, 2, rotateR_B);
        line++;
        add2controlPanel(0, line, 2, flipLR_B);
        add2controlPanel(2, line, 2, flipUD_B);
        line++;
        gridBagConstraints1.insets = new Insets(5, 0, 0, 0);
        add2controlPanel(0, line, 4, cine_B);
        line++;
        gridBagConstraints1.insets = new Insets(0, 0, 0, 0);
        add2controlPanel(0, line, 1, cinePrev2_B);
        add2controlPanel(1, line, 1, cinePrev1_B);
        add2controlPanel(2, line, 1, cineNext1_B);
        add2controlPanel(3, line, 1, cineNext2_B);
        line++;
        gridBagConstraints1.insets = new Insets(5, 0, 0, 0);
        add2controlPanel(0, line, 2, label2);
        add2controlPanel(2, line, 2, imageNo_F);
        line++;
        gridBagConstraints1.insets = new Insets(0, 0, 0, 0);
        add2controlPanel(0, line, 4, imageNo_S);
        line++;
        add2controlPanel(0, line, 2, less_B);
        add2controlPanel(2, line, 2, more_B);
        line++;


        scrollPane1.setBackground(Color.black);

        tagInfoFrame = new TagInfoFrame();
        tagInfoFrame.setSize(500, 400);
        tagInfoFrame.setResizable(true);

        imageNo_F.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                imageNo_S.setValue((int) getFieldValue(imageNo_F));
                imageNo_old = imageNo;
                imageNo = imageNo_S.getValue() - 1;
                changeImageNo();
            }
        });
        imageNo_F.addKeyListener(myKeyListener);
        imageNo_S.addAdjustmentListener(new AdjustmentListener() {

            public void adjustmentValueChanged(AdjustmentEvent e) {
                imageNo_F.setText(String.valueOf(imageNo_S.getValue()));
                imageNo_old = imageNo;
                imageNo = imageNo_S.getValue() - 1;
                changeImageNo();
            }
        });
        imageNo_S.addKeyListener(myKeyListener);

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
        fit_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                getCanvasSize();
            }
        });
        fit_B.addKeyListener(myKeyListener);

        default_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                defaultWwWl();
            }
        });
        default_B.addKeyListener(myKeyListener);

        more_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                moreFrame();
            }
        });
        more_B.addKeyListener(myKeyListener);

        less_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                lessFrame();
            }
        });
        less_B.addKeyListener(myKeyListener);
        cine_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                cineMode();
            }
        });
        cine_B.addKeyListener(myKeyListener);

        cineNext1_B.addActionListener(new ActionListener() {

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

        cinePrev1_B.addActionListener(new ActionListener() {

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

        cineNext2_B.addActionListener(new ActionListener() {

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

        cinePrev2_B.addActionListener(new ActionListener() {

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

        inv_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                inv_flag = true;
                showTile();
                inv_flag = false;
            }
        });
        inv_B.addKeyListener(myKeyListener);

        rotateL_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                rotateL_flag = true;
                showTile();
                rotateL_flag = false;
            }
        });
        rotateL_B.addKeyListener(myKeyListener);
        rotateR_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                rotateR_flag = true;
                showTile();
                rotateR_flag = false;
            }
        });
        rotateR_B.addKeyListener(myKeyListener);

        flipLR_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                flipLR_flag = true;
                showTile();
                flipLR_flag = false;
            }
        });
        flipLR_B.addKeyListener(myKeyListener);

        flipUD_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                flipUD_flag = true;
                showTile();
                flipUD_flag = false;
            }
        });
        flipUD_B.addKeyListener(myKeyListener);

        reset_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                reset_flag = true;
                showTile();
                reset_flag = false;
            }
        });
        reset_B.addKeyListener(myKeyListener);

        tag_B.addActionListener(new ActionListener() {

            public void actionPerformed(ActionEvent e) {
                if (!tagInfoFrame.isShowing()) {
                    tag_B.setLabel(_resbundle.getString("HIDE_TAG_INFO"));
                    tagInfoFrame.setImageNo(imageNo);
                    tagInfoFrame.setVisible(true);
                } else {
                    tag_B.setLabel(_resbundle.getString("SHOW_TAG_INFO"));
                    tagInfoFrame.setVisible(false);
                }
            }
        });
        tag_B.addKeyListener(myKeyListener);

        tagInfoFrame.addWindowListener(new WindowListener() {

            public void windowClosing(WindowEvent e) {
                tag_B.setLabel(_resbundle.getString("SHOW_TAG_INFO"));

                tagInfoFrame.setVisible(false);
            }

            public void windowOpened(WindowEvent e) {
            }

            public void windowClosed(WindowEvent e) {
            }

            public void windowIconified(WindowEvent e) {
            }

            public void windowDeiconified(WindowEvent e) {
            }

            public void windowActivated(WindowEvent e) {
            }

            public void windowDeactivated(WindowEvent e) {
            }
        });

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

    private void add2controlPanel(int grid_x, int grid_y, int grid_width, Component addComp) {

        gridBagConstraints1.gridx = grid_x;
        gridBagConstraints1.gridy = grid_y;


        gridBagConstraints1.gridwidth = grid_width;


        gridBagLayout1.setConstraints(addComp, gridBagConstraints1);
        controlPanel.add(addComp);
    }

    private void add2mousePanel(int grid_x, int grid_y, int grid_width, Component addComp) {

        gridBagConstraints2.gridx = grid_x;
        gridBagConstraints2.gridy = grid_y;


        gridBagConstraints2.gridwidth = grid_width;


        gridBagLayout2.setConstraints(addComp, gridBagConstraints2);
        mousePanel.add(addComp);
    }

    public void start() {

        if (isThreadStarted) {
            //System.out.println("isTreadStarted -> Done");
            return;
        }
        //System.out.println("Viewer.start()");

        dicomData = new DicomData();
        imageData = new ImageData();
        if (NUM > TMPSIZE) {

            arrayIndex = new int[TMPSIZE];
            dicomData_tmp = new DicomData[TMPSIZE];
            imageData_tmp = new ImageData[TMPSIZE];
            tagInfoFrame.setTagInfoFrame(TMPSIZE);
        } else {

            arrayIndex = new int[NUM];
            dicomData_tmp = new DicomData[NUM];
            imageData_tmp = new ImageData[NUM];
            tagInfoFrame.setTagInfoFrame(NUM);
        }

        index = new int[NUM];
        ww = new int[NUM];
        wl = new int[NUM];
        for (int i = 0; i < NUM; i++) {
            index[i] = -1;
        }
        for (int i = 0; i < arrayIndex.length; i++) {
            arrayIndex[i] = -1;
        }
        for (int i = 0; i < NUM; i++) {
            ww[i] = 0;
        }
        for (int i = 0; i < NUM; i++) {
            wl[i] = 0;
        }


        this.showStatus(_resbundle.getString("NOW_LOADING_DICOM_DICTIONARY"));
        DicomDic dicomDic = new DicomDic(dicURL);


        dicomFile = new DicomFile(isLtlEndian, vrType, privacy, dicomDic);


        dicomDic = null;

        int len = dicomData_tmp.length;

        if (imageNo - (len >> 1) <= 0) {
            start = 0;
        } else {
            start = imageNo - (len >> 1);
        }
        if (start + len > NUM) {
            start = NUM - len;
        }

        loader = new LoaderThread(start, len, 0, this);
        start_old = start;
        loader.start();


        takeData(imageNo);


        this.width = imageData.getWidth();
        this.height = imageData.getHeight();
        imageTiledCanvas = new ImageTiledCanvas(width, height, this);


        imageTiledCanvas.addKeyListener(myKeyListener);


        showTile();


        scrollPane1.add(imageTiledCanvas, null);


        if (imageData.color()) {
            setRGBEnabled(false);
        }
        if (NUM == 1) {
            wwwlALL_C.setEnabled(false);
            cine_B.setEnabled(false);
            more_B.setEnabled(false);

            checkboxGroup1.setSelectedCheckbox(wwwlSingle_C);
            synchro_flag = false;
        }

        isThreadStarted = true;
    }

    public void stop() {
        if (loader != null) {

            if (loader.isAlive()) {
                changeStopRequest(true);
            }

            while (requestStop) {
                try {
                    this.wait(200);

                    if (!loader.isAlive()) {
                        changeStopRequest(false);
                    }
                } catch (InterruptedException e) {
                }
            }
            loader = null;
        }
        if (animationThread != null) {
            animationThread.requestStop();
            animationThread = null;
        }
    }

    public void destroy() {
        stop();
    }

    public synchronized void postData(int indexNo, int start, int end) {
        int len = dicomData_tmp.length;
        int arrayNo = 0;
        int remove_index = 0;
        DicomData tmpdicomData = new DicomData();
        ImageData tmpimageData = new ImageData();


        showStatus(_resbundle.getString("NOW_LOADING_DICOM_FILE") + "(" + (indexNo + 1) + ")");
        tmpdicomData = dicomFile.load(imgURL[indexNo]);

        showStatus(_resbundle.getString("NOW_CREATING_DICOM_IMAGE") + "(" + (indexNo + 1) + ")");
        tmpimageData.setData(tmpdicomData);


        for (int i = 0; i < arrayIndex.length; i++) {
            if ((start > arrayIndex[i]) || (end <= arrayIndex[i])) {
                remove_index = arrayIndex[i];
                arrayNo = i;
            }
        }

        if (remove_index > -1) {
            index[remove_index] = -1;
        }
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

    public synchronized void takeData(int i) {
        while (index[i] < 0) {
            try {
                this.wait();
            } catch (InterruptedException e) {
            }
        }
        int j = index[i];
        dicomData = null;
        imageData = null;
        dicomData = dicomData_tmp[j];
        imageData = imageData_tmp[j];
        infoPanel.setDicomData(dicomData);
        this.notifyAll();
    }

    public synchronized ImageData takeImageData(int i) {
        while (index[i] < 0) {
            try {
                this.wait();
            } catch (InterruptedException e) {
            }
        }
        int j = index[i];
        this.notifyAll();
        return imageData_tmp[j];
    }

    public synchronized boolean confirmStopRequest() {
        return requestStop;
    }

    public synchronized void changeStopRequest(boolean flag) {
        requestStop = flag;
        this.notifyAll();
    }

    public synchronized void startLoaderThread(int start, int len, int oldstart) {

        if (loader.isAlive()) {
            changeStopRequest(true);
        }

        while (requestStop) {
            try {
                this.wait(200);

                if (!loader.isAlive()) {
                    changeStopRequest(false);
                }
            } catch (InterruptedException e) {
            }
        }
        loader = null;

        loader = new LoaderThread(start, len, oldstart, this);
        loader.start();
        this.notifyAll();
    }

    private double getFieldValue(TextField textF) {
        double tmp;
        try {

            tmp = Double.valueOf(textF.getText()).doubleValue();
        } catch (java.lang.NumberFormatException e) {

            tmp = 0.0;
        }
        return tmp;
    }

    public void drag_changeZoom(int draggedZoom) {

        zoom -= 0.005 * (double) draggedZoom;

        if (zoom < 0.25) {
            zoom = 0.25;
        } else if (zoom > 2.0) {
            zoom = 2.0;
        }

        imageTiledCanvas.changeZoom(zoom);
    }

    private void changeCanvasSize() {
        double tmpZoom;


        tmpZoom = 100.0 / canvasSize;

        if (tmpZoom > 2.0) {
            zoom = 2.0;
        } else if (tmpZoom < 0.25) {
            zoom = 0.25;
        } else {
            zoom = tmpZoom;
        }


        imageTiledCanvas.changeCanvasSize(canvasSize * 0.01);
        imageTiledCanvas.changeZoom(zoom);
    }

    private void getCanvasSize() {
        int w_size, h_size, tmpSize;
        Dimension paneSize;
        paneSize = scrollPane1.getSize();


        w_size = (int) ((double) paneSize.width / (double) (width * column) * 100d);
        h_size = (int) ((double) paneSize.height / (double) (height * row) * 100d);

        if (h_size < w_size) {
            tmpSize = h_size;
        } else {
            tmpSize = w_size;
        }
        if (tmpSize > 100) {
            tmpSize = 100;
        }
        canvasSize = tmpSize;


        changeCanvasSize();
    }

    public void drag_changeWwWl(int draggedWW, int draggedWL) {
        int tmp_ww, tmp_wl;

        tmp_ww = imageData.getWW() + draggedWW;

        if (tmp_ww < 0) {
            tmp_ww = 0;
        } else if (tmp_ww > imageData.getPixelMax() - imageData.getPixelMin()) {
            tmp_ww = imageData.getPixelMax() - imageData.getPixelMin();
        }


        tmp_wl = imageData.getWL() + draggedWL;

        if (tmp_wl < imageData.getPixelMin()) {
            tmp_wl = imageData.getPixelMin();
        } else if (tmp_wl > imageData.getPixelMax()) {
            tmp_wl = imageData.getPixelMax();
        }


        imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, imageNo - tile_start);
        imageTiledCanvas.changeImage(imageData.wwANDwl(tmp_ww, tmp_wl), imageNo - tile_start);
    }

    public void dragDone_changeWwWl(int draggedWW, int draggedAllWW, int draggedWL, int draggedAllWL) {
        int tmp_ww, tmp_wl;


        if (!synchro_flag) {
            tmp_ww = imageData.getWW() + draggedWW;

            if (tmp_ww < 0) {
                tmp_ww = 0;
            } else if (tmp_ww > imageData.getPixelMax() - imageData.getPixelMin()) {
                tmp_ww = imageData.getPixelMax() - imageData.getPixelMin();
            }


            tmp_wl = imageData.getWL() + draggedWL;

            if (tmp_wl < imageData.getPixelMin()) {
                tmp_wl = imageData.getPixelMin();
            } else if (tmp_wl > imageData.getPixelMax()) {
                tmp_wl = imageData.getPixelMax();
            }


            imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, imageNo - tile_start);
            imageTiledCanvas.changeImage(imageData.wwANDwl(tmp_ww, tmp_wl), imageNo - tile_start);


            ww[imageNo] += draggedAllWW;
            wl[imageNo] += draggedAllWL;


        } else {
            int max;
            int tmpNo = 0;
            ImageData tmpImageData;
            max = row * column;

            for (int i = tile_start; i < tile_start + max; i++) {
                if (tmpNo >= dicomData_tmp.length) {
                    break;
                }


                tmpImageData = takeImageData(i);


                if (i == imageNo) {

                    tmp_ww = tmpImageData.getWW() + draggedWW;

                    if (tmp_ww < 0) {
                        tmp_ww = 0;
                    } else if (tmp_ww > tmpImageData.getPixelMax() - tmpImageData.getPixelMin()) {
                        tmp_ww = tmpImageData.getPixelMax() - tmpImageData.getPixelMin();
                    }


                    tmp_wl = tmpImageData.getWL() + draggedWL;

                    if (tmp_wl < tmpImageData.getPixelMin()) {
                        tmp_wl = tmpImageData.getPixelMin();
                    } else if (tmp_wl > tmpImageData.getPixelMax()) {
                        tmp_wl = tmpImageData.getPixelMax();
                    }


                } else {

                    tmp_ww = tmpImageData.getWW() + draggedAllWW;

                    if (tmp_ww < 0) {
                        tmp_ww = 0;
                    } else if (tmp_ww > tmpImageData.getPixelMax() - tmpImageData.getPixelMin()) {
                        tmp_ww = tmpImageData.getPixelMax() - tmpImageData.getPixelMin();
                    }


                    tmp_wl = tmpImageData.getWL() + draggedAllWL;

                    if (tmp_wl < tmpImageData.getPixelMin()) {
                        tmp_wl = tmpImageData.getPixelMin();
                    } else if (tmp_wl > tmpImageData.getPixelMax()) {
                        tmp_wl = tmpImageData.getPixelMax();
                    }
                }


                imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, tmpNo);
                imageTiledCanvas.setImage(tmpImageData.wwANDwl(tmp_ww, tmp_wl), tmpNo);
                tmpNo++;
            }
            for (int i = tmpNo; i < max; i++) {
                imageTiledCanvas.setImage(null, i);
            }

            for (int i = 0; i < NUM; i++) {
                ww[i] += draggedAllWW;
            }
            for (int i = 0; i < NUM; i++) {
                wl[i] += draggedAllWL;
            }
        }
    }

    private void defaultWwWl() {
        int tmp_ww, tmp_wl;

        if (!synchro_flag) {
            tmp_ww = imageData.getDefaultWW();
            tmp_wl = imageData.getDefaultWL();


            imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, imageNo - tile_start);
            imageTiledCanvas.changeImage(imageData.wwANDwl(tmp_ww, tmp_wl), imageNo - tile_start);


            ww[imageNo] = 0;
            wl[imageNo] = 0;

        } else {
            int max;
            int tmpNo = 0;
            ImageData tmpImageData;
            max = row * column;


            for (int i = tile_start; i < tile_start + max; i++) {
                if (tmpNo >= dicomData_tmp.length) {
                    break;
                }

                tmpImageData = takeImageData(i);
                tmp_ww = tmpImageData.getDefaultWW();
                tmp_wl = tmpImageData.getDefaultWL();

                imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, tmpNo);
                imageTiledCanvas.setImage(tmpImageData.wwANDwl(tmp_ww, tmp_wl), tmpNo);
                tmpNo++;
            }
            for (int i = tmpNo; i < max; i++) {
                imageTiledCanvas.setImage(null, i);
            }

            for (int i = 0; i < NUM; i++) {
                ww[i] = 0;
            }
            for (int i = 0; i < NUM; i++) {
                wl[i] = 0;
            }
        }
    }

    private void cineMode() {

        if (animationThread == null) {
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


        } else {
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

    public void changeImageNo() {

        int len = dicomData_tmp.length;

        if (imageNo - (len >> 1) <= 0) {
            start = 0;
        } else {
            start = imageNo - (len >> 1);
        }
        if (start + len > NUM) {
            start = NUM - len;
        }

        startLoaderThread(start, len, start_old);
        //loader = new LoaderThread(start, len, start_old, this);
        start_old = start;
        //loader.start();

        showTile();
        //scrollPane1.doLayout();
        //scrollPane1.validate();
    }

    private void moreFrame() {
        double height_space, width_space;
        double tmpSize = canvasSize * 0.01;
        Dimension paneSize = scrollPane1.getSize();

        if (!less_B.isEnabled()) {
            less_B.setEnabled(true);
        }


        height_space = (double) paneSize.height - (double) (height * tmpSize * row);
        width_space = (double) paneSize.width - (double) (width * tmpSize * column);
        if (height_space > width_space) {
            row = row + 1;
        } else {
            column = column + 1;
        }
        if (row > 9) {
            row = 9;
        }
        if (column > 9) {
            column = 9;
        }
        getCanvasSize();

        if (row * column >= arrayIndex.length) {
            more_B.setEnabled(false);
        }
        showTile();

        scrollPane1.setVisible(false);
        scrollPane1.setBackground(Color.black);
        scrollPane1.setVisible(true);
    }

    private void lessFrame() {
        double height_space, width_space;
        double tmpSize = canvasSize * 0.01;
        Dimension paneSize = scrollPane1.getSize();

        if (!more_B.isEnabled()) {
            more_B.setEnabled(true);
        }


        height_space = (double) paneSize.height - (double) (height * tmpSize * row);
        width_space = (double) paneSize.width - (double) (width * tmpSize * column);
        if (height_space < width_space) {
            if (row == 1) {
                column = column - 1;
            } else {
                row = row - 1;
            }
        } else {
            if (column == 1) {
                row = row - 1;
            } else {
                column = column - 1;
            }
        }
        if (row < 1) {
            row = 1;
        }
        if (column < 1) {
            column = 1;
        }
        getCanvasSize();

        if (row * column == 1) {
            less_B.setEnabled(false);
        }
        showTile();

        scrollPane1.setVisible(false);
        scrollPane1.setBackground(Color.black);
        scrollPane1.setVisible(true);
    }

    public void changeActive(int i) {

        int j = index[i];
        if (j == -1) {
            return;
        }
        dicomData = null;
        imageData = null;
        dicomData = dicomData_tmp[j];
        imageData = imageData_tmp[j];
        infoPanel.setDicomData(dicomData);


        imageNo = i;
        imageNo_F.setText(String.valueOf(i + 1));
        imageNo_S.setValue(i + 1);
        if (imageData.color()) {
            setRGBEnabled(false);
        } else {
            setRGBEnabled(true);
        }
    }

    private void showTile() {
        int max = row * column;
        int len = dicomData_tmp.length;
        imageTiledCanvas.setTileType(row, column);
        int tmpNo = 0;


        if (imageNo - (max >> 1) <= 0) {
            tile_start = 0;
        } else {
            tile_start = imageNo - (max >> 1);
        }
        if (tile_start + max > start + len) {
            tile_start = start + len - max;
        }
        if (tile_start < start) {
            tile_start = start;
        }
        imageTiledCanvas.setStartNo(tile_start);

        ImageData tmpImageData;

        for (int i = tile_start; i < tile_start + max; i++) {
            if (tmpNo >= len) {
                break;
            }


            tmpImageData = takeImageData(i);


            if (inv_flag) {
                tmpImageData.inverse();
            }
            // if(color_flag) tmpImageData.changeColor();
            if (rotateL_flag) {
                tmpImageData.rotateL();
            }
            if (rotateR_flag) {
                tmpImageData.rotateR();
            }
            if (flipLR_flag) {
                tmpImageData.flipLR();
            }
            if (flipUD_flag) {
                tmpImageData.flipUD();
            }
            if (reset_flag) {
                tmpImageData.setDefaultPixel();
            }


            if (i == imageNo) {
                imageTiledCanvas.setActiveNo(tmpNo);
            }


            imageTiledCanvas.setImage(tmpImageData.getImageWWWL2Current(ww[i], wl[i]), tmpNo);

            imageTiledCanvas.setWW_WL(tmpImageData.getWW(), tmpImageData.getWL(), tmpNo);
            imageTiledCanvas.setStudyInfo(dicomData_tmp[index[i]], tmpNo);
            tmpNo++;
        }
        for (int i = tmpNo; i < max; i++) {
            imageTiledCanvas.setImage(null, i);
            imageTiledCanvas.setStudyInfo(null, tmpNo);
        }


        takeData(imageNo);


        if (imageData.color()) {
            setRGBEnabled(false);
        } else {
            setRGBEnabled(true);
        }
    }

    private void setRGBEnabled(boolean flag) {
        default_B.setEnabled(flag);
        // color_B.setEnabled(flag);
        inv_B.setEnabled(flag);
        wwwlSingle_C.setEnabled(flag);
        if (NUM == 1) {
            wwwlALL_C.setEnabled(false);
        } else {
            wwwlALL_C.setEnabled(flag);
        }
        if (!flag && (wwwlSingle_C.getState() || wwwlALL_C.getState())) {
            move_C.setState(true);
            imageTiledCanvas.setMoveState(true);
        }
    }

    public boolean isFocusTraversable() {
        return true;
    }

    public String getAppletInfo() {
        return "Applet Information";
    }

    // static initializer for setting look & feel
    static {
        try {
            //UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
            //UIManager.setLookAndFeel(UIManager.getCrossPlatformLookAndFeelClassName());
        } catch (Exception e) {
        }
    }

    class MyCheckBoxListener implements ItemListener {

        public void itemStateChanged(ItemEvent e) {


            if (wwwlSingle_C.getState()) {
                synchro_flag = false;
            } else if (wwwlALL_C.getState()) {
                synchro_flag = true;
            }


            imageTiledCanvas.setMoveState(move_C.getState());
            imageTiledCanvas.setZoomState(zoom_C.getState());
            imageTiledCanvas.setLoupeState(loupe_C.getState());
        }
    }

    private void changeSelectCheckBox(Checkbox checkbox) {


        checkboxGroup1.setSelectedCheckbox(checkbox);


        if (checkbox == wwwlSingle_C) {
            synchro_flag = false;
        } else if (checkbox == wwwlALL_C) {
            synchro_flag = true;
        }


        imageTiledCanvas.setMoveState(move_C.getState());
        imageTiledCanvas.setZoomState(zoom_C.getState());
        imageTiledCanvas.setLoupeState(loupe_C.getState());
    }

    private void key_changeZoom(double value) {
        double tmpZoom;


        tmpZoom = 100.0 / canvasSize;
        // 0.25 <= zoom <= 2.0
        if (tmpZoom > 2.0) {
            tmpZoom = 2.0;
        } else if (tmpZoom < 0.25) {
            tmpZoom = 0.25;
        }


        zoom = tmpZoom * value;

        if (zoom < 0.25) {
            zoom = 0.25;
        } else if (zoom > 2.0) {
            zoom = 2.0;
        }


        imageTiledCanvas.changeZoom(zoom);
    }

    private void key_changeWwWl(double key_ww, double key_wl) {
        int tmp_ww, tmp_wl, tmp_wwwl;


        if (!synchro_flag) {
            // PixelMax - PixelMin
            tmp_wwwl = imageData.getPixelMax() - imageData.getPixelMin();

            tmp_ww = imageData.getDefaultWW() + ww[imageNo] + (int) (tmp_wwwl * key_ww);


            if (tmp_ww < 0) {
                tmp_ww = 0;
            } else if (tmp_ww > tmp_wwwl) {
                tmp_ww = tmp_wwwl;
            }


            tmp_wl = imageData.getDefaultWL() + wl[imageNo] + (int) (tmp_ww * key_wl);

            if (tmp_wl < imageData.getPixelMin()) {
                tmp_wl = imageData.getPixelMin();
            } else if (tmp_wl > imageData.getPixelMax()) {
                tmp_wl = imageData.getPixelMax();
            }


            imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, imageNo - tile_start);
            imageTiledCanvas.changeImage(imageData.wwANDwl(tmp_ww, tmp_wl), imageNo - tile_start);


        } else {
            int max;
            int tmpNo = 0;
            ImageData tmpImageData;
            max = row * column;

            for (int i = tile_start; i < tile_start + max; i++) {
                if (tmpNo >= dicomData_tmp.length) {
                    break;
                }


                tmpImageData = takeImageData(i);


                tmp_wwwl = tmpImageData.getPixelMax() - tmpImageData.getPixelMin();


                tmp_ww = tmpImageData.getDefaultWW() + ww[i] + (int) (tmp_wwwl * key_ww);

                if (tmp_ww < 0) {
                    tmp_ww = 0;
                } else if (tmp_ww > tmp_wwwl) {
                    tmp_ww = tmp_wwwl;
                }


                tmp_wl = tmpImageData.getDefaultWL() + wl[i] + (int) (tmp_ww * key_wl);

                if (tmp_wl < tmpImageData.getPixelMin()) {
                    tmp_wl = tmpImageData.getPixelMin();
                } else if (tmp_wl > tmpImageData.getPixelMax()) {
                    tmp_wl = tmpImageData.getPixelMax();
                }


                imageTiledCanvas.setWW_WL(tmp_ww, tmp_wl, tmpNo);
                imageTiledCanvas.setImage(tmpImageData.wwANDwl(tmp_ww, tmp_wl), tmpNo);
                tmpNo++;
            }
            for (int i = tmpNo; i < max; i++) {
                imageTiledCanvas.setImage(null, i);
            }
        }
    }

    class MyKeyListener implements KeyListener {

        boolean isWW = false;

        public void keyTyped(KeyEvent e) {
            // char keyChar = e.getKeyChar();
            // System.out.println(keyChar);
        }

        public void keyPressed(KeyEvent e) {
            int keyCode = e.getKeyCode();


            if (e.isControlDown()) {
                // Ctrl+W
                if (keyCode == KeyEvent.VK_W) {
                    // WL
                    isWW = false;
                    if (e.isShiftDown()) {
                        // + Shift
                        // WL/WW Single
                        changeSelectCheckBox(wwwlSingle_C);
                    } else {
                        // WL/WW ALL
                        changeSelectCheckBox(wwwlALL_C);
                    }
                    // Ctrl+Q
                } else if (keyCode == KeyEvent.VK_Q) {
                    // WW
                    isWW = true;
                    if (e.isShiftDown()) {
                        // + Shift
                        // WL/WW Single
                        changeSelectCheckBox(wwwlSingle_C);
                    } else {
                        // WL/WW ALL
                        changeSelectCheckBox(wwwlALL_C);
                    }
                    // Ctrl+O
                } else if (keyCode == KeyEvent.VK_O) {
                    // Move mode
                    changeSelectCheckBox(move_C);
                    // Ctrl+Z
                } else if (keyCode == KeyEvent.VK_Z) {
                    // Zooming mode
                    changeSelectCheckBox(zoom_C);
                    // Ctrl+U
                } else if (keyCode == KeyEvent.VK_U) {
                    // Loupe mode
                    changeSelectCheckBox(loupe_C);
                    // Ctrl+D
                } else if (keyCode == KeyEvent.VK_D) {
                    // Default WL/WW
                    defaultWwWl();
                    // Ctrl+I
                } else if (keyCode == KeyEvent.VK_I) {
                    if (e.isShiftDown()) {
                        // + Shift

                        studyInfo_C.setState(!studyInfo_C.getState());
                        imageTiledCanvas.setStudyInfo_flag(studyInfo_C.getState());
                    } else {
                        if (notCine) {

                            inv_flag = true;
                            showTile();
                            inv_flag = false;
                        } else {

                            cineNext1_B.setFont(plain);
                            cineNext2_B.setFont(plain);
                            cinePrev1_B.setFont(bold);
                            cinePrev2_B.setFont(plain);
                            animationThread.changeInterval(1000);
                            animationThread.changeNext(false);
                        }
                    }
                    // Ctrl+T
                } else if (keyCode == KeyEvent.VK_T) {
                    if (e.isShiftDown()) {
                        // + Shift

                        if (!tagInfoFrame.isShowing()) {
                            tag_B.setLabel("Hide  Tag Info");
                            tagInfoFrame.setImageNo(imageNo);
                            tagInfoFrame.setVisible(true);
                        } else {
                            tag_B.setLabel("Show  Tag Info");
                            tagInfoFrame.setVisible(false);
                        }
                    } else {
                        if (notCine) {
                            // Rest Zoom/Move
                            getCanvasSize();
                        } else {

                            cineNext1_B.setFont(bold);
                            cineNext2_B.setFont(plain);
                            cinePrev1_B.setFont(plain);
                            cinePrev2_B.setFont(plain);
                            animationThread.changeInterval(1000);
                            animationThread.changeNext(true);
                        }
                    }
                    // Ctrl+R
                } else if (keyCode == KeyEvent.VK_R) {
                    if (e.isShiftDown()) {
                        // + Shift
                        // RotateR
                        rotateR_flag = true;
                        showTile();
                        rotateR_flag = false;
                    } else {
                        if (notCine) {
                            // RotateL
                            rotateL_flag = true;
                            showTile();
                            rotateL_flag = false;
                        } else {

                            cineNext1_B.setFont(plain);
                            cineNext2_B.setFont(plain);
                            cinePrev1_B.setFont(plain);
                            cinePrev2_B.setFont(bold);
                            animationThread.changeInterval(300);
                            animationThread.changeNext(false);
                        }
                    }
                    // Ctrl+F
                } else if (keyCode == KeyEvent.VK_F) {
                    if (e.isShiftDown()) {
                        // + Shift
                        // FlipLR
                        flipLR_flag = true;
                        showTile();
                        flipLR_flag = false;
                    } else {
                        if (notCine) {
                            // FlipUD
                            flipUD_flag = true;
                            showTile();
                            flipUD_flag = false;
                        } else {

                            cineNext1_B.setFont(plain);
                            cineNext2_B.setFont(bold);
                            cinePrev1_B.setFont(plain);
                            cinePrev2_B.setFont(plain);
                            animationThread.changeInterval(300);
                            animationThread.changeNext(true);
                        }
                    }
                    // Ctrl+C
                } else if (keyCode == KeyEvent.VK_C) {
                    if (e.isShiftDown()) {
                        // + Shift
                        // Cine start/stop
                        cineMode();
                    } else {
                        if (notCine) {
                            // Rest Angle
                            reset_flag = true;
                            showTile();
                            reset_flag = false;
                        } else {
                            // Cine stop
                            cineMode();
                        }
                    }
                    // Ctrl+M
                } else if (keyCode == KeyEvent.VK_M) {

                    if (more_B.isEnabled()) {
                        moreFrame();
                    }
                    // Ctrl+L
                } else if (keyCode == KeyEvent.VK_L) {

                    if (less_B.isEnabled()) {
                        lessFrame();
                    }
                    // Ctrl+1
                } else if (keyCode == KeyEvent.VK_1) {
                    if (zoom_C.getState()) {

                        if (e.isShiftDown()) {
                            key_changeZoom(1.0);
                        } else {
                            key_changeZoom(1.0);
                        }
                    } else {
                        if (!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {

                            changeSelectCheckBox(wwwlALL_C);
                        }
                        if (isWW) {
                            // WW
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, 0);
                            } else {
                                key_changeWwWl(0, 0);
                            }
                        } else {
                            // WL
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, 0);
                            } else {
                                key_changeWwWl(0, 0);
                            }
                        }
                    }
                    // Ctrl+2
                } else if (keyCode == KeyEvent.VK_2) {
                    if (zoom_C.getState()) {

                        if (e.isShiftDown()) {
                            key_changeZoom(0.9);
                        } else {
                            key_changeZoom(1.2);
                        }
                    } else {
                        if (!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {

                            changeSelectCheckBox(wwwlALL_C);
                        }
                        if (isWW) {
                            // WW
                            if (e.isShiftDown()) {
                                key_changeWwWl(-0.01, 0);
                            } else {
                                key_changeWwWl(0.01, 0);
                            }
                        } else {
                            // WL
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, -0.01);
                            } else {
                                key_changeWwWl(0, 0.01);
                            }
                        }
                    }
                    // Ctrl+3
                } else if (keyCode == KeyEvent.VK_3) {
                    if (zoom_C.getState()) {

                        if (e.isShiftDown()) {
                            key_changeZoom(0.8);
                        } else {
                            key_changeZoom(1.4);
                        }
                    } else {
                        if (!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {

                            changeSelectCheckBox(wwwlALL_C);
                        }
                        if (isWW) {
                            // WW
                            if (e.isShiftDown()) {
                                key_changeWwWl(-0.02, 0);
                            } else {
                                key_changeWwWl(0.02, 0);
                            }
                        } else {
                            // WL
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, -0.02);
                            } else {
                                key_changeWwWl(0, 0.02);
                            }
                        }
                    }
                    // Ctrl+4
                } else if (keyCode == KeyEvent.VK_4) {
                    if (zoom_C.getState()) {

                        if (e.isShiftDown()) {
                            key_changeZoom(0.7);
                        } else {
                            key_changeZoom(1.6);
                        }
                    } else {
                        if (!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {

                            changeSelectCheckBox(wwwlALL_C);
                        }
                        if (isWW) {
                            // WW
                            if (e.isShiftDown()) {
                                key_changeWwWl(-0.03, 0);
                            } else {
                                key_changeWwWl(0.03, 0);
                            }
                        } else {
                            // WL
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, -0.03);
                            } else {
                                key_changeWwWl(0, 0.03);
                            }
                        }
                    }
                    // Ctrl+5
                } else if (keyCode == KeyEvent.VK_5) {
                    if (zoom_C.getState()) {

                        if (e.isShiftDown()) {
                            key_changeZoom(0.6);
                        } else {
                            key_changeZoom(1.8);
                        }
                    } else {
                        if (!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {

                            changeSelectCheckBox(wwwlALL_C);
                        }
                        if (isWW) {
                            // WW
                            if (e.isShiftDown()) {
                                key_changeWwWl(-0.05, 0);
                            } else {
                                key_changeWwWl(0.05, 0);
                            }
                        } else {
                            // WL
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, -0.05);
                            } else {
                                key_changeWwWl(0, 0.05);
                            }
                        }
                    }
                    // Ctrl+6
                } else if (keyCode == KeyEvent.VK_6) {
                    if (zoom_C.getState()) {

                        if (e.isShiftDown()) {
                            key_changeZoom(0.5);
                        } else {
                            key_changeZoom(2.0);
                        }
                    } else {
                        if (!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {

                            changeSelectCheckBox(wwwlALL_C);
                        }
                        if (isWW) {
                            // WW
                            if (e.isShiftDown()) {
                                key_changeWwWl(-0.1, 0);
                            } else {
                                key_changeWwWl(0.1, 0);
                            }
                        } else {
                            // WL
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, -0.1);
                            } else {
                                key_changeWwWl(0, 0.1);
                            }
                        }
                    }
                    // Ctrl+7
                } else if (keyCode == KeyEvent.VK_7) {
                    if (zoom_C.getState()) {

                        if (e.isShiftDown()) {
                            key_changeZoom(0.4);
                        } else {
                            key_changeZoom(2.2);
                        }
                    } else {
                        if (!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {

                            changeSelectCheckBox(wwwlALL_C);
                        }
                        if (isWW) {
                            // WW
                            if (e.isShiftDown()) {
                                key_changeWwWl(-0.2, 0);
                            } else {
                                key_changeWwWl(0.2, 0);
                            }
                        } else {
                            // WL
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, -0.2);
                            } else {
                                key_changeWwWl(0, 0.2);
                            }
                        }
                    }
                    // Ctrl+8
                } else if (keyCode == KeyEvent.VK_8) {
                    if (zoom_C.getState()) {
                        // zoom�̂Ƃ�
                        if (e.isShiftDown()) {
                            key_changeZoom(0.3);
                        } else {
                            key_changeZoom(2.4);
                        }
                    } else {
                        if (!wwwlSingle_C.getState() && !wwwlALL_C.getState()) {

                            changeSelectCheckBox(wwwlALL_C);
                        }
                        if (isWW) {
                            // WW
                            if (e.isShiftDown()) {
                                key_changeWwWl(-0.4, 0);
                            } else {
                                key_changeWwWl(0.4, 0);
                            }
                        } else {
                            // WL
                            if (e.isShiftDown()) {
                                key_changeWwWl(0, -0.4);
                            } else {
                                key_changeWwWl(0, 0.4);
                            }
                        }
                    }
                    // Ctrl+9
                } else if (keyCode == KeyEvent.VK_9) {

                    if (imageNo > 0) {
                        imageNo_old = imageNo;
                        imageNo -= 1;
                        imageNo_S.setValue(imageNo + 1);
                        imageNo_F.setText(String.valueOf(imageNo + 1));
                        changeImageNo();
                    }
                    // Ctrl+0
                } else if (keyCode == KeyEvent.VK_0) {

                    if (imageNo < (NUM - 1)) {
                        imageNo_old = imageNo;
                        imageNo += 1;
                        imageNo_S.setValue(imageNo + 1);
                        imageNo_F.setText(String.valueOf(imageNo + 1));
                        changeImageNo();
                    }
                }
            }
        }

        public void keyReleased(KeyEvent e) {
            int keyCode = e.getKeyCode();
        }
    }
}
