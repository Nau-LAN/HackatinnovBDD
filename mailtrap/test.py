# Import smtplib for the actual sending function
import smtplib

# Import the email modules we'll need
from email.mime.text import MIMEText

msg = MIMEText("Contenu email")

me = "moi@chevrollier.fr"
you = "random@chevrollier.fr"
msg['Subject'] = 'Sujet email'
msg['From'] = me
msg['To'] = you

s = smtplib.SMTP('mailap3.dombtsig.local:1025')
s.sendmail(me, [you], msg.as_string())
s.quit()
