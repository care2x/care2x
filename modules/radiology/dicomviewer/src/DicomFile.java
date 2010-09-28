/*
 * DicomFile.java - 
 *
 * Copyright(C) 2000, Nagoya Institute of Technology, Iwata laboratory and Takahiro Katoji
 * http://mars.elcom.nitech.ac.jp/dicom/
 *
 * @author	Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 * @version
 *
 */
package src;

import java.io.*;
import java.text.*;
import java.net.*;
import java.util.*;

public class DicomFile {

    int debug_level = 3;
    boolean isLtlEndian;
    boolean vrType;
    boolean patientPrivacy;
    boolean VReqSQ = false;
    boolean containDic;
    DicomDic dicomDic;
    DicomData dicomData;

    public DicomFile(boolean argIsLtlEndian, boolean argVRType, boolean privacy, DicomDic argDicomDic) {
        patientPrivacy = privacy;
        isLtlEndian = argIsLtlEndian;
        vrType = argVRType;
        dicomDic = argDicomDic;
    }

    public DicomFile(boolean argIsLtlEndian, boolean argVRType, DicomDic argDicomDic) {
        this(argIsLtlEndian, argVRType, false, argDicomDic);
    }

    public DicomFile(DicomDic argDicomDic) {
        this(true, false, false, argDicomDic);
    }

    public DicomData load(String imgURL) {

        dicomData = new DicomData();

        try {

            URL urlConn = new URL(imgURL);
            BufferedInputStream inS = new BufferedInputStream(urlConn.openStream());
            DataInputStream din = new DataInputStream(inS);

            int tempInt;
            byte[] buff2 = new byte[2];
            byte[] buff4 = new byte[4];

            String group;
            String number;
            String tag;
            String vr;
            int length;
            byte[] value;

            while (din.read(buff2) != -1) {
                tempInt = readInt2(buff2);
                group = Integer.toString((tempInt & 0x0000f000) >> 12, 16);
                group += Integer.toString((tempInt & 0x00000f00) >> 8, 16);
                group += Integer.toString((tempInt & 0x000000f0) >> 4, 16);
                group += Integer.toString((tempInt & 0x0000000f), 16);
                din.readFully(buff2);
                tempInt = readInt2(buff2);
                number = Integer.toString((tempInt & 0x0000f000) >> 12, 16);
                number += Integer.toString((tempInt & 0x00000f00) >> 8, 16);
                number += Integer.toString((tempInt & 0x000000f0) >> 4, 16);
                number += Integer.toString((tempInt & 0x0000000f), 16);
                tag = ("(" + group + "," + number + ")");

                if (debug_level > 3) {
                    System.out.println("currentTag is : " + tag);
                }
                dicomData.setTag(tag);

                containDic = dicomDic.isContain(tag);

                if (vrType && !VReqSQ) {

                    StringBuffer sbuff = new StringBuffer(2);
                    din.readFully(buff2);
                    for (int i = 0; i < 2; i++) {
                        sbuff.append((char) buff2[i]);
                    }
                    dicomData.setVR(tag, sbuff.toString());

                    if (sbuff.toString().equals("OB")
                            || sbuff.toString().equals("OW")
                            || sbuff.toString().equals("SQ")) {
                        din.skip(2);
                        din.readFully(buff4);
                        length = readInt4(buff4);
                    } else {
                        din.readFully(buff2);
                        length = readInt2(buff2);
                    }
                } else {

                    if (containDic) {
                        dicomData.setVR(tag, dicomDic.getVR(tag));
                    } else {
                        dicomData.setVR(tag, "na");
                    }
                    din.readFully(buff4);
                    length = readInt4(buff4);
                }

                if (tag.equals("(fffe,e0dd)")) {
                    VReqSQ = false;
                }

                vr = dicomData.getVR(tag);

                if (debug_level > 3) {
                    System.out.println("currentVR is : " + vr);
                }
                if (debug_level > 3) {
                    System.out.println("currentLength: " + length);
                }

                if (length == -1) {
                    VReqSQ = true;
                    length = 0;
                }

                value = new byte[length];
                din.readFully(value);
                dicomData.setValue(tag, value);

                if (containDic) {
                    dicomData.setName(tag, dicomDic.getName(tag));
                    dicomData.setVM(tag, dicomDic.getVM(tag));
                    dicomData.setVersion(tag, dicomDic.getVersion(tag));
                } else {
                    dicomData.setName(tag, "NotContainedInDICOMDictionary");
                    dicomData.setVM(tag, "na");
                    dicomData.setVersion(tag, "na");
                }

                if (debug_level > 3) {
                    System.out.println("currentName is : " + dicomData.getName(tag));
                }

                this.analyzer(tag, vr);
            }

            din.close();
            inS.close();
        } catch (EOFException eof) {
            System.out.println("DicomFile.EOFException: " + eof.getMessage());
        } catch (IOException ioe) {
            System.out.println("DicomFile.IOException: " + ioe.getMessage());
        } catch (Exception e) {
            System.out.println("DicomFile.Exception: " + e.getMessage());
        }

        if (patientPrivacy) {
            String patientName;

            patientName = dicomData.getAnalyzedValue("(0010,0010)");
            StringBuffer patientBuf = new StringBuffer(patientName);

            for (int i = 0; i < patientName.length(); i++) {
                if (i % 2 == 1) {
                    patientBuf.setCharAt(i, '*');
                }
            }

            dicomData.setAnalyzedValue("(0010,0010)", patientBuf.toString());
        }

        return dicomData;
    }

