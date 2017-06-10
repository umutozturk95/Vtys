import java.awt.Component;
import java.awt.Dimension;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextArea;
import javax.swing.JTextField;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableCellRenderer;
import javax.swing.table.TableColumn;
import javax.swing.table.TableColumnModel;
import javax.swing.text.DefaultCaret;


public class Description{

	public Object[][] getDescriptionTable(String tableName,String userName,String password){
		  Connection con = null;
		  Object[][] descriptions=null;
		  try{
		  Class.forName("oracle.jdbc.driver.OracleDriver");
		  con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:dbs",userName,password);		 
		  PreparedStatement pstm=con.prepareStatement("select * from "+tableName);
		  ResultSet rs=pstm.executeQuery();
		  ResultSetMetaData metaData=rs.getMetaData();
		  descriptions=new Object[metaData.getColumnCount()][3];
		  for(int i=0;i<metaData.getColumnCount();i++){
			  
			  descriptions[i][0]=metaData.getColumnName(i+1);
			  descriptions[i][1]=metaData.getColumnTypeName(i+1);
			  if(metaData.isNullable(i+1)==0){
				  descriptions[i][2]="No";
				  
			  }
			  else{
				  
				  descriptions[i][2]="Yes";
				  
			  }
		  }
		  
		  }
		  catch (Exception e){
			  
		  e.printStackTrace();
		  return null;
		  }	
		  finally{
			  
			  try {
				con.close();
			  } catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			 
			  
		  }
		
		return descriptions;
		
		
	}
	
	
     public Description(String tableName,String userName,String password){
         DefaultTableModel model = new DefaultTableModel();

            JFrame frame=new JFrame("Description Table");          
            JPanel mainPanel = new JPanel(new GridLayout(3, 2));          
            JPanel tabP = new JPanel();
                        
          
                   
           mainPanel.setBorder(BorderFactory.createTitledBorder(""));                   
           tabP.setBorder(BorderFactory.createTitledBorder(tableName));
                       
                          
           frame.add(tabP);
                                           
          JTable tablo = new JTable(){
                        	
            public boolean getScrollableTracksViewportWidth()
               {
                 return getPreferredSize().width < getParent().getWidth();
              }
                        	
          };
                             
                     
     Object [][] data=getDescriptionTable(tableName,userName,password);
     Object[] column={"Column Name","Type","Nullable"};
     tablo.setModel(new DefaultTableModel(data,column));
        
          tablo.setPreferredScrollableViewportSize(new Dimension(600,150));                                              
          tablo.setFillsViewportHeight(true);
          tablo.setAutoCreateRowSorter(true);
                   
          tablo.setAutoResizeMode(JTable.AUTO_RESIZE_OFF);
                        
                                        
          JScrollPane scroll = new JScrollPane(tablo,JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
                        
          tabP.add(scroll);
                        
          scroll.setViewportView(tablo);
                                    
          frame.setSize(700,500);                     
          frame.setDefaultCloseOperation(JFrame.HIDE_ON_CLOSE);
          frame.setVisible(true);
          frame.setResizable(false);
          frame.setLocationRelativeTo(null);
   }
}