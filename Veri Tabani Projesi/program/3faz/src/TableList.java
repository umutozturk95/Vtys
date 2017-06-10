import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.event.ListSelectionEvent;
import javax.swing.event.ListSelectionListener;
import javax.swing.GroupLayout;
import javax.swing.GroupLayout.Alignment;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;

import java.sql.Connection;
import java.sql.DatabaseMetaData;

import javax.swing.JButton;
import javax.swing.LayoutStyle.ComponentPlacement;
import java.awt.event.ActionListener;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.awt.event.ActionEvent;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;

public class TableList extends JFrame {

	private JPanel contentPane;
	private JTable table;
	private JButton btnNewButton_1;
	private JTextField textField;
	private String username=null;
	private String password=null; 
    private List<String> tableNames=null;
    private List<Integer> recordNumbers=null;
    private String selectedTableName=null;
	
	public void getTableRecordNumbers(){
		Connection con=null;
		PreparedStatement pst=null;
		
	    String url="jdbc:oracle:thin:@localhost:1521:dbs";
	    
		   try{
		    	 Class.forName("oracle.jdbc.driver.OracleDriver");
		    	 con=DriverManager.getConnection(url,username,password);					    	 		    	    
		    	
		    	    //only for Oracle
		    	  recordNumbers=new ArrayList<Integer>();
		    	 for(int i=0;i<tableNames.size();i++){
		    	    String sqlCommand="select count(*) from "+tableNames.get(i);
		    	    pst = con.prepareStatement(sqlCommand);
		    	    ResultSet rs=pst.executeQuery();
		    	    int count=0;
		    	      if(rs.next()){
		    	    	count=rs.getInt(1);
		    	        
		    	     }
		    	      recordNumbers.add(count);	
		    	      rs.close();
		    	      pst.close();
		    	     	    	
		    	 }
		    	    
		    	    
		    	
		    	
		    	
		   }
		    catch(Exception e){
		    	JOptionPane.showMessageDialog(null,"Link Error!","Error",JOptionPane.ERROR_MESSAGE);
		    	
		    }
		    finally {
				try {
					con.close();
					
				} catch (SQLException e) {
					
					e.printStackTrace();
				}
			}
		
		
		
		
	}
	public void getTableNames(){
		Connection con=null;
		Statement st=null;
		ResultSet rs=null;
	    String url="jdbc:oracle:thin:@localhost:1521:dbs";
	    
		   try{
		    	 Class.forName("oracle.jdbc.driver.OracleDriver");
		    	 con=DriverManager.getConnection(url,username,password);					    	 		    	    
		    	    st = con.createStatement();
		    	    //only for Oracle
		    	    rs = st.executeQuery("select object_name from user_objects where object_type = 'TABLE'");
		    	    tableNames=new ArrayList<String>(); 
		    	    while (rs.next()) {
		    	      String tableName = rs.getString(1);
		    	      tableNames.add(tableName);
		    	    }

		    	
		    	
		   }
		    catch(Exception e){
		    	JOptionPane.showMessageDialog(null,"Link Error!","Error",JOptionPane.ERROR_MESSAGE);
		    	
		    }
		    finally {
				try {
					con.close();
					st.close();
				} catch (SQLException e) {
					
					e.printStackTrace();
				}
			}
		
		
	}
	
	public Object[][] getTwoDimensionalMatrix(){
		if(recordNumbers==null||tableNames==null){
			
			return null;
		}
	    
		Object[][] result=new Object[tableNames.size()][2];
	     for(int i=0;i<tableNames.size();i++){
	    	 result[i][0]=tableNames.get(i);
	    	 result[i][1]=recordNumbers.get(i);
	    	 
	     }
	     
	     return result;
		
	}
	
	
	public TableList(String username,String password) {
		this.username=username;
		this.password=password;
		getTableNames();
		getTableRecordNumbers();
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 560, 367);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		
		//JScrollPane scrollPane = new JScrollPane();
		table = new JTable();
		table.setFillsViewportHeight(true);
		Object [][] data=getTwoDimensionalMatrix();
		
