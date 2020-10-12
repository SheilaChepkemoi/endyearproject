<<<<<<< HEAD
<?php
=======
j<?php
>>>>>>> 276467ee35b6b9c1f87ae977ff9da9b5debbacf7

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
	const HOST = "smtp.gmail.com";
	const HOST_PORT = 465;

	//holds email users
	private $emailUsers = array(

		'support' => array(
<<<<<<< HEAD
			'username' => 'otienoalvin44@gmail.com',
			'password' => 'kellyalvin',
			'from_name' => 'support'
=======
			'username' => 'sheila.jowath@gmail.com',
			'password' => 'jowathevents',
			'from_name' => 'Jowath support'
>>>>>>> 276467ee35b6b9c1f87ae977ff9da9b5debbacf7
		)

	);

	//holds the current user
	private $currentUser;

	//holds PHPMailer object
	private $mail;

    /**
     * Mailer constructor.
     * @param $user
     * @throws MailException
     */
    public function __construct($user)
	{
		$this->mail = new PHPMailer(true);

		$this->mail->Host = self::HOST;

		//enable SMTP
		$this->mail->isSMTP(); //may have issues on some hosting servers

		//enable debugging
		//$this->mail->SMTPDebug = 2;

		//set authentication to true
		$this->mail->SMTPAuth = true;

		//set login details for Mail client

		if(isset($this->emailUsers[$user])){

			$this->currentUser = $this->emailUsers[$user];

			$this->mail->Username = $this->currentUser['username'];
			$this->mail->Password = $this->currentUser['password'];

		}else{
		    throw new MailException("Invalid mail user");
		}

		//set type of protection
		$this->mail->SMTPSecure = "ssl"; //or we can use TLS

		//set a port
		$this->mail->Port = 465; //or 587 if TLS

		//end of constructor
	}

	//sends the email

    /**
     * @param $recipients
     * @param $subject
     * @param $body
     * @param string $attachment_path
     * @param string $attachment_name
     * @param bool $isHTML
     * @return bool
     * @throws MailException
     */
    public function sendMail($recipients, $subject, $body, $attachment_path = "", $attachment_name = "", $isHTML = false){

		//check if $recipients is an array
		if(!is_array($recipients)){
			throw new MailException("'recipients' must be an array");
		}

		try{
			//set subject
			$this->mail->Subject = $subject;

			//set if it is HTML
			$this->mail->isHTML($isHTML);

			//set body
			$this->mail->Body = $body;

			//add attachment
			if($attachment_path !== ""){
				$this->mail->addAttachment($attachment_path,$attachment_name);
			}

			//set who is sending the email
			$this->mail->setFrom($this->currentUser['username'],$this->currentUser['from_name']);

			//set where we are sending the email (recipients)
			foreach ($recipients as $key => $value){
				$this->mail->addAddress($value);
			}

			$this->mail->Priority = 1;

			if($this->mail->send()){

				//log the email

				//return success
				return true;
			}else{

				return false;
			}

		}catch (Exception $e){
			throw new MailException($e->getMessage());
		}
	}

	//end of class
}

