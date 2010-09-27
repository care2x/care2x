/**
 * BorderPanel.java
 *
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

public class BorderPanel extends Panel {

    boolean isLabelNull = true;
    Color color;
    Color upLeft, downRight;
    String label;
    Font font;
    FontMetrics fm;

    public BorderPanel() {

        font = new Font("Dialog", Font.PLAIN, 12);
        fm = getFontMetrics(font);

        super.setLayout(new FlowLayout(FlowLayout.LEFT, 5, 5));
    }

    public BorderPanel(String label) {
        isLabelNull = false;

        font = new Font("Dialog", Font.PLAIN, 12);
        fm = getFontMetrics(font);

        this.label = label;

        super.setLayout(new FlowLayout(FlowLayout.CENTER, 5, fm.getHeight()));
    }

    public void setLayout(LayoutManager mgr) {
    }

    public void paint(Graphics g) {

        color = Color.gray;
        upLeft = color.darker();
        downRight = color.brighter();

        int width, height, fmHeightHalf, stringWidth;


        if (isLabelNull) {
            width = (int) this.getSize().width;
            height = (int) this.getSize().height;
            fmHeightHalf = 0;

            g.setColor(upLeft);
            g.drawLine(0, 0, width - 1, 0);
            g.setColor(downRight);
            g.drawLine(1, 1, width - 2, 1);

        } else {

            width = (int) this.getSize().width;
            height = (int) this.getSize().height - fm.getHeight() + 5;
            fmHeightHalf = fm.getAscent() >> 1;
            stringWidth = fm.stringWidth(label);


            g.setFont(font);
            g.setColor(Color.black);
            g.drawString(label, fm.getAscent(), 10);


            g.setColor(upLeft);
            g.drawLine(0, fmHeightHalf, 7, fmHeightHalf);
            g.drawLine(stringWidth + 16, fmHeightHalf, width - 1, fmHeightHalf);
            g.setColor(downRight);
            g.drawLine(1, fmHeightHalf + 1, 7, fmHeightHalf + 1);
            g.drawLine(stringWidth + 16, fmHeightHalf + 1, width - 2, fmHeightHalf + 1);
        }

        g.setColor(upLeft);
        g.drawLine(0, fmHeightHalf, 0, height - 1);
        g.setColor(downRight);
        g.drawLine(1, fmHeightHalf + 1, 1, height - 2);

        g.setColor(upLeft);
        g.drawLine(1, height - 2, width - 2, height - 2);
        g.setColor(downRight);
        g.drawLine(0, height - 1, width - 1, height - 1);

        g.setColor(upLeft);
        g.drawLine(width - 2, fmHeightHalf + 1, width - 2, height - 2);
        g.setColor(downRight);
        g.drawLine(width - 1, fmHeightHalf, width - 1, height - 1);
    }

    public void updata(Graphics g) {
        paint(g);
    }
}
