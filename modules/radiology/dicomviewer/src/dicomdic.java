/*
 * DicomDic.java - Dicom辞書(Dicom.dicファイル)を読み込んでタグで検索できるようにする
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 * @param   dicURL Dicom辞書が存在するURL
 *
 */

package dicomviewer;

import java.io.*;
import java.util.*;
import java.net.*;

public class DicomDic {

  int             debug_level = 3;

  Hashtable				table = new Hashtable();  // 辞書データを格納

  // コンストラクタ
  public DicomDic(String dicURL) {
    // デバッグ用
    if (debug_level > 3) System.out.println("Now Loading DicomDic from " + dicURL +"...");
    InputStream     inS;
    BufferedReader	din;
    StringTokenizer tkn;
    try{
      // デバッグ用
      if (debug_level > 3) System.out.println("Now Making Resive Stream....");
      if(dicURL.equals("none")) {
        // Jarファイルの中にあるDicom辞書を参照する
        inS = this.getClass().getResourceAsStream("Dicom.dic");
      }else {
        // URLソケットを作り、URLから辞書を取ってくる
        URL urlConn = new URL(dicURL);
        inS = urlConn.openStream();
      }

      // 受信ストリームの設定
      din = new BufferedReader(new InputStreamReader(inS));
      String line_str;
      int j=0;

      // ファイルを1行ずつ、最後まで読む
      while((line_str = din.readLine())!=null){

        // 行の先頭が#の場合はコメントとして読み飛ばす
        if(line_str.startsWith("#")!=true){
          j++;
				  //Hashtableに、キーをタグ(String)、値をDicomvalueオブジェクトとして入れる
				  String tag = null;
				  Dicomvalue dicomvalue = new Dicomvalue();
          tkn = new StringTokenizer(line_str);
          tag = tkn.nextToken();
          // デバッグ用
          if (debug_level > 5) System.out.println("Tag  : " + tag);
          dicomvalue.vr = tkn.nextToken();
          // デバッグ用
          if (debug_level > 5) System.out.println("VR   : " + dicomvalue.vr);
          dicomvalue.name = tkn.nextToken();
          // デバッグ用
          if (debug_level > 5) System.out.println("Name : " + dicomvalue.name);
          dicomvalue.vm = tkn.nextToken();
          // デバッグ用
          if (debug_level > 5) System.out.println("VM   : " + dicomvalue.vm);
          dicomvalue.version =tkn.nextToken();
          // デバッグ用
          if (debug_level > 5) System.out.println("Ver. : " + dicomvalue.version);
				  table.put(tag, dicomvalue);
        }
      }
      din.close();
    }
    catch(EOFException eof){
      System.out.println("EOFException: " + eof.getMessage() );
    }
    catch(IOException ioe){
      System.out.println("IOException: " + ioe.getMessage() );
    }
    catch(Exception e){
    	System.out.println("Exception: " + e.getMessage() );
    }
  }

  // 以下オブジェクトの値を返す
  public String getName(String tag) {
    return ((Dicomvalue)table.get(tag)).name;
  }

  public String getVR(String tag) {
    return ((Dicomvalue)table.get(tag)).vr;
  }

  public String getVM(String tag) {
    return ((Dicomvalue)table.get(tag)).vm;
  }

  public String getVersion(String tag) {
    return ((Dicomvalue)table.get(tag)).version;
  }

  // データにタグが含まれるか調べる
  public boolean isContain(String tag) {
    return table.containsKey(tag);
  }

  // ハッシュテーブルの値となるオブジェクト
  class Dicomvalue {
    String name;		//タグに対する名前
    String vr;			//VR
    String vm;			//VM
    String version;	//DicomVersion
  }
}


