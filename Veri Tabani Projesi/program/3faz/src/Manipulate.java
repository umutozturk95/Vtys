import java.awt.Component;
import java.awt.Dimension;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.Connection;
import java.sql.DatabaseMetaData;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;

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
import javax.swing.event.ListSelectionEvent;
import javax.swing.event.ListSelectionListener;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableCellRenderer;
import javax.swing.table.TableColumn;
import javax.swing.table.TableColumnModel;
import javax.swing.text.DefaultCaret;



public class Manipulate {
					
/*
	public static void main(String args[]){
		Manipulate filmA=new Manipulate();
		
	}
*/
 private int tableColumnNumber=0;
 private  JTable table=null;
 private List<String> columns=null; 
 private List<String> primaryKeys=null;
 private List<String> autoPrimaryKeys=null;
 private List<String> columnType=null;
   
    public void findPrimaryKeyTable(String tableName,String username,String password){
    	
    	
    	 Connection con = null;
		  try{
		  Class.forName("oracle.jdbc.driver.OracleDriver");
		  con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:dbs",username,password);		 
		  ResultSet rs = null;
		  DatabaseMetaData meta = con.getMetaData();		  
		  rs = meta.getPrimaryKeys(null, null, tableName);
        		  
	      primaryKeys=new ArrayList<String>();	  			  		  		  	       
		  while (rs.next()) {
		      String columnName = rs.getString("COLUMN_NAME");
		      primaryKeys.add(columnName);
		   }
		  
		  rs.close();
		  
		  rs = meta.getImportedKeys(con.getCatalog(), null,tableName);
		  List<String> primaryForeignKeys=new ArrayList<String>();
		     while (rs.next()) {
		      
		       String  fkColumnName = rs.getString("FKCOLUMN_NAME");
		       for(int i=0;i<primaryKeys.size();i++){
		    	   if(primaryKeys.get(i).equals(fkColumnName)){
		    		   primaryForeignKeys.add(fkColumnName);
		    		   break;
		    	   }
		    	   
		       }
		      
		     }
		     rs.close();
		     
		     autoPrimaryKeys=new ArrayList<String>();
		     int control=0;
		     for(int i=0;i<primaryKeys.size();i++){
		    	 control=0;
		    	 for(int j=0;j<primaryForeignKeys.size();j++){
		    		 if(primaryForeignKeys.get(j).equals(primaryKeys.get(i))){
		    			 
		    			 control=1;
		    			 break;
		    		 }
		    	 }
		    	 if(control==0){
		    		 autoPrimaryKeys.add(primaryKeys.get(i));
		    		 
		    	 }
		    	 
		     }
		     	       
		  }
		  catch (Exception e){
			try {
				con.close();
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		    e.printStackTrace();
		  
		  }
    	
    	
    }
    public void findColumnNumber(String tableName,String username,String password){
    	
    	  Connection con = null;
    	  PreparedStatement pstm=null;
    	  
		  try{
		  Class.forName("oracle.jdbc.driver.OracleDriver");
		  con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:dbs",username,password);	
		  pstm=con.prepareStatement("select * from "+tableName);
		  ResultSetMetaData metaData=pstm.getMetaData();
		  tableColumnNumber=metaData.getColumnCount();
		 
		  
		  }
		  catch (Exception e){
			  
		  e.printStackTrace();
		  
		  }	
		  finally{
			  
			  
			  try {
				con.close();
				
			  } catch (SQLException e) {
			
				e.printStackTrace();
			}
			 
			  
		 }
		
    	
    	
    	
    }
    
    public Object[][] getDataInTable(String tableName,String username,String password){
    	  Connection con = null;
		  Object[][] datas=null;
		  try{
		  Class.forName("oracle.jdbc.driver.OracleDriver");
		  con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:dbs",username,password);		 
		  PreparedStatement pstm=con.prepareStatement("select * from "+tableName);
		  ResultSet rs=pstm.executeQuery();
		   List<List<String>> result=new ArrayList<List<String>>();
		  
		   while(rs.next()){
			   List<String>rows=new ArrayList<String>();
			   for(int i=0;i<tableColumnNumber;i++){
				   String record=rs.getString(i+1);
				   rows.add(record);
				   
			   }
			   result.add(rows);
			   
			   
		   }
		   
		   if(result.size()==0){
			   datas=null;
			   
		   }
		   else{
			   datas=new Object[result.size()][tableColumnNumber];
			   
			   for(int i=0;i<result.size();i++){
				   for(int j=0;j<tableColumnNumber;j++){
					   datas[i][j]=result.get(i).get(j);
				   }
				   
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
    	return datas;
    }
    public void getColumnsInTable(String tableName,String username,String password){
    	
    	 Connection con = null;
    	 findColumnNumber(tableName,username,password);
    	 try{
		  Class.forName("oracle.jdbc.driver.OracleDriver");
		  con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:dbs",username,password);		 
		  PreparedStatement pstm=con.prepareStatement("select *from "+tableName);
		  ResultSetMetaData rs=pstm.getMetaData();
		  columns=new ArrayList<String>();
		  columnType=new ArrayList<String>();
		  for(int i=0;i<tableColumnNumber;i++){
			  columns.add(rs.getColumnName(i+1));
			  columnType.add(rs.getColumnTypeName(i+1));
			  
		  }
		 
		 }
		 catch (Exception e){
		   
		   try {
			  
			  con.close();
		    
		   } catch (SQLException e1) {
			
			  e1.printStackTrace();
		   }	  
		  e.printStackTrace();
		  
		 }
		  
    }
   public void fillTheTableContext(String tableName,String username,String password){
	   
	   
	     Object [][] data=getDataInTable(tableName,username,password);
	     Object[] column=new Object[tableColumnNumber];
	     
	     for(int i=0;i<tableColumnNumber;i++){
	    	 column[i]=columns.get(i);
	    	 
	     }
	     table.setModel(new DefaultTableModel(data,column));
	     
	     TableColumnModel colModel=table.getColumnModel();
	     for(int i=0;i<tableColumnNumber;i++){
	    	 colModel.getColumn(i).setPreferredWidth(200);
	    
	     }
	    
   }
   
   public void deleteRecord(String tableName,List<JLabel> labels,List<JTextArea> textAreas,String username,String password){
	   String sql="delete from "+tableName+"  where ";
	   List<Integer> whereColumnsIndex=new ArrayList<Integer>();
	   for(int i=0;i<labels.size();i++){
		  if(columnType.get(i).equals("DATE")==false){
			  whereColumnsIndex.add(i);
			  
		  }
		 
		  
	   }
	  	
	   for(int i=0;i<whereColumnsIndex.size()-1;i++){
		   sql+=labels.get(whereColumnsIndex.get(i)).getText()+" = ? and ";
		   
	   }
	 
		   
       sql+=labels.get(whereColumnsIndex.get(whereColumnsIndex.size()-1)).getText()+" = ?";
			
	   
	   	   
	   Connection con = null;
		  try{
		  Class.forName("oracle.jdbc.driver.OracleDriver");
		  con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:dbs",username,password);		 
		  PreparedStatement pstm=con.prepareStatement(sql);
		  
		 
		   for(int i=0;i<whereColumnsIndex.size();i++){
			  
			  
			 if(columnType.get(whereColumnsIndex.get(i)).equals("NUMBER")){
				 
				 pstm.setInt(i+1,Integer.valueOf(textAreas.get(whereColumnsIndex.get(i)).getText()));
			 }
			 else if(columnType.get(whereColumnsIndex.get(i)).equals("DOUBLE")||columnType.get(i).equals("FLOAT")){
				
				 pstm.setDouble(i+1,Double.valueOf(textAreas.get(whereColumnsIndex.get(i)).getText()));
			 }
			 
		
		     else if(columnType.get(whereColumnsIndex.get(i)).contains("CHAR")){
					
					 pstm.setString(i+1,textAreas.get(whereColumnsIndex.get(i)).getText());
					 
			 }
			 
			 
		   }
		 
		  
		  int result=pstm.executeUpdate();
		 
		  
		  con.close();
		  
		    
		   
		  }
		  catch (Exception e){
			  
		  e.printStackTrace();
		  
		  }
		 
   }
   
   public void insertRecord(String tableName,List<JLabel> labels,List<JTextArea> textAreas,String username,String password){
	   String sql="";
	   if(autoPrimaryKeys.size()>0){
		   sql="insert into "+tableName+" values (DEFAULT,";   
		   
	   }
	   else{
		  
		  sql="insert into "+tableName+" values (";
	   }
	    
	   List<String> columnValues=new ArrayList<String>();
	   List<Integer> columnsWithoutAutoPrimaryKeysIndex=new ArrayList<Integer>();
	   int control=0;
	   for(int i=0;i<labels.size();i++){
	       control=0;
		   for(int j=0;j<autoPrimaryKeys.size();j++){
			   if(autoPrimaryKeys.get(j).equals(labels.get(i).getText())==true){
				 control=1;
				 break;
			   }
			   
		   }
		   if(control==0){
			   columnsWithoutAutoPrimaryKeysIndex.add(i);
			   columnValues.add(textAreas.get(i).getText());
			 
			   
			   
		   }
		  
	   }

	   for(int i=0;i<columnsWithoutAutoPrimaryKeysIndex.size()-1;i++){
		   
		   sql+="?,";
		   
	   }
	   
	   sql+="?)";
	  
	   Connection con = null;
		  try{
		  Class.forName("oracle.jdbc.driver.OracleDriver");
		  con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:dbs",username,password);		 
		  PreparedStatement pstm=con.prepareStatement(sql);
		  
		  
		  for(int i=0;i<columnsWithoutAutoPrimaryKeysIndex.size();i++){
			     if(columnType.get(columnsWithoutAutoPrimaryKeysIndex.get(i)).equals("NUMBER")){
			    	
					 pstm.setInt(i+1,Integer.valueOf(columnValues.get(i)));
				 }
				 else if(columnType.get(columnsWithoutAutoPrimaryKeysIndex.get(i)).equals("DOUBLE")||columnType.get(columnsWithoutAutoPrimaryKeysIndex.get(i)).equals("FLOAT")){
					 
					 pstm.setDouble(i+1,Double.valueOf(columnValues.get(i)));
				 }
				 
				
				 else if(columnType.get(columnsWithoutAutoPrimaryKeysIndex.get(i)).equals("DATE")){
					
					 pstm.setDate(i+1, new java.sql.Date(new SimpleDateFormat("YYYY-MM-DD HH:MM:SS.SSS").parse(columnValues.get(i)).getTime()));
						 
				 }
				 
				 else if(columnType.get(columnsWithoutAutoPrimaryKeysIndex.get(i)).equals("TIMESTAMP")){
					 
					 pstm.setTimestamp(i+1, new java.sql.Timestamp(new SimpleDateFormat("YYYY-MM-DD HH:MM:SS.SSS").parse(columnValues.get(i)).getTime()));
				 }
				 
				 
				 else if(columnType.get(columnsWithoutAutoPrimaryKeysIndex.get(i)).contains("CHAR")){
					
					 pstm.setString(i+1,columnValues.get(i));
					 
				 }
			  
		  }
		  
		  
		  
		  int result=pstm.executeUpdate();
		
		  
		  con.close();
		  
		    
		   
		  }
		  catch (Exception e){
			  
		    e.printStackTrace();
		    try {
				con.close();
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		  }
	   
	   
   }
   
   public void update(String tableName,List<JLabel> labels,List<JTextArea> textAreas,List<String> previousTextAreaValues,String username,String password){
	   String sql="update "+tableName+" set ";
	   List<Integer> setColumnsIndex=new ArrayList<Integer>();
	   List<Integer> nonSetColumnIndex =new ArrayList<Integer>();
	   
	   for(int i=0;i<previousTextAreaValues.size();i++){
		   
			   if(previousTextAreaValues.get(i).equals(textAreas.get(i).getText())){
				   nonSetColumnIndex.add(i); 
			   }
			   else{
				  
				   setColumnsIndex.add(i);
			   }
		   
	   }
	   
	   if(setColumnsIndex.size()==0){
		   return;
		   
	   }
	   for(int i=0;i<setColumnsIndex.size()-1;i++){
		   
		   sql+=labels.get(setColumnsIndex.get(i)).getText()+" = ?, "; 
		   
	   }
	   
	   sql+=labels.get(setColumnsIndex.get(setColumnsIndex.size()-1)).getText()+" =?  where " ;
	   for(int i=0;i<nonSetColumnIndex.size();i++){
		   if(columnType.get(nonSetColumnIndex.get(i)).equals("DATE")){
			   
			   nonSetColumnIndex.remove(i);
		   }
		   
	   }
	   if(nonSetColumnIndex.size()==0){
		   return;
		   
	   }
	   
	   for(int i=0;i<nonSetColumnIndex.size()-1;i++){
		   sql+=labels.get(nonSetColumnIndex.get(i)).getText()+" = ? and ";
		   
	   }
	   sql+=labels.get(nonSetColumnIndex.get(nonSetColumnIndex.size()-1)).getText()+" = ?";
	   System.out.println("SQL->"+sql);
	 
	   Connection con = null;
		  try{
		  Class.forName("oracle.jdbc.driver.OracleDriver");
		  con = DriverManager.getConnection("jdbc:oracle:thin:@localhost:1521:dbs",username,password);		 
		  PreparedStatement pstm=con.prepareStatement(sql);
		  
		  for(int i=0;i<setColumnsIndex.size();i++){
			  
			     if(columnType.get(setColumnsIndex.get(i)).equals("NUMBER")){
			    	 
					 pstm.setInt(i+1,Integer.valueOf(textAreas.get(setColumnsIndex.get(i)).getText()));
				 }
				 else if(columnType.get(setColumnsIndex.get(i)).equals("DOUBLE")||columnType.get(setColumnsIndex.get(i)).equals("FLOAT")){
					 
					 pstm.setDouble(i+1,Double.valueOf(textAreas.get(setColumnsIndex.get(i)).getText()));
				 }
				 
				 
				 
				 else if(columnType.get(setColumnsIndex.get(i)).equals("DATE")){
					 
					 
					 pstm.setDate(i+1, new java.sql.Date(new SimpleDateFormat("YYYY-MM-DD HH:MM:SS.SSS").parse(textAreas.get(setColumnsIndex.get(i)).getText()).getTime() ));
				 }
				 
				 else if(columnType.get(setColumnsIndex.get(i)).equals("TIMESTAMP")){
					 
					 pstm.setTimestamp(i+1,  new java.sql.Timestamp(new SimpleDateFormat("YYYY-MM-DD HH:MM:SS.SSS").parse(textAreas.get(setColumnsIndex.get(i)).getText()).getTime()));
				 }
				 
				 
				 else if(columnType.get(setColumnsIndex.get(i)).contains("CHAR")){
					
					 pstm.setString(i+1,textAreas.get(setColumnsIndex.get(i)).getText());
					 
				 }
			  
		  }
		 
		  for(int i=0;i<nonSetColumnIndex.size();i++){
			    if(columnType.get(nonSetColumnIndex.get(i)).equals("NUMBER")){
				   
					 pstm.setInt(setColumnsIndex.size()+i+1,Integer.valueOf(textAreas.get(nonSetColumnIndex.get(i)).getText()));
				 }
				 else if(columnType.get(nonSetColumnIndex.get(i)).equals("DOUBLE")||columnType.get(nonSetColumnIndex.get(i)).equals("FLOAT")){
					 
					 pstm.setDouble(setColumnsIndex.size()+i+1,Double.valueOf(textAreas.get(nonSetColumnIndex.get(i)).getText()));
				 }
			  
                
				 
				 else if(columnType.get(nonSetColumnIndex.get(i)).contains("CHAR")){
					
					 pstm.setString(setColumnsIndex.size()+i+1,textAreas.get(nonSetColumnIndex.get(i)).getText());
					 
				 }
			  
				 			  
		  }
		  
		  
		  int result=pstm.executeUpdate();
		 
		  con.close();
		  
		  previousTextAreaValues.removeAll(previousTextAreaValues);
		   
		  }
		  catch (Exception e){
			  
		    e.printStackTrace();
		    try {
				con.close();
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		  }
	   
	   
   }
   
   public int controlTheBlanks(List<JTextArea> textAreas){
	   int control=0;
	   for(int i=0;i<textAreas.size();i++){
		    if(textAreas.get(i).getText()==null || textAreas.get(i).getText().trim().length()==0){
		    	JOptionPane.showMessageDialog(null,"Fill the blanks!","Error",JOptionPane.ERROR_MESSAGE);
		    	control=-1;
		    	break;
		    }
		   
	   }
	   
	   return control;
	   
   }
     public Manipulate(String tableName,String username,String password){
    	  
    	    getColumnsInTable(tableName,username,password);
    	    findPrimaryKeyTable(tableName,username,password);
             DefaultTableModel model = new DefaultTableModel();

            JFrame frame=new JFrame("Manipulate Records");
           
            JPanel mainPanel = new JPanel(new GridLayout(3, 2));
            JPanel recordPanel = new JPanel(new GridLayout(tableColumnNumber,2));
           
            
           JPanel buttonPanel = new JPanel(new FlowLayout());
           JPanel tablePanel = new JPanel();
                        
          
           mainPanel.setBorder(BorderFactory.createTitledBorder("Manipulate Panel"));
           recordPanel.setBorder(BorderFactory.createTitledBorder("Record Panel"));
           buttonPanel.setBorder(BorderFactory.createTitledBorder("Buton Panel"));
          tablePanel.setBorder(BorderFactory.createTitledBorder(tableName));
                                                                                              
       JButton insertButton = new JButton("Insert");
       JButton deleteButton = new JButton("Delete");
       JButton updateButton = new JButton("Update");
       JButton refreshButton = new JButton("Refresh");
                                                                    
       List<JLabel> labels=new ArrayList<JLabel>();
       List<JTextArea> textAreas=new ArrayList<JTextArea>();
       List<String> previousJTextAreaValues=new ArrayList<String>();                 
                       
       table = new JTable(model){
                        	
           public boolean getScrollableTracksViewportWidth()
              {
             return getPreferredSize().width < getParent().getWidth();
           }
                                                       	
      };
      table.getSelectionModel().addListSelectionListener(new ListSelectionListener(){
	        public void valueChanged(ListSelectionEvent event) {
	        	if(!event.getValueIsAdjusting()){
	        	 if(table.getSelectedRow()==-1){
	        		 return;
	        		 
	        	 }  
	        	 
	        	 previousJTextAreaValues.clear();
	        	  for(int i=0;i<tableColumnNumber;i++){    
	        	    
	        		textAreas.get(i).setText(table.getValueAt(table.getSelectedRow(),i).toString());	                	        		
	        		 previousJTextAreaValues.add(textAreas.get(i).getText());
	        		for(int j=0;j<autoPrimaryKeys.size();j++){
	        	    	if(labels.get(i).getText().equals(autoPrimaryKeys.get(j))){
	        	    		textAreas.get(i).setEditable(false);
	        	    		
	        	    		break;
	        	    	}
	        	    	
	        	    }
	        	  
	        	  }
	        	 	            
	           }
	        }
	    });
                                             
      fillTheTableContext(tableName,username,password);
     
       table.setPreferredScrollableViewportSize(new Dimension(600,120));                                                                       
       table.setFillsViewportHeight(true);
       table.setAutoCreateRowSorter(true);
                                                                                                                                                                                                                                                                                                                
       table.setAutoResizeMode(JTable.AUTO_RESIZE_OFF);                                                                                                                                     
       JScrollPane scroll2 = new JScrollPane(table,JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);                        
       tablePanel.add(scroll2);
                          
       scroll2.setViewportView(table);                       
       mainPanel.add(tablePanel);      
       
    
     
    
    
    for(int i=0;i<columns.size();i++){
    	JLabel jLabel=new JLabel(columns.get(i));
    	labels.add(jLabel);
    	JTextArea jTextArea=new JTextArea(2,2);
    	jTextArea.setLineWrap(true);
    	textAreas.add(jTextArea);
    	recordPanel.add(jLabel);
    	JScrollPane scroll = new JScrollPane(jTextArea, JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
        recordPanel.add(scroll);
    }
   
   
    
    JScrollPane s = new JScrollPane(recordPanel, JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
    mainPanel.add(s); 
    
       insertButton.addActionListener(new ActionListener() {
           public void actionPerformed(ActionEvent arg0) {
        	   int control=controlTheBlanks(textAreas);
        	   if(control==0){
        		   insertRecord(tableName, labels, textAreas,username,password);
            	   fillTheTableContext(tableName,username,password);      
        	   }
        	                	     
            }
       });
       
       deleteButton.addActionListener(new ActionListener() {
           public void actionPerformed(ActionEvent arg0) {
        	   //int control=controlTheBlanks(textAreas);                	                
            	   deleteRecord(tableName,labels,textAreas,username,password);       
            	   fillTheTableContext(tableName,username,password); 
               
        	               	    
           }
       });
       
       updateButton.addActionListener(new ActionListener() {
           public void actionPerformed(ActionEvent arg0) {
        	   int control=controlTheBlanks(textAreas);    
        	   
        	   if(control==0){
        		   update(tableName, labels, textAreas,previousJTextAreaValues,username,password);           
                   fillTheTableContext(tableName,username,password);      
        	   }
            }
       });
       
       
       refreshButton.addActionListener(new ActionListener() {
           public void actionPerformed(ActionEvent arg0) {
                   for(int i=0;i<tableColumnNumber;i++){
                	   if(textAreas.get(i).isEditable()==true){
                		   
                		   textAreas.get(i).setText("");   
                	   }
                	   else{
                		   
                		   textAreas.get(i).setEditable(true);
                		   textAreas.get(i).setText("");
                		   textAreas.get(i).setEditable(false);
                	   }
                	   
                   }
                                	     
            }
       });
                                             
     buttonPanel.add(insertButton);
     buttonPanel.add(deleteButton);
     buttonPanel.add(updateButton);  
     buttonPanel.add(refreshButton);
     mainPanel.add(buttonPanel);    
     frame.add(mainPanel);   
     frame.setSize(700,600);                       
     frame.setDefaultCloseOperation(JFrame.HIDE_ON_CLOSE);
     frame.setVisible(true);
     frame.setResizable(false);
     frame.setLocationRelativeTo(null);
   }
}