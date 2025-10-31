<?php 

class TwitterService
{
    private $_data = [];

    public function setMessage($text)
    {
        $this->_data['message'] = $text;
        echo "Twitter message: " . $this->_data['message'] . PHP_EOL;
    }

    public function sendTweet()
    {
        echo "✅ Tweet has been sent!" . PHP_EOL;
    }
}

interface NotificationInterface
{
    public function setData($data);
    public function sendNotification();
}

class TwitterAdapter implements NotificationInterface
{
    protected $_data;

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function sendNotification()
    {
        $twitterClient = new TwitterService();
        $twitterClient->setMessage($this->_data['message']);
        $twitterClient->sendTweet();
    }
}

class SmsService
{
    private $recipient;
    private $message;
    private $sendTime;

    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setSendTime($time)
    {
        $this->sendTime = $time ?? date('Y-m-d H:i:s');
    }

    public function sendText()
    {
        echo "SMS sent to {$this->recipient} at {$this->sendTime}: {$this->message}" . PHP_EOL;
    }
}

class SmsAdapter implements NotificationInterface
{
    protected $_data;

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function sendNotification()
    {
        $smsClient = new SmsService();
        $smsClient->setRecipient($this->_data['recipient']);
        $smsClient->setMessage($this->_data['message']);
        $time = isset($this->_data['send_time']) ? $this->_data['send_time'] : date('Y-m-d H:i:s');
        $smsClient->setSendTime($time);
        $smsClient->sendText();
    }
}


interface INotificationManager
{
    public function sendNotification($data, $type = '');
}


class NotificationManager implements INotificationManager
{
    public function sendNotification($data, $type = '')
    {
        switch (strtolower($type)) {
            case "twitter":
                $notification = new TwitterAdapter();
                break;
            case "sms":
                $notification = new SmsAdapter();
                break;
            default:
                echo "❌ Error: Unsupported notification type" . PHP_EOL;
                return false;
        }

        $notification->setData($data);
        $notification->sendNotification();
    }
}



// Відправка повідомлення у Twitter
$array1 = [
    "message" => "This is a tweet"
];

$manager = new NotificationManager();
$manager->sendNotification($array1, "twitter");

echo PHP_EOL;
// Відправка SMS-повідомлення
$array2 = [
    "recipient" => "+380501112233",
    "message" => "This is a text message",
    "send_time" => "2025-10-10 09:30:00"
];

$manager->sendNotification($array2, "sms");

?> 