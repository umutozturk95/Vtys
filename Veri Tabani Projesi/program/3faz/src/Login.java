import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;

import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.JTextField;
import java.sql.*;
import javax.swing.JPasswordField;
public class Login extends JFrame {

	private JPanel contentPane;
	private JTextField userNametextField;
	private JPasswordField passwordField;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Login frame = new Login();
					frame.setResizable(false);
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public Login() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JButton btnNewButton = new JButton("Login");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				char [] password=passwordField.getPassword();
				
			   controlUserNameAndPassword(userNametextField.getText(),new String(password));
				
			}
		});
		btnNewButton.setBounds(159, 131, 162, 23);
		contentPane.add(btnNewButton);
		
		JLabel lblUsername = new JLabel("UserName :");
		lblUsername.setBounds(84, 42, 92, 33);
		contentPane.add(lblUsername);
		
		userNametextField = new JTextField();
		userNametextField.setBounds(159, 48, 162, 20);
		contentPane.add(userNametextField);
		userNametextField.setColumns(10);
		
		JLabel lblPassword = new JLabel("Password :");
		lblPassword.setBounds(84, 86, 67, 14);
		contentPane.add(lblPassword);
		
		JLabel lblDbmsManagementSystem = new JLabel("DBMS MANAGEMENT SYSTEM");
		lblDbmsManagementSystem.setBounds(159, 8, 251, 23);
		contentPane.add(lblDbmsManagementSystem);
		
		passwordField = new JPasswordField();
		passwordField.setBounds(159, 83, 162, 20);
		contentPane.add(passwordField);
	}
	
	public void controlUserNameAndPassword(String username,String password){
		
		
		if(username==null || username.trim().length()==0||password==null||password.trim().length()==0){
			
			
			JOptionPane.showMessageDialog(null,"Invalid Password and Username!","Error",JOptionPane.ERROR_MESSAGE);
			return;
		}
		
		
		
		Connection con=null;
		Statement st=null;
	    String url="jdbc:oracle:thin:@localhost:1521:dbs";
	    try{
	    	Class.forName("oracle.jdbc.driver.OracleDriver");
	    	 con=DriverManager.getConnection(url,username,password);			
			 st=con.createStatement();
	    	 TableList tableList=new TableList(username,password);
	    	 tableList.setVisible(true);
	    	
	    }
	    catch(Exception e){
	    	e.printStackTrace();
	    	JOptionPane.showMessageDialog(null,"Invalid Login!","Error",JOptionPane.ERROR_MESSAGE);
	    	
	    }
	    finally {
			try {
				con.close();
			} catch (SQLException e) {
				
				e.printStackTrace();
			}
		}
		 
	  
	}
}