    private int readInt2(byte[] argtmp) {
        int tmp;
        if (isLtlEndian) {
            tmp = ((0x000000ff & argtmp[1]) << 8 | (0x000000ff & argtmp[0]));
        } else {
            tmp = ((0x000000ff & argtmp[0]) << 8 | (0x000000ff & argtmp[1]));
        }
        return tmp;
    }

    private int readInt4(byte[] argtmp) {
        int tmp;
        if (isLtlEndian) {
            tmp = ((0x000000ff & argtmp[3]) << 24 | (0x000000ff & argtmp[2]) << 16
                    | (0x000000ff & argtmp[1]) << 8 | (0x000000ff & argtmp[0]));
        } else {
            tmp = ((0x000000ff & argtmp[0]) << 24 | (0x000000ff & argtmp[1]) << 16
                    | (0x000000ff & argtmp[2]) << 8 | (0x000000ff & argtmp[3]));
        }
        return tmp;
    }

    private void analyzer(String currentTag, String currentVR) {

        if (currentVR == null) {
            dicomData.setAnalyzedValue(currentTag, "Not contain VR.");
        } else if (dicomData.getValueLength(currentTag) == 0) {
            dicomData.setAnalyzedValue(currentTag, "");
        } else if (currentVR.equals("PN") | currentVR.equals("LO")
                | currentVR.equals("SH") | currentVR.equals("LT")
                | currentVR.equals("ST") | currentVR.equals("UI")
                | currentVR.equals("DS") | currentVR.equals("CS")
                | currentVR.equals("IS") | currentVR.equals("AS")) {
            for (int j = 0; j < dicomData.getValueLength(currentTag); j++) {
                if ((dicomData.getValue(currentTag))[j] == 0) {
                    (dicomData.getValue(currentTag))[j] = 20;
                }
            }
            dicomData.setAnalyzedValue(currentTag, new String(dicomData.getValue(currentTag)));

        } else if (currentVR.equals("SS")) {
            int tmp;
            if (isLtlEndian) {
                tmp = (((int) (dicomData.getValue(currentTag))[1] & 0x000000ff) << 8)
                        | ((int) (dicomData.getValue(currentTag))[0] & 0x000000ff);
            } else {
                tmp = (((int) (dicomData.getValue(currentTag))[0] & 0x000000ff) << 8)
                        | ((int) (dicomData.getValue(currentTag))[1] & 0x000000ff);
            }
            if ((tmp & 0x00008000) == 0x00008000) {
                tmp |= 0xffff0000;
            }
            dicomData.setAnalyzedValue(currentTag, Integer.toString(tmp));

        } else if (currentVR.equals("US")) {
            int tmp;
            if (isLtlEndian) {
                tmp = (((int) (dicomData.getValue(currentTag))[1] & 0x000000ff) << 8)
                        | ((int) (dicomData.getValue(currentTag))[0] & 0x000000ff);
            } else {
                tmp = (((int) (dicomData.getValue(currentTag))[0] & 0x000000ff) << 8)
                        | ((int) (dicomData.getValue(currentTag))[1] & 0x000000ff);
            }
            dicomData.setAnalyzedValue(currentTag, Integer.toString(tmp));
        } else if (currentVR.equals("UL")) {
            int tmp;
            if (isLtlEndian) {
                tmp = (((int) (dicomData.getValue(currentTag))[3] & 0x000000ff) << 24)
                        | (((int) (dicomData.getValue(currentTag))[2] & 0x000000ff) << 16)
                        | (((int) (dicomData.getValue(currentTag))[1] & 0x000000ff) << 8)
                        | ((int) (dicomData.getValue(currentTag))[0] & 0x000000ff);
            } else {
                tmp = (((int) (dicomData.getValue(currentTag))[0] & 0x000000ff) << 24)
                        | (((int) (dicomData.getValue(currentTag))[1] & 0x000000ff) << 16)
                        | (((int) (dicomData.getValue(currentTag))[2] & 0x000000ff) << 8)
                        | ((int) (dicomData.getValue(currentTag))[3] & 0x000000ff);
            }
            dicomData.setAnalyzedValue(currentTag, Integer.toString(tmp));

        } else if (currentVR.equals("TM")) {
            dicomData.setAnalyzedValue(currentTag, new String(dicomData.getValue(currentTag)));
            StringBuffer buffer = new StringBuffer(dicomData.getAnalyzedValue(currentTag));
            buffer.insert(2, ":");
            buffer.insert(5, ":");
            dicomData.setAnalyzedValue(currentTag, buffer.toString());
        } else if (currentVR.equals("DA")) {
            dicomData.setAnalyzedValue(currentTag, new String(dicomData.getValue(currentTag)));

            if (dicomData.getValueLength(currentTag) == 8) {
                StringBuffer buffer = new StringBuffer(dicomData.getAnalyzedValue(currentTag));
                buffer.insert(4, "-");
                buffer.insert(7, "-");
                dicomData.setAnalyzedValue(currentTag, buffer.toString());
            } else if (dicomData.getValueLength(currentTag) == 10) {
                StringTokenizer st = new StringTokenizer(dicomData.getAnalyzedValue(currentTag), ".");
                String temp = st.nextToken();
                temp += "-" + st.nextToken();
                temp += "-" + st.nextToken();
                dicomData.setAnalyzedValue(currentTag, temp);
            }
        } else {
            dicomData.setAnalyzedValue(currentTag, "Unknown VR");
        }
        if (debug_level > 3) {
            System.out.println("AnalyzedValue :" + dicomData.getAnalyzedValue(currentTag));
        }
    }
}
