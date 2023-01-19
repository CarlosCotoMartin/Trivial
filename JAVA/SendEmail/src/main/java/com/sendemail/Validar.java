package com.sendemail;

import java.util.regex.*;    
public class Validar{  
	
	public static Matcher matcher;
	
    public static boolean validacion (String mail){  
    	Pattern pattern = Pattern
                .compile("^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@"
                        + "[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$");
 
        matcher = pattern.matcher(mail);
 
        if (matcher.find() == true) {
            return true;
        } else {
        	return false;
        }
    }  
}