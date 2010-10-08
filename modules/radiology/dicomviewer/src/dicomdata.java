/*
 * DicomData.java - タグなどのDicom情報を保持する
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */

package dicomviewer;

import java.util.*;
import java.io.Serializable;

public class DicomData implements Serializable {
  // キーをタグ,値をDicomvalueというオブジェクトのハッシュテーブル
  Hashtable table = new Hashtable();

  // ハッシュテーブルにタグというキーで空のオブジェクトを追加
  public void setTag(String tag) {
    table.put(tag, new Dicomvalue());
  }

  // 以下オブジェクトの値をセット
  public void setValue(String tag, byte[] argValue) {
    ((Dicomvalue)table.get(tag)).value = new byte[argValue.length];
    System.arraycopy(argValue, 0, ((Dicomvalue)table.get(tag)).value, 0, argValue.length);
    ((Dicomvalue)table.get(tag)).valueLength = argValue.length;
  }

  public void setName(String tag, String argName) {
    ((Dicomvalue)table.get(tag)).name = argName;
  }

  public void setVR(String tag, String argVR) {
    ((Dicomvalue)table.get(tag)).vr = argVR;
  }

  public void setVM(String tag, String argVM) {
    ((Dicomvalue)table.get(tag)).vm = argVM;
  }

  public void setVersion(String tag, String argVersion) {
    ((Dicomvalue)table.get(tag)).version = argVersion;
  }

  public void setAnalyzedValue(String tag, String argAnalyzed) {
    ((Dicomvalue)table.get(tag)).analyzedValue = argAnalyzed;
  }

  // 以下オブジェクトの値を返す
  public byte[] getValue(String tag) {
    return ((Dicomvalue)table.get(tag)).value;
  }

  public int getValueLength(String tag) {
    return ((Dicomvalue)table.get(tag)).valueLength;
  }

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

  public String getAnalyzedValue(String tag) {
    return ((Dicomvalue)table.get(tag)).analyzedValue;
  }

  // 全てのタグを返す
  public Enumeration keys() {
    return table.keys();
  }

  // データの中身を捨てる
  public void removeAll() {
    table.clear();
  }

  // データにタグが含まれるか調べる
  public boolean isContain(String tag) {
    return table.containsKey(tag);
  }

  // ハッシュテーブルの値となるオブジェクト
  class Dicomvalue {
    String	name;						// タグに対する名前
    String	vr;							// VR
    String 	vm;							// VM
    String 	version;				// DicomVersion
    byte[]	value;					// 読み込んだままの値
    int			valueLength;		// 値長さ
    String	analyzedValue;	// 値を表示できる形にしたもの
  }
}