		Object[] column={"Table Name","Record Number"};
		
		//table.setPreferredScrollableViewportSize(new Dimension(591, 361));
		table.setModel(new DefaultTableModel(data,column));
	      //table.setAutoResizeMode(JTable.AUTO_RESIZE_OFF);
		JScrollPane scrollPane = new JScrollPane();
		
		 //JScrollPane scrollPane = new JScrollPane(table,JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
		//scrollPane1.setEnabled(false);
        
		JButton btnNewButton = new JButton("Description");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				if(selectedTableName!=null){
					
					Description description=new Description(selectedTableName,username,password);
					//description.setVisible(true);
				}
			
				
				
			}
		});
		
		btnNewButton_1 = new JButton("Manipulate");
		btnNewButton_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				if(selectedTableName!=null){
						
				 Manipulate manipulate=new Manipulate(selectedTableName,username,password);
				 //manipulate.setVisible(true);
				}
			}
		});
		
		JLabel lblTheNumberOf = new JLabel("The number of tables : ");
		
		textField = new JTextField();
		textField.setColumns(10);
		
		if(tableNames!=null){
			textField.setText(""+tableNames.size());
			
		}
		
		GroupLayout gl_contentPane = new GroupLayout(contentPane);
		gl_contentPane.setHorizontalGroup(
			gl_contentPane.createParallelGroup(Alignment.TRAILING)
				.addGroup(gl_contentPane.createSequentialGroup()
					.addContainerGap()
					.addComponent(scrollPane, GroupLayout.PREFERRED_SIZE, 555, GroupLayout.PREFERRED_SIZE)
					.addPreferredGap(ComponentPlacement.RELATED, 26, Short.MAX_VALUE)
					.addGroup(gl_contentPane.createParallelGroup(Alignment.TRAILING)
						.addComponent(btnNewButton_1)
						.addComponent(btnNewButton))
					.addGap(23))
				.addGroup(gl_contentPane.createSequentialGroup()
					.addGap(34)
					.addComponent(lblTheNumberOf)
					.addPreferredGap(ComponentPlacement.UNRELATED)
					.addComponent(textField, GroupLayout.PREFERRED_SIZE, GroupLayout.DEFAULT_SIZE, GroupLayout.PREFERRED_SIZE)
					.addContainerGap(457, Short.MAX_VALUE))
		);
		gl_contentPane.setVerticalGroup(
			gl_contentPane.createParallelGroup(Alignment.TRAILING)
				.addGroup(gl_contentPane.createSequentialGroup()
					.addGroup(gl_contentPane.createParallelGroup(Alignment.LEADING)
						.addGroup(gl_contentPane.createSequentialGroup()
							.addGap(113)
							.addComponent(btnNewButton)
							.addGap(18)
							.addComponent(btnNewButton_1))
						.addGroup(gl_contentPane.createSequentialGroup()
							.addGap(26)
							.addComponent(scrollPane, GroupLayout.PREFERRED_SIZE, 336, GroupLayout.PREFERRED_SIZE)))
					.addGap(26)
					.addGroup(gl_contentPane.createParallelGroup(Alignment.BASELINE)
						.addComponent(lblTheNumberOf)
						.addComponent(textField, GroupLayout.PREFERRED_SIZE, GroupLayout.DEFAULT_SIZE, GroupLayout.PREFERRED_SIZE))
					.addContainerGap(43, Short.MAX_VALUE))
		);
		
		table.getSelectionModel().addListSelectionListener(new ListSelectionListener(){
	        public void valueChanged(ListSelectionEvent event) {
	        	if(!event.getValueIsAdjusting()){
	        	selectedTableName=table.getValueAt(table.getSelectedRow(), 0).toString();
	           	           
	        	}
	        }
	    });
		
		
		setSize(725,500);
		setResizable(false);
		//table.setSize(500, 500);
		scrollPane.setViewportView(table);
		contentPane.setLayout(gl_contentPane);
	}
}
