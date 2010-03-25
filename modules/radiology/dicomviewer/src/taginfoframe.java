/*
 * TagInfoFrame.java - DICOMタグ情報を表示するためのフレーム
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
import java.awt.event.*;
import java.util.*;

public class TagInfoFrame extends Frame {

  DicomData[] dicomData;    // DicomDataを保持

  Vector      vector8;      // (0008,????)のタグの情報が格納される
  Vector      vector10;     // (0010,????)のタグの情報が格納される
  Vector      vector18;     // (0018,????)のタグの情報が格納される
  Vector      vector20;     // (0020,????)のタグの情報が格納される
  Vector      vector28;     // (0028,????)のタグの情報が格納される
  Vector      vectorOther;  // 上記以外のタグの情報はここに格納

  List tag_list = new java.awt.List(5, false);  // タググループを選択するリスト
  hGrid table = new hGrid();                    // 検査情報が格納されるテーブル
  Panel panel1 = new Panel();
  Label label1 = new Label();
  Choice imgNo_choice = new Choice();           // 画像番号を選択する

  // コンストラクタ
  public TagInfoFrame() {
    // フレーム名をセットする
    super("DICOM Tag Browser");
    try  {
      jbInit();
    }
    catch(Exception e) {
      e.printStackTrace();
    }
  }

  // 保持する画像データの枚数を決定する（表示する前に必ず呼ばなければならない）
  public void setTagInfoFrame(int length) {
    dicomData = new DicomData[length];
    for(int i=0; i<length; i++) {
      imgNo_choice.add("0");
    }
  }

  // arrayNo番目に画像番号をimageNoとして、dicomDataをセットする
  public void setDicomData(DicomData argData, int arrayNo, int imageNo) {
    dicomData[arrayNo] = argData;
    imgNo_choice.remove(arrayNo);
    imgNo_choice.insert(Integer.toString(imageNo +1), arrayNo);
  }


  // コンポーネントの初期化
  private void jbInit() throws Exception {

    // コンポーネントの貼り付け
    // テーブルの列名を定義する
    String[] head = new String[4];
    head[0] = "Tag";
    head[1] = "VR";
    head[2] = "Name";
    head[3] = "Value";
    table.setHead(head);

    // タググループを選択するリストの初期化
    tag_list.add("0008 - Identifying");
    tag_list.add("0010 - Patient");
    tag_list.add("0018 - Acquisition");
    tag_list.add("0020 - Relationship");
    tag_list.add("0028 - ImagePresentation");
    tag_list.add("otherz");
    // デフォルトでは、(0008,????)が選択されるようにする
    tag_list.select(0);

    label1.setText("ImageNo");
    // テーブルをCENTERに配置することで、フレームの大きさが変化した場合テーブルの大きさが変化する
    this.add(table, BorderLayout.CENTER);
    this.add(panel1, BorderLayout.NORTH);
    panel1.add(label1, null);
    panel1.add(imgNo_choice, null);
    panel1.add(tag_list, null);

    // イベント関係
    tag_list.addItemListener(new ItemListener () {
      public void itemStateChanged(ItemEvent e) {
        // 選択されたタググループにより表示を変える
        switch(tag_list.getSelectedIndex()) {
          case  0:  showTagInfo(vector8);
                    break;
          case  1:  showTagInfo(vector10);
                    break;
          case  2:  showTagInfo(vector18);
                    break;
          case  3:  showTagInfo(vector20);
                    break;
          case  4:  showTagInfo(vector28);
                    break;
          case  5:  showTagInfo(vectorOther);
                    break;
          default:  showTagInfo(vector8);
                    break;
        }
      }
    });
    imgNo_choice.addItemListener(new ItemListener () {
      public void itemStateChanged(ItemEvent e) {
        // 画像番号が変化した場合、データをセットし、
        setVector();
        // 選択されているタググループに合わせて表示する
        switch(tag_list.getSelectedIndex()) {
          case  0:  showTagInfo(vector8);
                    break;
          case  1:  showTagInfo(vector10);
                    break;
          case  2:  showTagInfo(vector18);
                    break;
          case  3:  showTagInfo(vector20);
                    break;
          case  4:  showTagInfo(vector28);
                    break;
          case  5:  showTagInfo(vectorOther);
                    break;
          default:  showTagInfo(vector8);
                    break;
        }
      }
    });
  }

  // 画像番号の選択を変化させる
  public void setImageNo(int imgNo) {
    imgNo_choice.select(Integer.toString(imgNo +1));
    setVector();
    // デフォルトで表示するのは、(0008,????)のタグ
    tag_list.select(0);
    showTagInfo(vector8);
  }

  // 検査情報をセットする
  private void setVector() {
    int           index;

    index       = imgNo_choice.getSelectedIndex();
    vector8     = new Vector();
    vector10    = new Vector();
    vector18    = new Vector();
    vector20    = new Vector();
    vector28    = new Vector();
    vectorOther = new Vector();

    // すべてのタグについて調べる
    for(Enumeration e = dicomData[index].keys(); e.hasMoreElements(); ){
      String    tag     = e.nextElement().toString();
      String[]  string  = new String[4];

      // 文字列を作成する。
      string[0] = tag;
      string[1] = dicomData[index].getVR(tag);
      StringBuffer sBuffer = new StringBuffer(dicomData[index].getName(tag));
      sBuffer.setLength(30);
      string[2] = sBuffer.toString().replace('\u0000', ' ') ;
      string[3] = dicomData[index].getAnalyzedValue(tag);

      // 作成した文字列をそれぞれのVectorにaddする。
      if(tag.substring(1,5).equals("0008")) {
        vector8.addElement(string);
      } else if(tag.substring(1,5).equals("0010")) {
        vector10.addElement(string);
      } else if(tag.substring(1,5).equals("0018")) {
        vector18.addElement(string);
      } else if(tag.substring(1,5).equals("0020")) {
        vector20.addElement(string);
      } else if(tag.substring(1,5).equals("0028")) {
        vector28.addElement(string);
      } else {
        vectorOther.addElement(string);
      }
    }
  }

  // タググループを表に表示する
  private void showTagInfo(Vector vector) {
    // すでに存在する表のデータを破棄する
    table.removeRows();
    // 表の行を追加していく
    for(int i = 0; i < vector.size(); i++) {
      table.addRow((String[])vector.elementAt(i));
    }
    // タグの列(列番号0)でソートする
    table.sort(0);
  }

}
