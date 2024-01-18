<?php
namespace ChatApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;


class Chat implements MessageComponentInterface {
    protected $clients;
    protected $connect_db;

    public function __construct($connect_db) {
        $this->clients = new \SplObjectStorage;
        $this->connect_db = $connect_db;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        $escapedMsg = $this->connect_db->real_escape_string($msg);

        // Insert the escaped message into the 'messages' table
        $stmt = $this->connect_db->prepare("INSERT INTO messages (text, created_at, updated_at) VALUES (?, now(), now())");
        $stmt->bind_param("s", $escapedMsg);
        
        if ($stmt->execute()) {
            echo "Message successfully inserted into the database.\n";
        } else {
            echo "Error inserting message: " . $stmt->error . "\n";
        }

        $stmt->close();

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        } 

    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}