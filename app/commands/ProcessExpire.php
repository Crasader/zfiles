<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ProcessExpire extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:name';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'process:expire';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//if current date is middle -> send notification
        foreach (User::where('status_id', 5)->get() as $item ){
            $firstTransaction = Transactions::where('user_id', $item->id)
                ->where('status', 2)
                    ->orderBy('transactionDate', 'asc')->first();

            $currentDate = date("Y-m-d");

            if( ($currentDate - $firstTransaction->transactionDate) % 30 == 15 ){
                $mail = new PHPMailer;
                // Set PHPMailer to use the sendmail transport
                $mail->isSendmail();
                //Set who the message is to be sent from
                $mail->setFrom('support@todayvideos.download', 'todayvideos.download');
                //Set an alternative reply-to address
                $mail->addReplyTo('support@todayvideos.download', 'todayvideos.download');
                //Set who the message is to be sent to
                $mail->addAddress($item->email, 'user');
                //Set the subject line
                $mail->Subject = "Notification about account" ;
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
                //Replace the plain text body with one created manually
                //$mail->AltBody = 'This is a plain-text message body';
                //Attach an image file
                //$mail->addAttachment('images/phpmailer_mini.png');



                $mail->MsgHTML($item->email . ' will expire soon. Please check you account ! Thanks you !' );

                $mail->send();
            }

            //last transaction
            $lastTransaction = Transactions::where('user_id', $item->id)
                ->where('status', 2)
                ->orderBy('transactionDate', 'desc')->first();

            if ($currentDate - $lastTransaction->transactionDate >= 35){
                $user = User::find($lastTransaction->user_id);

                $user->status_id = 3;

                $user->save();
            }
        }


        //if expired -> change user's status



	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
