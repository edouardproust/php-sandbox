<?php
class Message {

    const LIMIT_USERNAME = 3; // We create constants to be able to change them easily if needed later on.
    const LIMIT_MESSAGE = 10;
    private $username;
    private $message;
    private $date;

    public function __construct(string $username, string $message, ?DateTime $date = null) 
        // Question mark before the value type (DateTime) to say: "if value is null, then value will have to be a DateTime object"
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date ?: new DateTime(); // If $date = null, thencreate a new DateTime object
    }
    public function isValid(): bool
    {
        return empty($this->getErrors());
    }
    public function getErrors(): array
    {
        $errors = [];
        if (strlen($this->username) < self::LIMIT_USERNAME) {
            $errors['username'] = "Username is too short (3 characters min.)";
        }
        if (strlen($this->message) < self::LIMIT_MESSAGE) {
            $errors['message'] = "Message is too short (10 characters min.)";
        }
        return $errors;
    }
    public function toJSON(): string 
    {
        return json_encode([
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }
    public function toHTML()
    {
        $username = htmlentities($this->username);
        $this->date->setTimeZone(new DateTimeZone('Europe/Paris')); // Change the timezone to Paris on display
        $date = 'on ' . $this->date->format("F n, Y") . ' at ' . $this->date->format("g:i a");
        $message = nl2br(htmlentities($this->message));
            // nl2br() function cahnge the linebreaks that are not readen in HTML into <br> tags
        return <<<HTML
        <div class="card mb-2">
            <div class="card-body">
                <div class="mb-2">
                    <b>$username</b>
                    <span class="text-muted"><i>$date</i></span>
                </div>
                $message
            </div>
        </div>
HTML;
    }
    public static function fromJSON(string $json): Message 
    {
        $data = json_decode($json, true);
        $date = new DateTime("@" . $data['date']);
        return new self($data['username'], $data['message'], $date);
            // It's necessary to convert back into an array of objects because we'll use methods on $message in guestbook.php
            // new DateTime("@$ts") is a shortened version of new DateTime instantiation + setTimestamp() --> ref: https://www.php.net/manual/en/datetime.settimestamp.php ('Notes' paragraph)
    }
}