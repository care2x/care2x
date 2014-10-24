/*
 * hGrid.java
 *
 * 98-11-19 TM created
 * Copyright (c) 1995-2000 by the Hypersonic SQL Group. All rights reserved. 
 *
 * @see http://hsql.oron.ch/Grid/index.html
 *
 * Modified by Takahiro Katoji(mailto:katoco@mars.elcom.nitech.ac.jp)
 */

package dicomviewer;

import java.awt.*;
import java.util.Vector;

public class hGrid extends Panel {
  // drawing
  Dimension dMinimum;
  Font fFont;
  FontMetrics fMetrics;
  Graphics gImage;
  Image iImage;
  // height / width
  int iWidth,iHeight;
  int iRowHeadWidth=0,iRowHeight,iFirstRow;
  int iGridWidth,iGridHeight;
  int iX,iY;
  // data
  String sColHead[];
  Vector vData,vRowHead;
  int iColWidth[];
  int iColCount,iRowCount;
  // scrolling
  Scrollbar sbHoriz,sbVert;
  int iSbWidth,iSbHeight;
  boolean bDrag;
  int iXDrag,iColDrag;
  // editing
  TextField tEdit;
  boolean bEditing;
  int iSelectRow,iSelectColumn;
  Component cCallback;
  int iEditX,iEditY,iEditWidth;
  public hGrid() {
    super();
    fFont=new Font("Dialog",Font.PLAIN,12);
    iSelectRow=-1;
    setLayout(null);
    sbHoriz=new Scrollbar(Scrollbar.HORIZONTAL);
    add(sbHoriz);
    sbVert=new Scrollbar(Scrollbar.VERTICAL);
    add(sbVert);
    tEdit=new TextField();
    add(tEdit);
  }
  public void setMinimumSize(Dimension d) {
    dMinimum=d;
  }
  public void setCallback(Component c) {
    cCallback=c;
  }
  public void setBounds(int x,int y,int w,int h) {
    super.setBounds(x,y,w,h);
    iSbHeight=sbHoriz.getPreferredSize().height;
    iSbWidth=sbVert.getPreferredSize().width;
    iHeight=h-iSbHeight;
    iWidth=w-iSbWidth;
    sbHoriz.setBounds(0,iHeight,iWidth,iSbHeight);
    sbVert.setBounds(iWidth,0,iSbWidth,iHeight);
    adjustScroll();
    iImage=null;
    showText();
    repaint();
  }
  public void setHead(String head[]) {
    vData=new Vector();
    vRowHead=new Vector();
    iColCount=head.length;
    sColHead=new String[iColCount];
    iColWidth=new int[iColCount];
    for(int i=0;i<iColCount;i++) {
      sColHead[i]=head[i];
      iColWidth[i]=100;
    }
    iRowCount=0;
  }
  public void addRow(String head,String data[]) {
    vRowHead.addElement(head);
    if(data.length!=iColCount) return;
    String row[]=new String[iColCount];
    for(int i=0;i<iColCount;i++) {
      row[i]=data[i];
    }    
    vData.addElement(row);
    iRowCount++;
    adjustScroll();
    repaint();
  }
  public void addRow(String data[]) {
    //addRow("r"+iRowCount,data);
    addRow("",data);
  }
  public void removeRows() {
    if(!vData.isEmpty()) {
      vData.removeAllElements();
      iRowCount=0;
      adjustScroll();
      repaint();
    }
  }
  private void adjustScroll() {
    if(iRowHeight==0) return;
    int w=0;
    for(int i=0;i<iColCount;i++) {
      w+=iColWidth[i];
    }
    iGridWidth=w;
    iGridHeight=iRowHeight*(iRowCount+1);
    sbHoriz.setValues(iX,iWidth,0,iGridWidth+iRowHeadWidth);
    int v=iY/iRowHeight,h=iHeight/iRowHeight;
    sbVert.setValues(v,h,0,iRowCount+1);
    iX=sbHoriz.getValue();
    iY=iRowHeight*sbVert.getValue();
  }
  public boolean handleEvent(Event e) {
    switch (e.id) {
    case Event.SCROLL_LINE_UP:
    case Event.SCROLL_LINE_DOWN:
    case Event.SCROLL_PAGE_UP:
    case Event.SCROLL_PAGE_DOWN:
    case Event.SCROLL_ABSOLUTE:
      iX=sbHoriz.getValue();
      iY=iRowHeight*sbVert.getValue();
      repaint();
      return true;
    } 
    return super.handleEvent(e);
  }
  public void paint(Graphics g) {
    if(g==null) return;
    if(iWidth<=0 || iHeight<=0) return;
    g.setColor(Color.lightGray);
    g.fillRect(iWidth,iHeight,iSbWidth,iSbHeight);
    if(iImage==null) {
      iImage=createImage(iWidth,iHeight);
      gImage=iImage.getGraphics();
      if(fMetrics==null) {
        fMetrics=gImage.getFontMetrics();
      }
    }
    gImage.setFont(fFont);
    if(iRowHeight==0) {
      iRowHeight=fMetrics.getHeight()+2;
      for(int i=0;i<iColCount;i++) {
        calcAutoWidth(i);
      }
      adjustScroll();
    }
    gImage.setColor(Color.white);
    gImage.fillRect(0,0,iWidth,iHeight);
    gImage.setColor(Color.darkGray);
    gImage.drawLine(0,iRowHeight,iWidth,iRowHeight);
    int x=-iX+iRowHeadWidth;
    for(int i=0;i<iColCount;i++) {
      int w=iColWidth[i];
      gImage.setColor(Color.lightGray);
      gImage.fillRect(x+1,0,w-2,iRowHeight);
      gImage.setColor(Color.black);
      gImage.drawString(sColHead[i],x+2,iRowHeight-5);
      gImage.setColor(Color.darkGray);
      gImage.drawLine(x+w-1,0,x+w-1,iRowHeight-1);
      gImage.setColor(Color.white);
      gImage.drawLine(x+w,0,x+w,iRowHeight-1);
      x+=w;
    }
    gImage.setColor(Color.lightGray);
    gImage.fillRect(0,0,iRowHeadWidth+1,iRowHeight);
    gImage.fillRect(x+1,0,iWidth-x,iRowHeight);
    gImage.drawLine(0,0,0,iRowHeight-1);
    int y=iRowHeight+1-iY;
    int j=0;
    while(y<iRowHeight+1) {
      j++;
      y+=iRowHeight;
    }
    iFirstRow=j;
    y=iRowHeight+1;
    for(;y<iHeight && j<iRowCount;j++,y+=iRowHeight) {
      x=-iX+iRowHeadWidth;
      for(int i=0;i<iColCount;i++) {
        int w=iColWidth[i];
        Color b=Color.white,t=Color.black;
        if(iSelectRow==j) {
          b=Color.black;
          t=Color.white;
        }
        gImage.setColor(b);
        gImage.fillRect(x,y,w-1,iRowHeight-1);
        gImage.setColor(t);
        gImage.drawString(getDisplay(i,j),x+2,y+iRowHeight-5);
        gImage.setColor(Color.lightGray);
        gImage.drawLine(x+w-1,y,x+w-1,y+iRowHeight-1);
        gImage.drawLine(x,y+iRowHeight-1,
        x+w-1,y+iRowHeight-1);
        x+=w;
      }
      gImage.setColor(Color.white);
      gImage.fillRect(x,y,iWidth-x,iRowHeight-1);
      if(iRowHeadWidth!=0) {
        gImage.setColor(Color.lightGray);
        gImage.fillRect(0,y,iRowHeadWidth,iRowHeight-1);
        gImage.setColor(Color.black);
        String s=(String)vRowHead.elementAt(j);
        gImage.drawString(s,2,y+iRowHeight-5);
        gImage.setColor(Color.darkGray);
        gImage.drawLine(0,y+iRowHeight-1,iRowHeadWidth-1,y+iRowHeight-1);
        gImage.drawLine(iRowHeadWidth-1,y,iRowHeadWidth-1,y+iRowHeight-1);
        gImage.setColor(Color.white);
        gImage.drawLine(0,y,iRowHeadWidth-2,y);
      }
    }
    g.drawImage(iImage,0,0,this);
    showText();
  }
  public void update(Graphics g) {
    paint(g);
  }
  public boolean keyDown(Event evt,int key) {
    int r=iSelectRow,c=iSelectColumn;
    if(r<0 || r>=iRowCount) return false;
    switch(key) {
    case 9: // Tab
      if((evt.modifiers & Event.SHIFT_MASK)!=0) c--;
      else c++;
      if(c<0) c=0; if(c>=iColCount) c=iColCount-1;
      select(r,c);
      return true;
    case 1004: // Up
      if(r>0) {
        select(r-1,c);
      }
      return true;
    case 1005: // Down
    case 10: // Enter
      if(r<iRowCount-1) {
        select(r+1,c);
      }
      return true;
    case 27: // ESC
      iSelectRow=-1;
      select(r,c);
      repaint();
      return true;
    }
    return false;
  }
  public boolean mouseMove(Event e,int x,int y) {
    if(y<=iRowHeight) {
      int xb=x;
      x=x+iX-iGridWidth-iRowHeadWidth;
      int i=iColCount-1;
      for(;i>=0;i--) {
        if(x>-7 && x<7) break;
        x+=iColWidth[i];        
      }
      if(i>=0) {
        if(!bDrag) {
          this.setCursor(new Cursor(Cursor.E_RESIZE_CURSOR));
          bDrag=true;
          iXDrag=xb-iColWidth[i];
          iColDrag=i;
        }
        return true;
      }
    }
    return mouseExit(e,x,y);
  }
  public boolean mouseDrag(Event e,int x,int y) {
    if(bDrag && x<iWidth) {
      int w=x-iXDrag;
      if(w<0) w=0;
      iColWidth[iColDrag]=w;
      adjustScroll();
      repaint();
    }
    return true;
  }
  public boolean mouseExit(Event e,int x,int y) {
    if(bDrag) {
      this.setCursor(new Cursor(Cursor.DEFAULT_CURSOR));
      bDrag=false;
    }
    return true;
  }
  public boolean mouseDown(Event e,int x,int y) {
    if(iRowHeight==0 || x>iWidth || y>iHeight) return true;
    x+=iX-iRowHeadWidth;
    int col=0;
    for(int i=0;i<iColCount;i++) {
      int w=iColWidth[i];
      if(x>=0 && x<=w) {
        col=i;
        break;
      }
      x-=w;
    }
    if(y>iRowHeight) {
      int r=(y/iRowHeight)-1+iFirstRow;
      if(r>=0 && r<iRowCount) {
        select(r,col);
        if(cCallback!=null) {
          Event v=new Event(
          cCallback,Event.ACTION_EVENT,""+iSelectRow);
          cCallback.action(v,""+iSelectRow);
        }
      }
    } else if(!bDrag) {
      sort(col);
    }
    return true;
  }
  public Dimension getPreferredSize() {
    return getMinimumSize();
  }
  public Dimension getgetPreferredSize() {
    return getMinimumSize();
  }
  public Dimension getgetMinimumSize() {
    return getMinimumSize();
  }
  public Dimension getMinimumSize() {
    return dMinimum;
  }
  private void calcAutoWidth(int i) {
    int w=10;
    iRowHeadWidth=0;
    w=Math.max(w,fMetrics.stringWidth(sColHead[i]));
    for(int j=0;j<iRowCount;j++) {
      String s[]=(String[])(vData.elementAt(j));
      w=Math.max(w,fMetrics.stringWidth(s[i]));
      String h=(String)(vRowHead.elementAt(j));
      iRowHeadWidth=Math.max(iRowHeadWidth,
      fMetrics.stringWidth(h)+6);
    }
    iColWidth[i]=w+6;
  }
  public void sort(int c) {
    select(-1,0);
    int n=iRowCount;
    int i=1;
    while(i<n && get(c,i-1).compareTo(get(c,i))<=0) i++;
    if(i==n) return;    
    for(i=(n>>1)-1;i>0;i--) siftup(i,n-1,c);
    for(i=n-1;i>0;i--) {
      siftup(0,i,c);
      String s[]=(String[])vData.elementAt(0);
      vData.setElementAt(vData.elementAt(i),0);
      vData.setElementAt(s,i);
    }
  }
  private void siftup(int i,int n,int c) {
    Object v=vData.elementAt(i);
    String s=get(c,i);
    int l=i,j=i+i+1;
    for(;j<n;i=j,j=(i=j)+j+1) {
      if(get(c,j).compareTo(get(c,j+1))<0) j++;
      vData.setElementAt(vData.elementAt(j),i);
    }
    if(j==n) {
      vData.setElementAt(vData.elementAt(j),i);
      i=j;
    }
    for(j=i-1>>1;j>=l && get(c,j).compareTo(s)<1;j=(i=j)-1>>1) {
      vData.setElementAt(vData.elementAt(j),i);
    }
    vData.setElementAt(v,i);
  }
  private void select(int r,int c) {
    if(iSelectRow>=0 && iSelectRow<iRowCount) {
      set(iSelectColumn,iSelectRow,tEdit.getText());
    }
    iSelectRow=r;
    iSelectColumn=c;
    if(r<0 || r>=iRowCount || c<0 || c>=iColCount) {
      iSelectRow=-1;
      iSelectColumn=0;
    }
    tEdit.setVisible(false);
    bEditing=false;
    if(iSelectRow>=0) {
      while(iSelectRow<iFirstRow && iFirstRow>0) {
        iFirstRow--;
        iY-=iRowHeight;
      }
      while(iSelectRow>(iFirstRow-2+(iHeight/iRowHeight)) 
      && iFirstRow<iRowCount-1) {
        iFirstRow++;
        iY+=iRowHeight;
      }
      calcEditPos();
      if(iEditX>iWidth) {
        iX+=iEditX-iWidth;
        calcEditPos();
      }
      if(iEditX+iEditWidth>iWidth) {
        iX+=iEditX+iEditWidth-iWidth;
        calcEditPos();
      }
      if(iEditX<iRowHeadWidth) {
        iX+=iEditX-iRowHeadWidth;
        calcEditPos();
      }
      tEdit.setText(get(iSelectColumn,iSelectRow));
      adjustScroll();
    }
    repaint();
  }
  private void calcEditPos() {
    int x=-iX;
    for(int i=0;i<iSelectColumn;i++) {
      int w=iColWidth[i];
      x+=w;
    }
    iEditY=(iSelectRow-iFirstRow+1)*iRowHeight;
    int w=0;
    if(iColWidth!=null) w=iColWidth[iSelectColumn];
    iEditX=x+iRowHeadWidth;
    iEditWidth=w;
  }
  private void showText() {
    calcEditPos();
    int x=iEditX,y=iEditY,w=iEditWidth;
    w=Math.min(w,iWidth-x);
    if(x<0) {
      w+=x;
      x=0;
    }
    if(iSelectRow>=0 && w>0 && y>=iRowHeight 
    && y<(iHeight-iRowHeight)) {
      tEdit.setBounds(x,y,w,iRowHeight);
      if(!bEditing) {
        tEdit.setVisible(true);
        tEdit.requestFocus();
        tEdit.selectAll();
        bEditing=true;
      }
    } else {
      if(bEditing) {
        tEdit.setVisible(false);
        bEditing=false;
      }
    }
  }
  private String getDisplay(int x,int y) {
    return (((String[])(vData.elementAt(y)))[x]);
  }
  private String get(int x,int y) {
    return (((String[])(vData.elementAt(y)))[x]);
  }
  private void set(int x,int y,String s) {
    String r[]=(String[])vData.elementAt(y);
    r[x]=s;
  }
}
