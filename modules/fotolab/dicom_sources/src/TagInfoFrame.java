/*
 * TagInfoFrame.java - 
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
import java.util.*;

public class TagInfoFrame extends Frame {

    DicomData[] dicomData;
    Vector vector8;
    Vector vector10;
    Vector vector18;
    Vector vector20;
    Vector vector28;
    Vector vectorOther;
    java.awt.List tag_list = new java.awt.List(5, false);
    hGrid table = new hGrid();
    Panel panel1 = new Panel();
    Label label1 = new Label();
    Choice imgNo_choice = new Choice();

    public TagInfoFrame() {

        super("DICOM Tag Browser");
        try {
            jbInit();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void setTagInfoFrame(int length) {
        dicomData = new DicomData[length];
        for (int i = 0; i < length; i++) {
            imgNo_choice.add("0");
        }
    }

    public void setDicomData(DicomData argData, int arrayNo, int imageNo) {
        dicomData[arrayNo] = argData;
        imgNo_choice.remove(arrayNo);
        imgNo_choice.insert(Integer.toString(imageNo + 1), arrayNo);
    }

    private void jbInit() throws Exception {

        String[] head = new String[4];
        head[0] = "Tag";
        head[1] = "VR";
        head[2] = "Name";
        head[3] = "Value";
        table.setHead(head);


        tag_list.add("0008 - Identifying");
        tag_list.add("0010 - Patient");
        tag_list.add("0018 - Acquisition");
        tag_list.add("0020 - Relationship");
        tag_list.add("0028 - ImagePresentation");
        tag_list.add("otherz");

        tag_list.select(0);

        label1.setText("ImageNo");

        this.add(table, BorderLayout.CENTER);
        this.add(panel1, BorderLayout.NORTH);
        panel1.add(label1, null);
        panel1.add(imgNo_choice, null);
        panel1.add(tag_list, null);


        tag_list.addItemListener(new ItemListener() {

            public void itemStateChanged(ItemEvent e) {

                switch (tag_list.getSelectedIndex()) {
                    case 0:
                        showTagInfo(vector8);
                        break;
                    case 1:
                        showTagInfo(vector10);
                        break;
                    case 2:
                        showTagInfo(vector18);
                        break;
                    case 3:
                        showTagInfo(vector20);
                        break;
                    case 4:
                        showTagInfo(vector28);
                        break;
                    case 5:
                        showTagInfo(vectorOther);
                        break;
                    default:
                        showTagInfo(vector8);
                        break;
                }
            }
        });
        imgNo_choice.addItemListener(new ItemListener() {

            public void itemStateChanged(ItemEvent e) {
                setVector();
                switch (tag_list.getSelectedIndex()) {
                    case 0:
                        showTagInfo(vector8);
                        break;
                    case 1:
                        showTagInfo(vector10);
                        break;
                    case 2:
                        showTagInfo(vector18);
                        break;
                    case 3:
                        showTagInfo(vector20);
                        break;
                    case 4:
                        showTagInfo(vector28);
                        break;
                    case 5:
                        showTagInfo(vectorOther);
                        break;
                    default:
                        showTagInfo(vector8);
                        break;
                }
            }
        });
    }

    public void setImageNo(int imgNo) {
        imgNo_choice.select(Integer.toString(imgNo + 1));
        setVector();
        tag_list.select(0);
        showTagInfo(vector8);
    }

    private void setVector() {
        int index;

        index = imgNo_choice.getSelectedIndex();
        vector8 = new Vector();
        vector10 = new Vector();
        vector18 = new Vector();
        vector20 = new Vector();
        vector28 = new Vector();
        vectorOther = new Vector();

        for (Enumeration e = dicomData[index].keys(); e.hasMoreElements();) {
            String tag = e.nextElement().toString();
            String[] string = new String[4];

            string[0] = tag;
            string[1] = dicomData[index].getVR(tag);
            StringBuffer sBuffer = new StringBuffer(dicomData[index].getName(tag));
            sBuffer.setLength(30);
            string[2] = sBuffer.toString().replace('\u0000', ' ');
            string[3] = dicomData[index].getAnalyzedValue(tag);


            if (tag.substring(1, 5).equals("0008")) {
                vector8.addElement(string);
            } else if (tag.substring(1, 5).equals("0010")) {
                vector10.addElement(string);
            } else if (tag.substring(1, 5).equals("0018")) {
                vector18.addElement(string);
            } else if (tag.substring(1, 5).equals("0020")) {
                vector20.addElement(string);
            } else if (tag.substring(1, 5).equals("0028")) {
                vector28.addElement(string);
            } else {
                vectorOther.addElement(string);
            }
        }
    }

    private void showTagInfo(Vector vector) {

        table.removeRows();
        for (int i = 0; i < vector.size(); i++) {
            table.addRow((String[]) vector.elementAt(i));
        }

        table.sort(0);
    }
}
