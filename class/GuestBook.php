<?php
require_once 'Message.php';

class GuestBook {

    public $file;

    public function __construct(string $file)
    {
        if (!is_dir(dirname($file))) { // Check if file's path folders exist (if not: create them)
            mkdir(dirname($file), 0777, true);
        }
        if (!file_exists($file)) { // Check if file exists (if not: create it)
            touch($file); // touch() function allows to create a new file.
        }
        $this->file = $file;
    }

    public function addMessage(Message $message): void
    {
       file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND);
    }
    public function getMessages()
    {
        $content = trim(file_get_contents($this->file));
        $messages = [];
        if(!empty($content)) {
            $lines = (array)explode( PHP_EOL, $content);
            foreach ($lines as $line) {
                $messages[] = Message::fromJSON($line);
            }
        }
        return array_reverse($messages);
    }

}