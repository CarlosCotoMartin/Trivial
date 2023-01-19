package com.sendemail;

import java.io.File;
import java.io.IOException;
import java.util.Properties;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.Multipart;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeBodyPart;
import javax.mail.internet.MimeMessage;
import javax.mail.internet.MimeMultipart;

public class SendMail {
	
	public static boolean flag = false;

	public static void enviar(String to, String user, String contra) {
		
        // Email que envia
        String from = "pregunta2.staff@gmail.com";

        // Servidor
        String host = "smtp.gmail.com";
        
        //Propiedades del host
        Properties properties = System.getProperties();

        properties.put("mail.smtp.host", host);
        properties.put("mail.smtp.port", "465");
        properties.put("mail.smtp.ssl.enable", "true");
        properties.put("mail.smtp.auth", "true");

        //Usar email y contraseña
        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {

            protected PasswordAuthentication getPasswordAuthentication() {

                return new PasswordAuthentication("pregunta2.staff@gmail.com", "1234ABcd#");

            }

        });

        // Comprobar problemas con debug
        session.setDebug(true);
        
			try {
				// Crear un objeto mensaje
				MimeMessage message = new MimeMessage(session);

				// Decir quien lo envia
				message.setFrom(new InternetAddress(from));

				// Elegir a quien se envia
				message.addRecipient(Message.RecipientType.TO, new InternetAddress(to));

				// Asunto
				message.setSubject("Registro Completado en Pregunta2");

				// Cuerpo
				message.setText("Gracias por registrarte, ha sido dado de alta con el usuario: " + user + ", con contraseña: " + contra);
					
				// Enviar mensaje
				Transport.send(message);
				System.out.println("Correo enviado correctamente....");
				flag = true;
			} catch (MessagingException mex) {
				flag = false;
			} 
			
	}

}